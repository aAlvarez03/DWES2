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
    $descripcion = '';
    $mensaje = '';


    try{
    // Realizamos la conexion a la base de datos
    $config = require_once 'app/config.php';
    App::bind('config', $config);
    // $queryBuilder = new QueryBuilder('imagenes', 'imagenGaleria');
    /* Creamos los repositorios de la galeria de imagenes y las categorias */
    $imagenRepositorio = new ImagenGalleryRepository();
    $categoriaRepositorio = new CategoryRepository();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
                // Obtenemos los datos por medio del metodo POST
                $descripcion = trim(htmlspecialchars($_POST['descripcion']));
                $tiposAceptados = ['image/jpeg', 'image/jpg', 'image/gif', 'image/png'];
                $categoria = trim(htmlspecialchars($_POST['categoria']));
                $imagen = new File('imagen', $tiposAceptados);
                //el parametro fileName es 'imagen' porque asi lo indicamos en el formulario (type='file' name='imagen')
                // Guardamos la imagen en la galeria
                $imagen -> saveUploadFile(imagenGaleria::RUTA_IMAGENES_GALLERY);
                $imagen ->copyFile(imagenGaleria::RUTA_IMAGENES_GALLERY, imagenGaleria::RUTA_IMAGENES_PORTFOLIO);

                /* Creamos y guardamos la imagen en el repositorio de imagenes */
                $imagenGaleria = new imagenGaleria($imagen->getFileName(), $descripcion, $categoria);
                $imagenRepositorio->save($imagenGaleria);
                $descripcion='';
                $mensaje = "Imagen guardada";
                
            }
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