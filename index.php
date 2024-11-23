<?php
    require_once 'entities/imagenGaleria.class.php';
    require_once 'entities/associates.class.php';
    require_once 'utils/utils.php';
    require_once 'entities/repository/imagenGalleryRepository.class.php';
    require_once 'entities/connection.class.php';

    try{
        $config = require_once 'app/config.php';
	    App::bind('config', $config);

        /* Creamos los objetos de los repositorios para hacer los insert y select en la BD */
        $imagenRepositorio = new ImagenGalleryRepository();
    }catch(QueryException | AppException $exc){
        $error = $exc->getMessage();
    }finally{
        $imagenes = $imagenRepositorio->findAll();
    }


    // $imagenes = [];
    $asociados = [];

    // for ($i=1; $i <= 12; $i++) { 
    //     $imagen = new imagenGaleria($i.'.jpg','Descripcion imagen '.$i, rand(800, 1500), rand(200, 800), rand(10, 100));
    //     array_push($imagenes, $imagen);
    // }

    for($i=1; $i <= rand(3, 12); $i++){
        $asociado = new Associate("Partner número ".$i,'log'.rand(1,3).'.jpg','imagen'.$i);
        array_push($asociados, $asociado);
    }    

    require 'views/index.view.php';
?>