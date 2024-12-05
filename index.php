<?php
    require_once 'utils/bootstrap.php';

    try{
        require Router::load('utils/routes.php')->direct(Request::uri()); 
    }catch(NotFoundException $e){
        die($e->getMessage());
    }
?>