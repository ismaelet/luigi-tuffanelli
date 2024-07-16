<?php

//setup global variables
global $user, $view;

//set migration status
$migration = true;

//start session
session_start();

//set constants
define('__SERVER_ROOT__', explode('/system', str_replace("\\", "/", __DIR__))[0]);
define('__HTML_ROOT__', str_replace(rtrim($_SERVER['DOCUMENT_ROOT'], '/'), '', __SERVER_ROOT__));
define('__ICONS__', '/system/resources/icons/');
define('__APP_ICONS__', '/app/resources/icons/');
define('__IMG__', '/app/resources/images/');
define('__LOGO__', '/app/resources/logo/');

//classes autoloader
spl_autoload_register(function($class) {

	$class = str_replace('\\', '/', $class);

	if (file_exists($file = __SERVER_ROOT__ . '/app/classes/' . $class . '.php')) include_once($file);
	else if (file_exists($file = __SERVER_ROOT__ . '/system/classes/' . $class . '.php')) include_once($file);
	else if (defined('__PUBLIC_ROOT__') && file_exists($file = __PUBLIC_ROOT__ . '/app/classes/' . $class . '.php')) include_once($file);

});

//basic configurations
include_once(__SERVER_ROOT__.'/app/config/config.php');

date_default_timezone_set($sysData['timezone']);

//connect
if (!$sysData['static']) {

	$con = new mysqli($sysData['hostname'], $sysData['username'], $sysData['password'], $sysData['database']) or exit('Can\'t connect to the database');
	$con->query('SET NAMES utf8');

}

//load basic resources
include_once('migration.php');
include_once('functions.php');
include_once('middlewares.php');
include_once('plugins.php');
foreach (scan('/app/routes', 'php') as $route) include_once($route);

//other basic paths
if (!isset($sysData['admin-domain'])) $sysData['admin-domain'] = html_link('admin');
if (!isset($sysData['logged-redirect'])) $sysData['logged-redirect'] = '/';

//recover login
if (!$sysData['static']) {

	if (!isset($_SESSION['user']) && isset($_COOKIE['auth_token'])) login_direct($_COOKIE['auth_token']);

	$userID = $_SESSION['user'] ?? 0;

	$user = new User($userID);
	
}

//recover theme color
$_SESSION['theme-color'] = $_COOKIE['theme-color'] ?? 'light';

//render page
Route::run();