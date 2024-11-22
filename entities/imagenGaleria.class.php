<?php

require_once 'database/IEntity.class.php';

    class imagenGaleria implements IEntity{

        const RUTA_IMAGENES_PORTFOLIO='images/index/portfolio/';
        const RUTA_IMAGENES_GALLERY='images/index/gallery/';

        private $nombre;
        private $descripcion;
        private $numVisualizaciones;
        private $numLikes;
        private $numDescargas;
        private $id;
        private $categoria;


        public function __construct( $nombre = '',  $descripcion = '',  $categoria = 0,  $numVisualizaciones = 0,  $numLikes = 0,  $numDescargas = 0)
        {
            $this->nombre = $nombre;
            $this->descripcion = $descripcion;
            $this->numVisualizaciones = $numVisualizaciones;
            $this->numLikes = $numLikes;
            $this->numDescargas = $numDescargas;
            $this->id=null;
            $this->categoria = $categoria;
            
        }


        public function toArray():array{
                return[
                        'id' => $this->getId(),
                        'nombre' => $this->getNombre(),
                        'descripcion' => $this->getDescripcion(),
                        'categoria' => $this->getCategoria(),
                        'numVisualizaciones' => $this->getNumVisualizaciones(),
                        'numLikes' => $this->getNumLikes(),
                        'numDescargas' => $this->getnumDescargas()
                ];
        }

         /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }


        public function getUrlPortfolio():string
        {
            return self::RUTA_IMAGENES_PORTFOLIO.$this->getNombre();
        }

        public function getUrlGallery():string
        {
            return self::RUTA_IMAGENES_GALLERY.$this->getNombre();
        }

        
        /**
         * Get the value of nombre
         */ 
        public function getNombre()
        {
                return $this->nombre;
        }

        /**
         * Get the value of descripcion
         */ 
        public function getDescripcion()
        {
                return $this->descripcion;
        }

        /**
         * Get the value of numVisualizaciones
         */ 
        public function getNumVisualizaciones()
        {
                return $this->numVisualizaciones;
        }

        /**
         * Get the value of numLikes
         */ 
        public function getNumLikes()
        {
                return $this->numLikes;
        }

        /**
         * Get the value of numDescargas
         */ 
        public function getnumDescargas()
        {
                return $this->numDescargas;
        }



        /**
         * Get the value of categoria
         */ 
        public function getCategoria()
        {
                return $this->categoria;
        }

    }


?>