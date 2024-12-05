<?php
	require_once 'utils/utils.php';
	require_once 'entities/File.class.php';
    require_once 'entities/imagenGaleria.class.php';
    require_once 'entities/connection.class.php';
    require_once 'entities/queryBuilder.class.php';
    require_once 'exceptions/AppException.class.php';
    require_once 'entities/repository/imagenGalleryRepository.class.php';
    require_once 'entities/repository/categoryRepository.class.php';
    require_once 'entities/Category.class.php';


    // Array para guardar los mensajes de errores
    $errores = [];
    $mensaje = '';


    try{

        /* Creamos los repositorios de la galeria de imagenes y las categorias */
        $imagenRepositorio = new ImagenGalleryRepository();
        $categoriaRepositorio = new CategoryRepository();

        
        }catch(FileException | QueryException | AppException | PDOException $exception)
        {
            $errores[] = $exception->getMessage();
        }
        finally{
            /* Mostramos las imagenes de la galeria y las categorias con el metodod findAll() */
            $imagenes = $imagenRepositorio->findAll();
            $categorias = $categoriaRepositorio->findAll();
        }
    require 'views/galery.view.php';
?>