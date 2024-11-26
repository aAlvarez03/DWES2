<?php
require_once 'utils/strings.php';
require_once 'exceptions/queryException.class.php';
require_once 'exceptions/NotFounException.class.php';
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

        public function executeQuery(string $sql) : array {
            $pdoStatement = $this->connection->prepare($sql);

            if($pdoStatement->execute() === false){
                throw new QueryException(getErrorStrings('EXECUTE_STATEMENT'));
            }

            return $pdoStatement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->classEntity);
        }

        public function findAll()
        {
            $sql = "SELECT * FROM $this->table"; // Sentencia sql a ejecutar
            return $this->executeQuery($sql);
        }

        public function find(int $id): IEntity{
            $sql = "SELECT * FROM $this->table WHERE id=$id";
            $result = $this->executeQuery($sql);

            if(empty($result)){
                throw new NotFoundException(getErrorStrings('NOT_FOUND'));
            }
            return $result[0];
        }

        // Funcion para incrementar el numero de imagenes que contiene una categoria
        public function incrementaNumCategoria(int $categoria){
            try{
                $this->connection->beginTransaction();
                $sql = "UPDATE categorias SET numImagenes=numImagenes+1 WHERE id=$categoria";
                $this->connection->exec($sql);
                $this->connection->commit();
            }catch(PDOException $exception){
                $this->connection->rollBack();
                throw new QueryException(getErrorStrings('TRANSACTION'));
            }
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

                if($entity instanceof imagenGaleria){
                    $this->incrementaNumCategoria($entity->getCategoria()); //Si es una imagen lo que hay en la tabla, incrementa el número de imagenes correspondiente en la tabla categorias
                }
            }
            catch(PDOException $exception){
                throw new QueryException(getErrorStrings('INS_BD'));
            }
            
        }
    }
?>