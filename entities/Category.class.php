<?php
    require_once 'database/IEntity.class.php';

    class Category implements IEntity {
        private $id;
        private $nombre;
        private $numImagenes;

        public function __construct(string $nombre ='', int $numImagenes = 0)
        {
            $this->nombre = $nombre;
            $this->numImagenes = $numImagenes;
        }

       // Getters

        public function getId() {
            return $this->id;
        }

        public function getNombre() {
            return $this->nombre;
        }

        public function getNumImagenes() {
            return $this->numImagenes;
        }

        // Setter de numImagenes

        public function setNumImagenes($numImagenes) {
            $this->numImagenes = $numImagenes;
        }

        public function toArray():array
        {
            return [
                'id'=> $this->id,
                'nombre' => $this->nombre,
                'numImagenes' => $this->numImagenes
            ];
        }

        
    }
?>