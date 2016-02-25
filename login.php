<?php
/**
 * Created by PhpStorm.
 * User: pmalaga
 * Date: 19/01/2016
 * Time: 13:13
 */
# login.php
require 'socialHeaders.php';
$helper = $fb->getRedirectLoginHelper();
$permissions = ['email', 'user_friends', 'public_profile']; // optional
$loginUrl = $helper->getLoginUrl('http://localhost/JSfaceLogin/facebookWphp/login-callback.php', $permissions);
$instaLoginUrl = "https://api.instagram.com/oauth/authorize/?client_id=".ClientId."&redirect_uri=".redirectURL."&response_type=code"
?>
<header>
    <div class="loginTitle">
        <h1>JoinSocial</h1>
    </div>
</header>
<body>
<div class="loginBox">
    <h2>Login With...</h2>
    <!--<h2>Choose Login</h2>-->
    <div class="loginButtons">
    <?php
    //Facebook Login Button
    echo '<a class="facebookLink" href="' . $loginUrl . '">
            <p class="brandico-facebook-rect facebookLoginLogo"></p>
          </a>';
    //Instagram Login Button
    echo '<a class="instagramLink" href="' . $instaLoginUrl . '">
            <p class="brandico-instagram-filled instagramLoginLogo"></p>
          </a>';
    ?>
    </div>
</div>
</body>