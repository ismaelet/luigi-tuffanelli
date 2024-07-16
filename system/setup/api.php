<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//store the request
$request = explode('/', explode('/api/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))[1]);

if (empty($request[0])) header('HTTP/1.1 400 Bad Request');
else {

	//store the method
	$requestMethod = $_SERVER['REQUEST_METHOD'];

	//store the ID
	$id = isset($request[1]) ? explode('?', $request[1])[0] : false;

	//process the request
	$controller = new APIController();
	$controller->processRequest($request, $requestMethod, $id);

}