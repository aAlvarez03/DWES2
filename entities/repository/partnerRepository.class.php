<?php
    require_once 'entities/queryBuilder.class.php';

    class PartnerRepository extends QueryBuilder {
        public function __construct(string $table = 'asociados', string $classEntity='partner')
        {
            parent::__construct($table, $classEntity);
        }
    }
?>