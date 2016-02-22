<?php
/**
 * Created by PhpStorm.
 * User: Janet
 * Date: 22/02/2016
 * Time: 17:31
 */
include 'socialHeaders.php';
$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);

try {
    $response = $fb->get('/me');
    $userNode = $response->getGraphUser();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
