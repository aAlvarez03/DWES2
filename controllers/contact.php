<?php
	require 'utils/utils.php';
	require_once 'entities/message.class.php';
	require_once 'entities/repository/messageRepository.class.php';
	require_once 'entities/connection.class.php';
	
	
	$array_error = [];

	try{
		// Se crea la conexión con la base de datos

		$mensajeRepositorio = new MessageRepository();

		if($_SERVER['REQUEST_METHOD'] === 'POST'){

			/* Obtenemos los datos de cada campo con el metodo POST */
			$nombre = trim(htmlspecialchars($_POST['firstName']));
			$apellido = trim(htmlspecialchars($_POST['lastName']));
			$correo = trim(htmlspecialchars($_POST['mail']));
			$asunto = trim(htmlspecialchars($_POST['subject']));
			$mensaje = trim(htmlspecialchars($_POST['message']));
	
	
			/* Comprobamos posibles errores */
			if(empty($_POST['firstName'])){
				$array_error[] = 'El campo First Name es obligatorio';
			}
	
			if (empty($correo)) {
				$array_error[] = 'La dirección de correo no puede estar vacía';
			} else if (filter_var($correo, FILTER_VALIDATE_EMAIL) === false) {
				$array_error[] = 'La dirección de correo es incorrecta';
			}
	
			if(empty($_POST['subject'])){
				$array_error[] = 'El campo Subject es obligatorio';
			}

			/* Guardamos los datos en un array de datos */	
			$dats = [
				'Nombre' => $nombre,
				'Apellidos' => $apellido,
				'Email' => $correo,
				'Asunto' => $asunto,
				'Mensaje' => $mensaje
			];

			/* Si no hay ningún error se crea el mensaje y se guarda en la base de datos */
			if(empty($array_error)){
				$mensaje = new Message($nombre, $apellido, $correo, $asunto, $mensaje);
				$mensajeRepositorio->save($mensaje);
			}
			
		}
	}catch(QueryException | AppException $exception){
		$array_error[] = $exception->getMessage();
	}

	require 'views/contact.view.php';
?>