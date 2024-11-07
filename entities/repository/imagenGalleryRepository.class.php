<?php
    require_once 'entities/queryBuilder.class.php';

    class ImagenGalleryRepository extends QueryBuilder{
        public function __construct(string $table='imagenes', string $classEntity='imagenGaleria')
        {
            parent::__construct($table, $classEntity);
        }
    }
?>