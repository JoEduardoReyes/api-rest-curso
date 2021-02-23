<?php

//Definimos los recursos dispoibles
$allowedResourceTypes = [
  'books',
  'authors',
  'genres',
];

// validamos que que el recurso este disponible
$resourceType = $_GET['resource_type'];

if(!in_array($resourceType, $allowedResourceTypes)) {
  die;
}

//defino los recursos
$books = [
	1 => [
		'titulo' => 'Lo que el viento se llevo',
		'id_autor' => 2,
		'id_genero' => 2,
	],
	2 => [
		'titulo' => 'La Iliada',
		'id_autor' => 1,
		'id_genero' => 1,
	],
	3 => [
		'titulo' => 'La Odisea',
		'id_autor' => 1,
		'id_genero' => 1,
	],
];

header('Content-type: application/json');

//aqui levantamos el ID del recurso buscado
$resourceID = array_key_exists('resource_id', $_GET) ? $_GET['resource_id'] : '';

// Generamos la respuesta si el pedido es correcto
switch ( strtoupper($_SERVER['REQUEST_METHOD'])) {
  case 'GET':
    if ( empty($resourceID)) {
      echo json_encode($books);
    } else {
      if (array_key_exists($resourceID, $books)) {
        echo json_encode($books[$resourceID]);
      }
    }
    break;
  case 'POST':
    $json = file_get_contents('php://input');
    //hacemos que el server lea el archivo json
    $books[] = json_decode($json, true);
    //hacemos que se agrege el nuevo json a $books
    // echo array_keys( $books )[ count($books) - 1];
    //hacemos que el agregado se agregue despues del ultimo elemento existente
    echo json_encode( $books );
    break;
  case 'PUT':
    break;
  case 'DELETE':
    break;
};

