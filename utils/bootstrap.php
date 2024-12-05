<?php
    require 'entities/app.class.php';
    require 'entities/Request.class.php';
    require 'entities/Router.class.php';
    require 'exceptions/NotFounException.class.php';
    require_once 'vendor/autoload.php';
    require_once 'entities/repository/myLog.class.php';

    $config = require_once 'app/config.php';
    App::bind('config', $config);

    App::bind('router', Router::load('utils/routes.php'));

    App::bind('logger', new MyLog('logs/proyecto.log'));
?>