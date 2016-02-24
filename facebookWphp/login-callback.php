<?php
/**
 * Created by PhpStorm.
 * User: pmalaga
 * Date: 19/01/2016
 * Time: 13:13
 */
# login-callback.php
include 'fHeaders.php';
$helper = $fb->getRedirectLoginHelper();
try {
    $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

if (isset($accessToken)) {
    // Logged in!
    $_SESSION['facebook_access_token'] = (string) $accessToken;
    $_SESSION['oauth_provider'] = 'facebook';
    //header('location: http://localhost/facebook/facebookWphp/index.php');
    header('location: http://localhost/JSfaceLogin/main.php');

    //$_accessToken permite redirigir al usuario a cualquiera de nuestras paginas sin salir de la session
    // Now you can redirect to another page and use the
    // access token from $_SESSION['facebook_access_token']
}