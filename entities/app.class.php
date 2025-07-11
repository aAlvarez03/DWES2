<?php
require_once 'exceptions/AppException.class.php';
require_once 'utils/strings.php';
require_once 'connection.class.php';
    class App
    {
        /**
         * @var Array
         */
        private static $container = [];

        public static function bind($clave, $valor){
            self::$container[$clave] = $valor;
        }

        public static function get(string $key){
            if(!array_key_exists($key, self::$container)){
                // throw new AppException(ERROR_STRINGS[ERROR_APP_CORE]);
                throw new AppException(getErrorStrings('APP_CORE'));
            }
            return self::$container[$key];
        }

        public static function getConnection(){
            if(!array_key_exists('connection', self::$container)){
                self::$container['connection'] = Connection::make();
            }
            return self::$container['connection'];
        }
    }
?>