<?php
/**
 * Created by PhpStorm.
 * User: pierremalaga
 * Date: 6/3/16
 * Time: 21:17
 */
//require 'facebookWphp/fHeaders.php';

require 'accessTokenFacebook.php';
/*
    echo '<pre>';
        print_r();
    echo '</pre>';*/

if(isset($_REQUEST['message'])){
    $message = $_REQUEST['message'];

    //$postCommentsStr = '/'.$postId.'/comments?message='.$message;
    $postCommentsStr = '/me/feed';
    $decodedResponse = $fb->post($postCommentsStr,
        array ('message' => $message), $_SESSION['facebook_access_token'])->getDecodedBody();
    //$decodedResponse = $postCommentsRequest;
    //print_r($postCommentsRequest);

    $uname = $userNode->getName();
    $uId = $userNode->getId();
    $getuPict = $fb->get("/me/picture?redirect=0");
    $uPictAr = $getuPict->getDecodedBody();
    $uPict = $uPictAr['data']['url'];
    $postId = $decodedResponse['id'];
    $postRequest = $fb->get($postId);
    $post = $postRequest->getDecodedBody();
    $postImageStr = '/'.$post['id'].'/?fields=full_picture,picture,object_id,type,source';
    $postCommentsStr = '/'.$post['id'].'/comments';

    $postImageRequest = $fb->get($postImageStr);
    $postImage = $postImageRequest->getDecodedBody();

    $postCommentsRequest = $fb->get($postCommentsStr);
    $postComments = $postCommentsRequest->getDecodedBody();

    //echo '<section class="socialBox">';
    echo '<input type="hidden" value="'.$post['id'].'" id="postIdField"/>';
    echo '<div class="publicationCard">
                <div class="firstRow">
                    <img class="upictPublication" src="'.$uPict.'"/><div class="userInfo">';
    echo '<p class="uname">'.$uname.'</p>';
    echo '<span class="subInfo">'.$post['created_time'].'</span></div>';
    echo '<div class="publiOptions" onclick="openSocialOption(this)">
                        <div class="brandico-facebook-rect socialLogo facebook"></div>
                        <div class="entypo-down-open moreOptions"></div>
                    </div>
                </div>
                <div class="contentPublished">';
    echo '<div class="text"><p>'.(isset($post['message'])? $post['message'] : $post['story']).'</p></div>';
    if($postImage['type'] == "photo") {
        echo '<div class="image"><img src="' . $postImage['full_picture'] . '"/></div>';
    }else if($postImage['type'] == "video"){
        echo '<div class="videoPost"><video class="video" poster="'.$postImage["full_picture"].'" onclick="playVideo(this)">
                      <source src="'.$postImage['source'].'" type="video/mp4">
                      Your browser does not support the video tag.
                    </video></div>';

    }
    echo '</div>
                <div class="socialOptions">
                    <div class="comments"><span class="subInfo">comentarios</span></div>
                    <div class="fontawesome-thumbs-up likes"></div>
                </div><div class="commentsField" id="commentsField_'.$post['id'].'">';
    foreach($postComments['data'] as $currentComment){
        echo '<div class="singleCommentBox"><span>'.$currentComment['from']['name'].' says: </span>';
        echo '<p>'.$currentComment['message'].'</p></div>';
    }

    echo '<input type="text" placeholder="Escribe un comentario..." name="'.$post['id'].'" id="inputPostComment'.$post['id'].'" onfocus="sendComment(this)">
              <input type="button" class="sendPostComment" id="sendPostComment_'.$post['id'].'" value="Enviar" onclick="sendCommentByClick(inputPostComment'.$post['id'].')"/>
                </div>
            </div>';

    //echo 'true:'.$decodedResponse['id'];
}