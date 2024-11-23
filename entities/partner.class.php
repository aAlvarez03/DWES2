<?php
require_once 'database/IEntity.class.php';

    class Partner implements IEntity
    {
        private $id;
        private $nombre;
        private $logo;
        private $descripcion;
        const RUTA_IMAGENES_GALLERY='images/index/gallery/';

        public function __construct($nombre='', $logo='', $descripcion='')
        {
            $this->id = null;         
            $this->nombre = $nombre;
            $this->logo = $logo;
            $this->descripcion = $descripcion;
        }


        // Devuelve el objeto como un array

    public function toArray():array {
        return [
            'nombre' => $this->nombre,
            'logo' => $this->logo,
            'descripcion' => $this->descripcion
        ];
    }

        public function getUrlLogo(){
                return self::RUTA_IMAGENES_GALLERY.$this->logo;
        }

        public function getId(){
                return $this->id;
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
         * Get the value of logo
         */ 
        public function getLogo():string
        {
                return $this->logo;
        }

        /**
         * Set the value of logo
         *
         * @return  self
         */ 
        public function setLogo($logo):void
        {
                $this->logo = $logo;
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
    }
?>