<?php
/**
 * Created by PhpStorm.
 * User: Alumne
 * Date: 08/02/2016
 * Time: 15:30
 */
require 'instagram/vendor/cosenary/instagram/src/Instagram.php';
use MetzWeb\Instagram\Instagram;
session_start();
if (isset($_SESSION['access_token'])) {
    // user authentication -> redirect to media
    header('Location: success.php');
}
// initialize class
$instagram = new Instagram(array(
    'apiKey'      => '41f65a5c684048bca797dbf0775c9ec7',
    'apiSecret'   => '95647e6ef2a445ff92e8b27c82bf8da6',
    'apiCallback' => 'http://localhost/instagram_toOld.php'
));
// create login URL
$loginUrl = $instagram->getLoginUrl(array(
    'basic',
    'likes',
    'relationships'
));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram - OAuth Login</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <style>
        .login {
            display: block;
            font-size: 20px;
            font-weight: bold;
            margin-top: 50px;
        }
    </style>
</head>
<body>
<div class="container">
    <header class="clearfix">
        <h1>Instagram <span>display your photo stream</span></h1>
    </header>
    <div class="main">
        <ul class="grid">
            <li><img src="assets/instagram-big.png" alt="Instagram logo"></li>
            <li>
                <a class="login" href="<?php echo $loginUrl ?>">» Login with Instagram</a>
                <h4>Use your Instagram account to login.</h4>
            </li>
        </ul>
        <!-- GitHub project -->
        <footer>
            <p>created by <a href="https://github.com/cosenary/Instagram-PHP-API">cosenary's Instagram class</a>, available on GitHub</p>
        </footer>
    </div>
</div>
</body>
</html>