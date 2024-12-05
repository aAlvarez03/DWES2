<?php
    require 'entities/app.class.php';

    $config = require_once 'app/config.php';
    App::bind('config', $config);
?>