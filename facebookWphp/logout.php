<?php
/**
 * Created by PhpStorm.
 * User: Janet
 * Date: 10/02/2016
 * Time: 20:34
 */
include 'fHeaders.php';
if(isset($_GET['action']) && $_GET['action'] == 'logout'){

    //$fb->destroySession();
    $next_url = 'localhost'.dirname($_SERVER['PHP_SELF'])."login.php";
    echo $next_url;
    //$fb->getLogoutUrl($_SESSION['facebook_access_token'], $next_url);
    session_destroy();
    header('Location: login.php');
    echo 'logging Out';
}