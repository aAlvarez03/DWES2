<?php
    require_once 'entities/app.class.php';
    require_once 'utils/strings.php';
    require_once 'exceptions/AppException.class.php';

    class Connection
    {
        public static function make(){
            try{
                $config = App::get('config')['database']; //Utilizamos el contenedor de servicios para obtener la configuracion
                $connection = new PDO(
                    $config['connection'].';dbname='.$config['name'],
                    $config['username'],
                    $config['password'],
                    $config['options']
                );
            }catch(PDOException $error){
                // die($error->getMessage());
                // die es una funcion que muestra el string que se le pasa
                // y detiene la ejecucion del script
                throw new AppException(getErrorStrings('CON_DB'));
            }
            return $connection;
        }
    }

?>