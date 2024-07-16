<?php

start_functions();

function start_functions() {

	//load system functions
	$modules = glob(__SERVER_ROOT__.'/system/functions/*.php', GLOB_BRACE);

	foreach ($modules as $module) include_once($module);

	//load app functions
	$modules = glob(__SERVER_ROOT__.'/app/functions/*.php', GLOB_BRACE);

	foreach ($modules as $module) include_once($module);
}
