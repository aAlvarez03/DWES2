<?php
	require 'utils/utils.php';
	require 'entities/File.class.php';
    require 'entities/imagenGaleria.class.php';
    require 'entities/connection.class.php';
    require_once 'entities/queryBuilder.class.php';

    // Array para guardar los mensajes de errores
    $errores = [];
    $descripcion = '';
    $mensaje = '';


    try{
    // Realizamos la conexion a la base de datos
    $connection = Connection::make();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
                $descripcion = trim(htmlspecialchars($_POST['descripcion']));
                $tiposAceptados = ['image/jpeg', 'image/jpg', 'image/gif', 'image/png'];
                $imagen = new File('imagen', $tiposAceptados);
                //el parametro fileName es 'imagen' porque asi lo indicamos en el formulario (type='file' name='imagen')

                // Guardamos la imagen en la galeria
                $imagen -> saveUploadFile(imagenGaleria::RUTA_IMAGENES_GALLERY);
                // Si se ha llegado hasta aqui es que no ha habido errores
                
                // pasamos la query al siguiente string
                $sql = "INSERT INTO imagenes (nombre, descripcion) VALUES (:nombre, :descripcion)";
                // generamos el objeto PDO statment
                $pdoStatement = $connection->prepare($sql);
                // guardamos los parametros en un array que luego se lo pasaremos a la sentencia pdoStatement en un execute
                $parametersStatementArray = [':nombre'=>$imagen->getFileName(), ':descripcion'=>$descripcion];
                //Lanzamos la sentencia y vemos si se ha ejecutado correctamente
                $response = $pdoStatement->execute($parametersStatementArray);
                if($response === false){
                    $errores[] = "No se ha podido guardar la imagen en la BD";
                }else{
                    $descripcion = '';
                    $mensaje = "Imagen guardada";
                }

                // Copiamos la imagen desde galeria a portfolio
                $imagen ->copyFile(imagenGaleria::RUTA_IMAGENES_GALLERY, imagenGaleria::RUTA_IMAGENES_PORTFOLIO);
                // consulta sql
                $querySql = 'Select * from imagenes';
                $queryStatement = $connection->query($querySql);

                // while($row = $queryStatement->fetch()){
                //     // $row va a tener este formato: ['id'=>1, 'nombre'=>'asdasd', 'descripcion'=>'sdasdsad', 'numVisualizaciones'=>0, 'numLikes'=>0, 'numDowload'=>0];
                //     echo 'id '.$row['id']."<br>";
                //     echo 'nombre '.$row['nombre']."<br>";
                //     echo 'descripcion'.$row['descripcion']."<br>";
                //     echo 'numVisualizaciones'.$row['numVisualizaciones']."<br>";
                //     echo 'numLikes'.$row['numLikes']."<br>";
                //     echo 'numDownload'.$row['numDescargas'];

                // }
                
            }

        $queryBuilder = new QueryBuilder($connection);
        $imagenes = $queryBuilder->findAll('imagenes', 'imagenGaleria');
        }
        catch(FileException $exception)
        {
            $errores[] = $exception->getMessage();
        }
        catch(QueryException $exception)
        {
            $errores[] = $exception->getMessage();
        }
    require 'views/galery.view.php';
?>