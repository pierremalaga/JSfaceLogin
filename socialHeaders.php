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
define("ClientId", '41f65a5c684048bca797dbf0775c9ec7');
define("ClientSECRET", '95647e6ef2a445ff92e8b27c82bf8da6');
define("redirectURL", 'http://localhost/JSfaceLogin/main.php');



$insta = new Instagram(array(
    'apiKey'      => '41f65a5c684048bca797dbf0775c9ec7',
    'apiSecret'   => '95647e6ef2a445ff92e8b27c82bf8da6',
    'apiCallback' => 'http://localhost:8080/Instagram/instagram.php'
));

/* Facebook Headers */
require 'facebookWphp/fHeaders.php';

?>
<!-- HTML Header -->
<html DOCTYPE!>
<head>
    <link rel="stylesheet" href="facebookWphp/style/mainStyle.css"/>
    <link rel="stylesheet" href="http://weloveiconfonts.com/api/?family=zocial"/>
    <meta charset="utf-8"/>
</head>
<body>
