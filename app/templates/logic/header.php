<?php

global $user;

//add resources
$this->styles->add(__SERVER_ROOT__.'/app/templates/styles/header.css');
$this->scripts->add(__SERVER_ROOT__.'/app/templates/scripts/header.js');

//setup variables
$links = [];

//theme
$header['color'] = 'light';
$header['floating'] = false;
$header['sticky'] = false;

//elements
$header['logo'] = false;
$header['name-bar'] = false;
$header['srch-bar'] = false;
$header['lang-bar'] = true;
$header['login'] = true;
$header['force-mob'] = false;
$header['privacy'] = false;
$header['wishlist'] = false;
$header['cart'] = false;
$header['theme-switch'] = false;

//name
$header['name'] = sysData('name');
$header['name-mob'] = $header['name'];

//links
$header['links'] = [];

$links[] = ['title' => 'Home', 'loc' => 'home', 'url' => html_link('')];

foreach ($links as $link) {

	$valid = true;

	//check logged filter
	if (isset($link['logged'])) {

		if ($link['logged'] && !$user->id) $valid = false;
		else if (!$link['logged'] && $user->id) $valid = false;

	}

	//check admin filter
	if (isset($link['admin']) && !$user->admin) $valid = false;

	//check manager filter
	if (isset($link['manager']) && !$user->manager) $valid = false;

	//check cart filter
	if (isset($link['cart']) && !$user->cart_count) $valid = false;

	//add it to the list if valid
	if ($valid) $header['links'][] = $link;

}

//dropdowns
/*$header['dropdowns']['*dropdown-name*'] = [
	['Title', html_link('link')],
];*/

//login bar
$header['login-link'] = ['Login', html_link('login')];
if (!sysData('static')) $header['logged-link'] = [$user->username, html_link('profile')];

//store variabiles
$this->set('header', $header);