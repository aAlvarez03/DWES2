<?php
    require_once 'entities/queryBuilder.class.php';

    class ImagenGalleryRepository extends QueryBuilder{
        public function __construct(string $table='imagenes', string $classEntity='imagenGaleria')
        {
            parent::__construct($table, $classEntity);
        }

        public function getCategoria(imagenGaleria $imagenGaleria):Category{
            $categoryRepository = new CategoryRepository();
            return $categoryRepository->find($imagenGaleria->getCategoria()); //Metodo find buscará en nuestra base de datos a partir del identificador que recibe como parametro. Para obtener el identificador de la categoria que queremos buscar llamamos al metodo getCategoria() de la imagenGaleria que hemor recibido como parametro. Este metodo find lo implementaremos en la clase padre QueryBuilder
        }


    }
?>