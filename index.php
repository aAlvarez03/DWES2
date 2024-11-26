<?php
    require_once 'entities/imagenGaleria.class.php';
    require_once 'entities/partner.class.php';
    require_once 'utils/utils.php';
    require_once 'entities/repository/imagenGalleryRepository.class.php';
    require_once 'entities/repository/partnerRepository.class.php';
    require_once 'entities/connection.class.php';

    $errores = [];

    try{
        $config = require_once 'app/config.php';
	    App::bind('config', $config);

        /* Creamos los objetos de los repositorios para hacer el select en la BD */
        $imagenRepositorio = new ImagenGalleryRepository();
        $partnerRepositorio = new PartnerRepository();
    }catch(QueryException | AppException $exception){
        $errores[] = $exception->getMessage();
    }finally{
        /* Llamamos al metodo findAll() para obtener todas las imagenes guardadas en los repositorios */
        $imagenes = $imagenRepositorio->findAll();
        $asociados = $partnerRepositorio->findAll();
    } 

    require 'views/index.view.php';
?>