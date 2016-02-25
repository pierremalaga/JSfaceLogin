<?php
/**
 * Created by PhpStorm.
 * User: Janet
 * Date: 22/02/2016
 * Time: 16:48
 */

require 'Instagram/instagram/vendor/cosenary/instagram/src/Instagram.php';
use MetzWeb\Instagram\Instagram;

//Instagram Headers Info
define("ClientId", '4b87123820284ed68e7d9b1673f67565');
define("ClientSECRET", 'f7421349bc7942539c8ad267c426f3e3');
define("redirectURL", 'http://localhost/JSfaceLogin/main.php');

$insta = new Instagram(array(
    'apiKey'      => '4b87123820284ed68e7d9b1673f67565', //client id
    'apiSecret'   => 'f7421349bc7942539c8ad267c426f3e3', //client secret
    'apiCallback' => 'http://localhost/JSFaceLogin/main.php'
));

/* Facebook Headers */
require 'facebookWphp/fHeaders.php';

?>
<!-- HTML Header -->
<html DOCTYPE!>
<head>
    <link rel="stylesheet" href="styles/menu.css"/>
    <link rel="stylesheet" href="facebookWphp/style/mainStyle.css"/>
    <link rel="stylesheet" href="http://weloveiconfonts.com/api/?family=zocial"/>
    <meta charset="utf-8"/>
</head>
<body>
