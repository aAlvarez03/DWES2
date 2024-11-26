<?php
require_once 'database/IEntity.class.php';
    class Message implements IEntity {
        private $id;
        private $nombre;
        private $apellidos;
        private $asunto;
        private $email;
        private $texto;
        private $fecha;


        public function __construct($nombre = '', $apellidos = '', $asunto = '', $email = '', $texto = '')
        {
            $this->nombre = $nombre;
            $this->apellidos = $apellidos;
            $this->asunto = $asunto;
            $this->email = $email;
            $this->texto = $texto;
            $this->fecha = new DateTime();
        }

        // Funcion toArray de la entidad IEntity
        public function toArray(): array
        {
            return [
                'nombre' => $this->nombre,
                'apellidos' => $this->apellidos,
                'asunto' => $this->asunto,
                'email' => $this->email,
                'texto' => $this->texto,
                'fecha' => $this->fecha->format('Y-m-d H:i:s')
            ];
        }
    }
?>