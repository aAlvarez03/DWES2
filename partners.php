<?php
    require_once 'utils/utils.php';
    require_once 'entities/partner.class.php';
    require_once 'entities/repository/partnerRepository.class.php';
    require_once 'entities/File.class.php';
    require_once 'entities/imagenGaleria.class.php';
    require_once 'entities/connection.class.php';

    $errores = [];
    $mensaje = '';
    $descripcion = '';

    try{
        //Se crea la conexión con la base de datos
        $config = require_once 'app/config.php';
        App::bind('config', $config);

        //Repositorio que será usado para las operaciones insert y select con la base de datos
        $partnerRepositorio = new PartnerRepository();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $nombre = trim(htmlspecialchars($_POST['nombre']));
            if(empty($nombre)){
               $errores[] = throw new Exception("Tiene que indicar un nombre");
            }
            
            $descripcion = trim(htmlspecialchars($_POST['descripcion']));

            $tiposAceptados = ['image/jpeg', 'image/jpg', 'image/gif', 'image/png'];

            //Se crea el fichero y lo guardamos en la galeria y lo copiamos en el portfolio
            $logo = new File('logo', $tiposAceptados);
            $logo->saveUploadFile(imagenGaleria::RUTA_IMAGENES_GALLERY);
            $logo->copyFile(imagenGaleria::RUTA_IMAGENES_GALLERY, imagenGaleria::RUTA_IMAGENES_PORTFOLIO);

            //Sentencia SQL INSERT
            $partner = new Partner($nombre, $logo->getFileName(), $descripcion);
            $partnerRepositorio->save($partner);
            $descripcion = '';
            $mensaje = "Asociado guardado";
        }

    }catch(FileException | QueryException | AppException | PDOException $exception)
    {
        $errores[] = $exception->getMessage(); 
    }
    finally{
        $asociados = $partnerRepositorio->findAll();
    }

    require 'views/partners.view.php';
?>