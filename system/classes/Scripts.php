<?php

class Scripts {

	private $list = [];

	function __construct($view) {

		//add framework scripts
		$files = glob(__SERVER_ROOT__ . '/system/scripts/*.js');
		foreach ($files as $file) $this->add($file, 1);

		//add app scripts
		$files = glob(__SERVER_ROOT__ . '/app/scripts/*.js');
		foreach ($files as $file) $this->add($file, 2);

		//add template script
		if (file_exists($file = __SERVER_ROOT__ . '/app/templates/scripts/' . $view->template . '.js')) $this->add($file, 2);
		else if (file_exists($file = __SERVER_ROOT__ . '/system/templates/scripts/' . $view->template . '.js')) $this->add($file, 2);

		//add page script
		if (file_exists($file = __SERVER_ROOT__ . '/pages/scripts/' . $view->name . '.js')) $this->add($file, 4);

		//add additional page scripts
		$files = glob(__SERVER_ROOT__ . '/pages/scripts/-expands-' . $view->name . '/*.js');
		foreach ($files as $file) $this->add($file, 5);

	}

	//load a script
	public function add($file, $priority = 3) {

		$file .= '?v=' . filemtime($file); 
			
		$this->list[] = $priority . '<script src="' . parse_html($file) . '"></script>' . PHP_EOL;

	}

	//load all the scripts
	public function load() {

		$list = [];

		asort($this->list);

		foreach ($this->list as $script) $list[] = substr($script, 1);
		
		return implode('', $list);

	}

}