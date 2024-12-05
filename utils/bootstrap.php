<?php
    require 'entities/app.class.php';
    require 'entities/Request.class.php';
    require 'entities/Router.class.php';
    require 'exceptions/NotFounException.class.php';

    $config = require_once 'app/config.php';
    App::bind('config', $config);

    $router = Router::load('utils/routes.php');
    App::bind('router', $router);
?>