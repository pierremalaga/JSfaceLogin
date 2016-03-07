<?php
/**
 * Created by PhpStorm.
 * User: Janet
 * Date: 28/02/2016
 * Time: 17:34
 */
require 'facebookWphp/fHeaders.php';
/*
    echo '<pre>';
        print_r();
    echo '</pre>';*/


if(isset($_REQUEST['postId']) && isset($_REQUEST['message'])){
    $postId = $_REQUEST['postId'];
    $message = $_REQUEST['message'];

    //$postCommentsStr = '/'.$postId.'/comments?message='.$message;

    $postCommentsStr = '/'.$postId.'/comments';
    $postCommentsRequest = $fb->post($postCommentsStr,
                                    array ('message' => $message), $_SESSION['facebook_access_token']);

    echo 'true';
}