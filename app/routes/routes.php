<?php

//home
Route::add('/', function() {

	//create view
	$view = new View('home');

	//render view
	$view->show();

});