<?php
require_once 'utils/strings.php';
require_once 'exceptions/queryException.class.php';
    class QueryBuilder
    {
        /**
         * @var PDO
         */
        private $connection;

        /**
         * @param PDO $connection
         */
        public function __construct(PDO $connection)
        {
            $this->connection=$connection;
        }

        public function findAll(string $table, string $classEntity)
        {
            $sql = "SELECT * from $table"; // Sentencia sql a ejecutar

            $pdoStatement = $this->connection->prepare($sql);

            
            if($pdoStatement->execute() === false){
                throw new QueryException(ERROR_STRINGS[ERROR_EXECUTE_STATEMENT]);
            }

            return $pdoStatement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $classEntity);
        }
    }
?>