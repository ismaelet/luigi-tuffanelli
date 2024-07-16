<?php

class APIController {
	
	public function processRequest($request, $requestMethod, $id = false) {

		$data = empty(file_get_contents('php://input')) ? false : (array) json_decode(file_get_contents('php://input'), TRUE);

		switch ($requestMethod) {

			case 'GET': $response = $this->get($request, $id); break;
			case 'PATCH': $response = $this->patch($request, $id); break;
			case 'PUT': $response = $this->put($request, $id); break;
			case 'POST': $response = $this->post($request, $id); break;
			case 'DELETE': $response = $this->delete($request, $id); break;
			default: $response['header'] = 'HTTP/1.1 405 Method Not Allowed'; break;

		}

		//submit the results
		if (isset($response['header'])) header($response['header']);
		if (isset($response['content'])) echo json_encode($response['content']);

	}

	/*
	* GET
	*/
	private function get($request, $id) {

		$config = [];
		$result = [];

		//set the requested fields
		if (!empty(file_get_contents('php://input'))) $data = (array) json_decode(file_get_contents('php://input'), TRUE);
		else if (!empty($_GET)) $data = $_GET;
		else $data = false;

		//parse the object settings
		if (isset($_GET['config'])) {

			$configRaw = explode(';', $_GET['config']);

			foreach ($configRaw as $val) {

				$paramenter = explode(':', $val);

				$config[$paramenter[0]] = $paramenter[1];

			}

		}

		//create the object
		if ($id) {

			$class = ucfirst($request[0]);
			$object = new $class($id, $config);

			//return requested fields
			if ($object->id) {

				$response['header'] = 'HTTP/1.1 200 OK';

				//if some fields are requested
				if (isset($data['fields'])) {

					$fields = explode(';', $data['fields']);

					foreach ($fields as $field) {

						//if the request is a property
						if (isset($object->{$field})) $result[$field] = $object->{$field};

						//if the request is a function
						else if (method_exists($object, $field)) {

							//if the function has agruments
							if (isset($data[$field.'-args'])) $result[$field] = $object->{$field}(...explode(';', $data[$field.'-args']));
							//if it doesn't
							else $result[$field] = $object->{$field}();

						}

					}

				//if no fields are requested return then whole object
				} else $result = $object;

				//store the results
				$response['content'] = $result;

			} else $response['header'] = 'HTTP/1.1 404 Not Found';

		} else {

			$where = [];
			$values = [];

			$tbl = ucfirst($request[0]);

			if (!empty($config)) {

				$where = [];

				foreach ($config as $name => $value) {

					$where[] = $name == 'apiValue' ? $data['apiField'] . " LIKE CONCAT('%',?,'%')" : $name . '=?';
					$values[] = $value;

				}

			}

			$fields = str_replace(';', ',', $data['fields']);

			$where = 'WHERE ' . implode(' AND ', $where);

			$limit = empty($data['limit']) ? '' : 'LIMIT ' . $data['limit'];

			$query = $fields . ' FROM ' . $tbl . ' ' . $where . ' ' . $limit;

			$result = DB::select($query, $values);

			$response['header'] = 'HTTP/1.1 200 OK';
			$response['content'] = $result;

		}

		return $response;

	}

	/*
	* PATCH
	*/
	private function patch($request, $id) {

		//set the requested fields
		if (!empty(file_get_contents('php://input'))) $data = (array) json_decode(file_get_contents('php://input'), TRUE);
		else if (!empty($_POST)) $data = $_POST;
		else $data = false;

		$class = 'API\\'.ucfirst($request[0]).'Request';
		$result = (new $class())->update($id, $data);
	
		$response['header'] = 'HTTP/1.1 200 OK';
		$response['content'] = $result->stmt->affected_rows;

		return $response;

	}

	/*
	* PUT
	*/
	private function put($request) {

		//set the requested fields
		if (!empty(file_get_contents('php://input'))) $data = (array) json_decode(file_get_contents('php://input'), TRUE);
		else if (!empty($_POST)) $data = $_POST;
		else $data = false;

		$class = 'API\\'.ucfirst($request[0]).'Request';
		$result = (new $class())->put($data);
	
		$response['header'] = 'HTTP/1.1 200 OK';
		$response['content'] = $result->stmt->affected_rows;

		return $response;

	}

	/*
	* POST
	*/
	private function post($request) {

		//set the requested fields
		if (!empty(file_get_contents('php://input'))) $data = (array) json_decode(file_get_contents('php://input'), TRUE);
		else if (!empty($_POST)) $data = $_POST;
		else $data = false;

		$class = 'API\\'.ucfirst($request[0]).'Request';
		$result = (new $class())->add($data);
		
		if (empty($result['id'])) $response['header'] = 'HTTP/1.1 422 Unprocessable Entity';
		else {
			$response['header'] = 'HTTP/1.1 201 Created';
			$response['content'] = $result;
		}

		return $response;

	}

	/*
	* DELETE
	*/
	private function delete($request, $id) {

		//set the requested fields
		if (!empty(file_get_contents('php://input'))) $data = (array) json_decode(file_get_contents('php://input'), TRUE);
		else if (!empty($_POST)) $data = $_POST;
		else $data = false;

		$class = 'API\\'.ucfirst($request[0]).'Request';
		$result = (new $class())->delete($id, $data);
	
		$response['header'] = 'HTTP/1.1 200 OK';
		$response['content'] = $result->stmt->affected_rows;

		return $response;

	}

}