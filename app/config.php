<?php
    return[
        'database' => [
            'name' => 'proyecto',
            'username' => 'user',
            'password' => 'user',
            'connection' => 'mysql:host=dwes.local', // Configuración de la conexión a la base de datos
            'options' => [
                PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8', //para que utilice utf8
                PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, // para cuando se produzca un error se genere una excepcion y asi poder capturarlo
                PDO::ATTR_PERSISTENT=>true // para que no cierre la conexion y mejorar el rendimiento
            ]
        ]
    ];
?>