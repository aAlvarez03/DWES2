<?php
    require_once 'entities/queryBuilder.class.php';

    class CategoryRepository extends QueryBuilder {
        public function __construct(string $table = 'categorias', string $classEntity='Category')
        {
            parent::__construct($table, $classEntity);
        }
    }
?>