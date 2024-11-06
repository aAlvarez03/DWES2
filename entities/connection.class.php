<?php
    class Connection
    {
        public static function make(){
            $option = [
                PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8', //para que utilice utf8
                PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, // para cuando se produzca un error se genere una excepcion y asi poder capturarlo
                PDO::ATTR_PERSISTENT=>true // para que no cierre la conexion y mejorar el rendimiento
            ];
            try{
                $connection = new PDO('mysql:host=dwes.local;dbname=proyecto;charset=utf8', 'user', 'user', $option);
            }catch(PDOException $error){
                die($error->getMessage());
                // die es una funcion que muestra el string que se le pasa
                // y detiene la ejecucion del script
            }
            return $connection;
        }
    }

?>