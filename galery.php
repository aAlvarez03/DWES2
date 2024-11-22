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
    $imagenRepositorio = new ImagenGalleryRepository();
    $categoriaRepositorio = new CategoryRepository();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
                $descripcion = trim(htmlspecialchars($_POST['descripcion']));
                $tiposAceptados = ['image/jpeg', 'image/jpg', 'image/gif', 'image/png'];
                $categoria = trim(htmlspecialchars($_POST['categoria']));
                $imagen = new File('imagen', $tiposAceptados);
                //el parametro fileName es 'imagen' porque asi lo indicamos en el formulario (type='file' name='imagen')
                // Guardamos la imagen en la galeria
                $imagen -> saveUploadFile(imagenGaleria::RUTA_IMAGENES_GALLERY);
                $imagen ->copyFile(imagenGaleria::RUTA_IMAGENES_GALLERY, imagenGaleria::RUTA_IMAGENES_PORTFOLIO);
                // Si se ha llegado hasta aqui es que no ha habido errores
                // pasamos la query al siguiente string
                //Lanzamos la sentencia y vemos si se ha ejecutado correctamente
                $imagenGaleria = new imagenGaleria($imagen->getFileName(), $descripcion, $categoria);
                $imagenRepositorio->save($imagenGaleria);
                $descripcion='';
                $mensaje = "Imagen guardada";
                
            }
        }catch(FileException $exception)
        {
            $errores[] = $exception->getMessage();
        }catch(QueryException $exception)
        {
            $errores[] = $exception->getMessage();
        }catch(AppException $exception)
        {
            $errores[] = $exception->getMessage();
        }
        catch(PDOException $exception)
        {
            $errores[] = $exception->getMessage();
        }
        finally{
            $imagenes = $imagenRepositorio->findAll();
            $categorias = $categoriaRepositorio->findAll();
        }
    require 'views/galery.view.php';
?>