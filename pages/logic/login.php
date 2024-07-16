<?php

//setup page
$header['floating'] = true;

//setup variabiles
$error = false;

//login
if (isset($_POST['submit'])) {

	$username = $_POST['username'];
	$password = $_POST['password'];
	$remember = isset($_POST['remember']);
	$url = $_POST['url'] ?? false;

	$error = login($username, $password, $url, $remember);
	
}