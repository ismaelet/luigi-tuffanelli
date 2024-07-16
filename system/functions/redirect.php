<?php

//general redirect
function redirect($path = false) {
	
	if (empty($path))
		$url = $_SERVER['REQUEST_URI'];

	else if ($path[0] == '/')
		$url = html_link(ltrim($path, '/'));

	else
		$url = $path;

	header('Location: ' . $url);

	exit();
	
}