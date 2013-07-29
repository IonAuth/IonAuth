<?php
require 'vendor/autoload.php';
require 'BenEdmunds/ionauth/Auth.php';

$app = new \Slim\Slim();


$app->get('/', function () {

	$authConfig = require 'config/IonAuth.php';
	$auth = new \BenEdmunds\IonAuth\Auth($authConfig);

	var_dump($auth->login('admin@admin.com', 'password'));
	var_dump($auth->errors());

});


$app->run();
