<?php
    class Request{
        public static function uri(){
            return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
            //Obtener la URL del usuario limpiando barras existentes tanto al principio como al final (para que quede igual que en los indices del array de la tabla de rutas)
        }

        public static function method() {
            return $_SERVER['REQUEST_METHOD'];
        }
    }
?>