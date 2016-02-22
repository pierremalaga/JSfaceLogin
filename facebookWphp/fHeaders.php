<?php
/**
 * Created by PhpStorm.
 * User: pmalaga
 * Date: 19/01/2016
 * Time: 13:07
 */
//API REFERENCE https://developers.facebook.com/docs/php/api/5.0.0
//SIGUIENDO LA GUIA: https://developers.facebook.com/docs/php/gettingstarted
require_once 'sdk/src/Facebook/autoload.php';
session_start();
$appID = "1636838979911521";
$APIVersion = "v2.5";
$appSecret = "34c3c5587eeeb3119d4c2f34c3bcd9e9";
$fb = new Facebook\Facebook([
    'app_id' => $appID,
    'app_secret' => $appSecret,
    'default_graph_version' => 'v2.5',
]);

?>

