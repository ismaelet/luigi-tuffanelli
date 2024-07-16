<?php

//format numbers
function format($n) {

	$n = (float) $n;

	return number_format($n, 2, '.', '');

}

function formatc($n) {
	
	$n = (float) $n;

	return number_format($n, 2, ',', '');

}

function random_string($length = 10) {

	$characters = '0123456789abcdefghijklmnopqrstuvwxyz';

	$charactersLength = strlen($characters);

	$randomString = '';

	for ($i = 0; $i < $length; $i++) $randomString .= $characters[rand(0, $charactersLength - 1)];

	return $randomString;

}

function format_bytes($bytes, $decimals = 0) {

	$symbols = array('B', 'KB', 'MB', 'GB', 'TB');

	$exp = floor(log($bytes) / log(1024));

	$formatedBytes = round($bytes / pow(1024, $exp), $decimals) . ' ' . $symbols[$exp];

	return $formatedBytes;

}