<?php
    require_once 'database/IEntity.class.php';

    class Category implements IEntity {
        private $id;
        private $nombre;
        private $numImagenes;

        public function __construct(string $nombre = '', int $numImagenes = 0)
        {
            $this->nombre = $nombre;
            $this->numImagenes = $numImagenes;
        }

        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        public function toArray(): array
        {
            return [
                'id'=> $this->id,
                'nombre' => $this->nombre,
                'numImagenes' => $this->numImagenes
            ];
        }

        
    }
?>