<?php
/*
 * Created by PhpStorm.
 * User: Janet
 * Date: 22/02/2016
 * Time: 16:50
 */
include 'accessTokenFacebook.php';

$uname = $userNode->getName();
$uId = $userNode->getId();

$mysqli = new mysqli('localhost', 'root', '', 'facebook');

$query = $mysqli->query("SELECT * FROM users WHERE oauth_provider = 'facebook' AND oauth_uid = ". $uId);
