<?php

// const ERRORS = [
//     'MV_UP_FILE' => 9,
//     'EXECUTE_STATEMENT' => 10,
//     'APP_CORE' => 11,
//     'CON_DB' => 12,
//     'INS_BD' => 13,
//     'NOT_FOUND' => 14,
//     'TRANSACTION' => 15,
//     'NOT_SUPP_FILE' => 16,
// ];


    function getErrorStrings ($error) {
        $errorDevuelto = match($error){
            UPLOAD_ERR_OK => "No hay ningun error.",
            UPLOAD_ERR_INI_SIZE => "El fichero es demasiado grande.",
            UPLOAD_ERR_FORM_SIZE => "El fichero es demasiado grande.",
            UPLOAD_ERR_PARTIAL => "No se ha podido subir el fichero.",
            UPLOAD_ERR_NO_FILE => "No se ha encontrado ningún archivo.",
            UPLOAD_ERR_NO_TMP_DIR => "No existe el directorio temporal.",
            UPLOAD_ERR_CANT_WRITE => "No se puede escribir.",
            UPLOAD_ERR_EXTENSION => "Error de extension de archivo.",
            // creados por mi
            'MV_UP_FILE' => "No se ha podido mover el archivo.",
            'EXECUTE_STATEMENT' => "No se ha podido ejecutar la consulta.",
            'APP_CORE' => "No se ha encontrado la clave en el contenedor.",
            'CON_DB' => "No se ha podido crear la conexión con la base de datos.",
            'INS_BD' => "Error al insertar en la BD.",
            'NOT_FOUND' => "No se ha encontrado ningún elemento con ese id",
            'TRANSACTION' => "No se ha podido realizar la operación",
            'NOT_SUPP_FILE' => "Tipo de fichero no soportado."
        } ;
        return $errorDevuelto;
    };

    // function getErrorStrings($errorCode){
    //     // Verifica si el código de error existe en ERROR_STRINGS
    //     if (array_key_exists($errorCode, ERROR_STRINGS)) {
    //         return ERROR_STRINGS[$errorCode];
    //     }
    //     return "Error desconocido.";
    // }
    

?>