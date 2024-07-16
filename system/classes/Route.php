<?php

class Route {

	private static $routes = [];

	public static function add($paths, $function, $arguments = false) {

		$paths = (array) $paths;

		foreach ($paths as $path)

			array_push(self::$routes, [
				'path' => __HTML_ROOT__ . $path,
				'function' => $function,
				'arguments' => $arguments,
			]);
	}

	public static function run() {

		$path_found = false;

		//parse url
		$path = parse_url($_SERVER['REQUEST_URI'])['path'];

		if (strpos($path, $api_url = '/api/')) include_once(__SERVER_ROOT__.'/system/setup/api.php');

		else {

			foreach (self::$routes as $route) {

				// Check path match	
				if ((in_array($path, [$route['path'], $route['path'] . '/'])) || (strpos($route['path'], '*') && strpos($path, rtrim($route['path'], '/*')) !== false)) {

					$path_found = true;

					call_user_func_array($route['function'], [$route['arguments']]);

					break;

				}

			}
			
			//error 404
			if (!$path_found) {

				$view = new View('errors/404');
				$view->title = 'Error 404';
				$view->template = 'void';
				$view->middlewares = [];

				$view->show();
				
			}

		}

	}
}
