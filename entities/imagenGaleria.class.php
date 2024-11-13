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


        public function __construct(string $nombre = '', string $descripcion = '', int $categoria = 0, int $numVisualizaciones = 0, int $numLikes = 0, int $numDescargas = 0)
        {
            $this->nombre = $nombre;
            $this->descripcion = $descripcion;
            $this->numVisualizaciones = $numVisualizaciones;
            $this->numLikes = $numLikes;
            $this->numDescargas = $numDescargas;
            $this->id=null;
            $this->categoria = $categoria;
            
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
        public function getNombre():string
        {
                return $this->nombre;
        }

        /**
         * Set the value of nombre
         *
         * @return  self
         */ 
        public function setNombre($nombre):void
        {
                $this->nombre = $nombre;
        }

        /**
         * Get the value of descripcion
         */ 
        public function getDescripcion():string
        {
                return $this->descripcion;
        }

        /**
         * Set the value of descripcion
         *
         * @return  self
         */ 
        public function setDescripcion($descripcion):void
        {
                $this->descripcion = $descripcion;

        }

        /**
         * Get the value of numVisualizaciones
         */ 
        public function getNumVisualizaciones():int
        {
                return $this->numVisualizaciones;
        }

        /**
         * Set the value of numVisualizaciones
         *
         * @return  self
         */ 
        public function setNumVisualizaciones($numVisualizaciones):void
        {
                $this->numVisualizaciones = $numVisualizaciones;
        }

        /**
         * Get the value of numLikes
         */ 
        public function getNumLikes():int
        {
                return $this->numLikes;
        }

        /**
         * Set the value of numLikes
         *
         * @return  self
         */ 
        public function setNumLikes($numLikes):void
        {
                $this->numLikes = $numLikes;
        }

        /**
         * Get the value of numDescargas
         */ 
        public function getnumDescargas():int
        {
                return $this->numDescargas;
        }

        /**
         * Set the value of numDescargas
         *
         * @return  self
         */ 
        public function setnumDescargas($numDescargas):void
        {
                $this->numDescargas = $numDescargas;
        }



        /**
         * Get the value of categoria
         */ 
        public function getCategoria()
        {
                return $this->categoria;
        }

        /**
         * Set the value of categoria
         *
         * @return  self
         */ 
        public function setCategoria($categoria)
        {
                $this->categoria = $categoria;
        }

        public function toArray() : array{
                return[
                        'id' => $this->getId(),
                        'nombre' => $this->getNombre(),
                        'descripcion' => $this->getDescripcion(),
                        'numVisualizaciones' => $this->getNumVisualizaciones(),
                        'numLikes' => $this->getNumLikes(),
                        'numDescargas' => $this->getnumDescargas(),
                        'categoria' => $this->getCategoria()
                ];
        }


       

    }


?>