<?php

global $sysData;

$sysData = [

	//general settings
	'static' => true,
	'timezone' => 'Europe/Rome',

	//e-mail
	'mail-host' => 'mail.domainurl.com',
	'mail-username' => 'noreply@domainurl.com',
	'mail-passsword' => 'mailpassword',

	//name
	'name' => '',
	'name-full' => '',
	'desc-it' => '',
	'desc-shr-it' => '',
	'desc-en' => '',
	'desc-shr-en' => '',
	'desc-pt' => '',
	'desc-shr-pt' => '',

	//language
	'lang' => 'it',
	'lang-all' => [['Italiano', 'it'], ['English', 'en']],
	'multi-lang' => false,

	//logo
	'logo' => '/app/resources/logo/logo.jpg',

	//business data
	'VAT' => '',

	//contacts
	'cont-facebook' => '',
	'cont-facebook-link' => '',
	'cont-instagram' => '@',
	'cont-instagram-link' => '',
	'cont-youtube' => '',
	'cont-spotify' => '',
	'cont-twitter' => '',
	'cont-twitter-link' => '',
	'cont-mail' => 'lgtuffanelli@gmail.com',
	'cont-mail-link' => 'mailto:lgtuffanelli@gmail.com',
	'cont-tel' => '0000000000',
	'cont-tel-link' => 'tel:0000000000',
	'cont-whatsapp' => '+39 333 4366890',
	'cont-whatsapp-link' => 'https://wa.me/393334366890',
	'cont-telegram' => '',
	'cont-pinterest' => '',
	'cont-pinterest-link' => '',
	'cont-tiktok' => '',
	'cont-tiktok-link' => '',
	'cont-web-link' => '',

	//third party integrations
	'google-analytics' => false,
	'facebook-pixel' => false,

];

$rootPath = dirname(__DIR__, 2);

require_once $rootPath . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable($rootPath);
$dotenv->safeLoad();

$sysData['hostname'] = $_ENV['DB_HOST'] ?? 'localhost';
$sysData['database'] = $_ENV['DB_DATABASE'] ?? '';
$sysData['username'] = $_ENV['DB_USERNAME'] ?? '';
$sysData['password'] = $_ENV['DB_PASSWORD'] ?? '';