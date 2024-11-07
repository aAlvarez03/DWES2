<?php
require_once 'utils/strings.php';
require_once 'exceptions/queryException.class.php';
require_once 'entities/app.class.php';
    abstract class QueryBuilder
    {
        /**
         * @var PDO
         */
        private $connection;
        /**
         * @var string
         */
        private $table;
        /**
         * @var string
         */
        private $classEntity;

        /**
         * @param PDO $connection
         */
        public function __construct(string $table, string $classEntity)
        {
            $this->connection=App::getConnection();
            $this->table = $table;
            $this->classEntity = $classEntity;
        }

        public function findAll()
        {
            $sql = "SELECT * from $this->table"; // Sentencia sql a ejecutar

            $pdoStatement = $this->connection->prepare($sql);

            
            if($pdoStatement->execute() === false){
                throw new QueryException(ERROR_STRINGS[ERROR_EXECUTE_STATEMENT]);
            }

            return $pdoStatement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->classEntity);
        }

        public function save(IEntity $entity){
            
                $parameters = $entity->toArray();

                $sql = sprintf('insert into %s (%s) values (%s)',
                $this->table,
                implode(', ',array_keys($parameters)),
                ':' . implode(',:',array_keys($parameters))); //:id, :nombre, :descripcion

            try{
                $statement = $this->connection->prepare($sql);
                $statement->execute($parameters);
            }
            catch(PDOException $exception){
                throw new QueryException(getErrorStrings(ERROR_INS_BD));
            }
            
        }
    }
?>