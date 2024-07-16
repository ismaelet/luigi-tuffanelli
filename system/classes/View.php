<?php

class View {
	
	public $name;
	public $title; public $page_title;
	public $loc;
	public $styles;
	public $scripts;
	public $middlewares = ['public'];
	public $preload = [];
	public $template = 'main';
	public $path;
	public $url;
	public $variabiles = [];
	public $stored = [];

	function __construct($name) {

		$this->name = $name;
		$this->loc = $name;

	}

	//setup page
	public function show() {

		global $user;

		//setup assets
		$this->styles = new Styles($this);
		$this->scripts = new Scripts($this);
		$this->set('favicon', favicon());

		//set page title
		if (isset($this->title)) $this->title($this->title);

		else {

			$page_title = sysData('name');
			
			if (!empty(sysData('desc_shr_'.sysData('lang')))) $page_title .= ' | '.sysData('desc_shr_'.sysData('lang'));

			$this->page_title = $page_title;
		}

		//save url
		$this->url = __SERVER_ROOT__.'/pages/views/'.$this->name.'.php';

		//add middleware
		foreach ($this->middlewares as $name) load_middleware($name, $user, $this);

		//add logic
		$this->add_logic($this->template, 'template');
		$this->add_logic($this->name, 'page');

		//setup google analytics
		$this->start_analytics();

		//render page
		$viewer = new Viewer($this);
		$viewer->show();

	}

	//variables
	public function set($var, $value) {

		if (is_array($value) && isset($this->variables[$var])) $this->variables[$var] = array_merge($this->variables[$var], $value);
		else $this->variables[$var] = $value;

	}
	
	public function get($var) { return $this->variables[$var] ?? null; }

	//add logic
	public function add_logic($file, $type) {

		$exists = false;

		if ($type == 'template') {

			if (file_exists($file_exists = __SERVER_ROOT__ . '/app/templates/logic/' . $file . '.php')) $exists = $file_exists;
			else if (file_exists($file_exists = __SERVER_ROOT__ . '/system/templates/logic/' . $file . '.php')) $exists = $file_exists;

		} else if ($type == 'page')
			if (file_exists($file_exists = __SERVER_ROOT__ . '/pages/logic/' . $file . '.php')) $exists = $file_exists;
			
		else if ($type == 'static')
			if (file_exists($file)) $exists = $file;
			
		if ($exists) {

			include_once($exists);

			unset($type);
			unset($file);
			unset($file_exists);
			unset($exists);

			$variables = get_defined_vars();

			foreach ($variables as $key => $value) $this->set($key, $value);

		}

	}

	//page title
	public function title($title) {

		$this->title = $title;
		$this->page_title = $title.' | '.sysData('name');

	}
	
	//google analytics
	private function start_analytics() {

		$this->set('google_analytics', google_analytics($this->get('user')));
		$this->set('facebook_pixel',facebook_pixel());
		
	}
	
}