<?php

    define('ERROR_MV_UP_FILE',9);
    define('ERROR_EXECUTE_STATEMENT', 10);
    define('ERROR_APP_CORE', 11);
    define('ERROR_CON_DB', 12);
    define('ERROR_INS_BD', 13);
    define('ERROR_NOT_FOUND', 14);
    define('ERROR_TRANSACTION', 15);


    $errorStrings[UPLOAD_ERR_OK] = "No hay ningun error.";
    $errorStrings[UPLOAD_ERR_INI_SIZE] = "El fichero es demasiado grande.";
    $errorStrings[UPLOAD_ERR_FORM_SIZE] = "El fichero es demasiado grande.";
    $errorStrings[UPLOAD_ERR_PARTIAL] = "No se ha podido subir el fichero.";
    $errorStrings[UPLOAD_ERR_NO_FILE] = "No se ha encontrado ningún archivo.";
    $errorStrings[UPLOAD_ERR_NO_TMP_DIR] = "No existe el directorio temporal.";
    $errorStrings[UPLOAD_ERR_CANT_WRITE] = "No se puede escribir.";
    $errorStrings[UPLOAD_ERR_EXTENSION] = "Error de extension de archivo.";
    $errorStrings[ERROR_MV_UP_FILE] = "No se ha podido mover el archivo.";
    $errorStrings[ERROR_EXECUTE_STATEMENT] = "No se ha podido ejecutar la consulta.";
    $errorStrings[ERROR_APP_CORE] = "No se ha encontrado la clave en el contenedor.";
    $errorStrings[ERROR_CON_DB] = "No se ha podido crear la conexión con la base de datos.";
    $errorStrings[ERROR_INS_BD] = "Error al insertar en la BD.";
    $errorStrings[ERROR_NOT_FOUND] = "No se ha encontrado ningún elemento con ese id";
    $errorStrings[ERROR_TRANSACTION] = "No se ha podido realizar la operación";

    define('ERROR_STRINGS', $errorStrings);

    function getErrorStrings($errorCode){
        return ERROR_STRINGS[$errorCode];
    }
    

?>