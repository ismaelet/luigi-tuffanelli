<?php

class Styles {

	private $list = [];

	function __construct($view) {

		//add framework styles
		$files = glob(__SERVER_ROOT__ . '/system/styles/*.css');
		foreach ($files as $file) $this->add($file, 1);

		//add app styles
		$files = glob(__SERVER_ROOT__ . '/app/styles/*.css');
		foreach ($files as $file) $this->add($file, 2);

		//add template style
		if (file_exists($file = __SERVER_ROOT__ . '/app/templates/styles/' . $view->template . '.css')) $this->add($file, 2);
		else if (file_exists($file = __SERVER_ROOT__ . '/system/templates/styles/' . $view->template . '.css')) $this->add($file, 2);

		//add page style
		if (file_exists($file = __SERVER_ROOT__ . '/pages/styles/' . $view->name.'.css')) $this->add($file, 4);

		//add additional page styles
		$files = glob(__SERVER_ROOT__ . '/pages/styles/-expands-' . $view->name . '/*.css');
		foreach ($files as $file) $this->add($file, 5);

	}

	//add a style
	public function add($file, $priority = 3) {

		$file .= '?v=' . filemtime($file); 
			
		$this->list[] = $priority . '<link href="' . parse_html($file) . '" rel="stylesheet" type="text/css">' . PHP_EOL;

	}

	//load all the styles
	public function load() {

		$list = [];

		asort($this->list);

		foreach ($this->list as $style) $list[] = substr($style, 1);
		
		return implode('', $list);

	}
	
}