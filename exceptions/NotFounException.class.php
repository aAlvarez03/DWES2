<?php
    class NotFoundException extends Exception{
        public function __construct(string $mensaje)
        {
            parent::__construct($mensaje);
        }
    }
?>