<?php

require_once 'entities/queryBuilder.class.php';

class MessageRepository extends QueryBuilder {
    public function __construct(string $table = 'mensajes', string $classEntity='message')
    {
        parent::__construct($table, $classEntity);
    }
}