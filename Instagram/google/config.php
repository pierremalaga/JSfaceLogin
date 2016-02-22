<?php


require_once 'include/google-api-php-client/apiClient.php';
require_once 'include/google-api-php-client/contrib/apiOauth2Service.php';
require_once 'include/idiorm.php';
require_once 'include/relativeTime.php';


session_name('nombre-sesion');
session_start();


$host = 'localhost';
$user = '';
$pass = '';
$database = '';

ORM::configure("mysql:host=$host;dbname=$database");
ORM::configure('username', $user);
ORM::configure('password', $pass);

ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

//configuracion de google console api
$redirect_url = ''; 
$client_id = '';
$client_secret = '';
$api_key = '';
