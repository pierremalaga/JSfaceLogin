<?php
/**
 * Created by PhpStorm.
 * User: pmalaga
 * Date: 19/01/2016
 * Time: 13:13
 */
# login.php
require 'fHeaders.php';
$helper = $fb->getRedirectLoginHelper();
$permissions = ['email', 'user_friends', 'public_profile']; // optional
$loginUrl = $helper->getLoginUrl('http://localhost/facebook/facebookWphp/login-callback.php', $permissions);

echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';