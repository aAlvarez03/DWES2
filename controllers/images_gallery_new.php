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

    $descripcion = '';
    $mensaje = '';

    try{

        $imagenRepositorio = new ImagenGalleryRepository();

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

        // llamada para obtener el Mogolog/Logger y guardar la informacion de la imagen y el mensaje en proyecto.log
        // info es una funcion propia de la clase Logger.
        App::get('logger')->log->info($mensaje);
    }catch(FileException | QueryException $e){
        die($e->getMessage());
    }

    App::get('router')->redirect('gallery')

?>