<?php
    require_once 'exceptions/FileException.class.php';
    require_once 'utils/strings.php';
    class File
    {
        private $file;
        private $fileName;

        /**
         * File constructor.
         * @param string $fileName
         * @param array $arrTypes
         * @throws FileException
         */


        public function __construct(string $fileName, array $arrTypes)
        {
            //Con $fileName obtendremos el fichero mediante el array $_FILES que contiene todos los ficheros que se suben al servidor mediante un formulario
            $this->file = $_FILES[$fileName];
            $this->fileName = '';

            //Comprobamos que el array contiene el fichero
            if(!isset($this->file)){
                throw new FileException('Debes seleccionar un fichero');
            }


            //Verificamos si ha habido algún error durante la subida del fichero
            if($this->file['error'] !== UPLOAD_ERR_OK){
                //Dentro del if verificamos de que tipo ha sido el error
                $excepcion = getErrorStrings($this->file['error']) ?? 'No se ha podido subir el fichero';

                throw new FileException($excepcion);
            }

            //Comprobamos si el fichero subido es de un tipo de los que tenemos sorportados
            if(in_array($this->file['type'], $arrTypes) === false){
                throw new FileException(getErrorStrings('NOT_SUPP_FILE'));
            }
        }

        public function getFileName()
        {
            return $this->fileName;
        }


        
        public function saveUploadFile(string $rutaDestino){
            //Compruebo que el fichero temporal con el que vamos a trabajar se haya subido previamente por peticion POST
            if(is_uploaded_file($this->file['tmp_name']) === false){
                throw new FileException(getErrorStrings('UPLOAD_ERR_PARTIAL'));
            }
            //Cargamos el nombre del fichero
            $fileNameAux = $this->fileName;
            $fileNameAux = pathinfo($this->file['name'], PATHINFO_FILENAME); // Nombre sin extensión
            $extension = pathinfo($this->file['name'], PATHINFO_EXTENSION); // Solo la extensión
            $ruta = $rutaDestino . $fileNameAux . '.' . $extension;

            // Generar un número secuencial si el archivo ya existe
            $contador = 1;
            while (is_file($ruta)) {
                // Si existe, no sobreescribo, creo uno nuevo con un numero dependiendo la cantidad de veces que se repite
                $ruta = $rutaDestino . $fileNameAux . '(' . $contador . ')' . '.' . $extension;
                $contador++;
            }
            if($contador == 1){
                $this->fileName =  $fileNameAux . '.' . $extension;
            }else{
                $this->fileName =  $fileNameAux . '(' . $contador-1 . ')' . '.' . $extension;
            }
            

            // Muevo el fichero subido del directorio temporal (viene definido en el php.ini)
            if(move_uploaded_file($this->file['tmp_name'], $ruta) === false){
                //Devuelve false si no se ha podido mover
                throw new FileException(getErrorStrings('MV_UP_FILE'));
            }

        }


        /**
         * @param string $rutaOrigen
         * @param string $rutaDestino
         * @throws FileException
         */
        public function copyFile(string $rutaOrigen, string $rutaDestino){
            // Cargamos el nombre del fichero tanto en la ruta de origen como destino
            $fileNameAux = $this->fileName;
            $fileNameAux = pathinfo($this->file['name'], PATHINFO_FILENAME);
            $extension = pathinfo($this->file['name'], PATHINFO_EXTENSION);
            $origen = $rutaOrigen.$fileNameAux.'.'.$extension;
            $destino = $rutaDestino.$fileNameAux.'.'.$extension;

            // Compruebo si el archivo ya existe en el directorio destino y no sobreescribo, creo uno nuevo con un numero dependiendo la cantidad de veces que se repite.
            $contador = 1;
            while (is_file($destino)) {
                $destino = $rutaDestino . $fileNameAux . '(' . $contador . ')' . '.' . $extension;
                $contador++;
            }

            if($contador == 1){
                $this->fileName =  $fileNameAux . '.' . $extension;
            }else{
                $this->fileName =  $fileNameAux . '(' . $contador-1 . ')' . '.' . $extension;
            }

            if(is_file($origen) === false){
                throw new FileException("No existe el fichero $origen que intentas copiar");
            }

            if(is_file($destino) === true){
                throw new FileException("El fichero $destino ya existe y no se puede sobreescribir");
            }

            if(copy($origen, $destino) === false){
                throw new FileException("No se ha podido copiar el fichero $origen a $destino");
            }

        }
    }
    
?>