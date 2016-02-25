<?php
/**
 * Created by PhpStorm.
 * User: pmalaga
 * Date: 19/01/2016
 * Time: 13:28
 */
//authenticate with our database http://programacion.net/articulo/autenticar_usuarios_con_facebook_connect_utilizando_php_377
//work with Posts
include 'fHeaders.php';
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

//echo 'Logged in as ' . $userNode->getName();
//echo '<br>Logged in as ID: ' . $userNode->getId();

$uname = $userNode->getName();
$uId = $userNode->getId();
//$responseExtra = $fb->get('/me/photos');
//$userInfo = $responseExtra->getGraphEdge();

mysql_connect('localhost', 'root', '');
mysql_select_db('facebook');
//print_r($userInfo);
$query = mysql_query("SELECT * FROM users WHERE oauth_provider = 'facebook' AND oauth_uid = ". $uId);
if($query) {
    $result = mysql_fetch_array($query);
}

# If not, let's add it to the database
if(empty($result)){
    $query = mysql_query("INSERT INTO users (oauth_provider, oauth_uid, username) VALUES ('facebook', '$uId', '$uname')");
    $query = mysql_query("SELECT * FROM users WHERE id = 2");
    $result = mysql_fetch_array($query);
}
if(!empty($user)){
    # ...

    if(empty($result)){
        # ...
    }

    # let's set session values
    $_SESSION['id'] = $result['id'];
    $_SESSION['oauth_uid'] = $result['oauth_uid'];
    $_SESSION['oauth_provider'] = $result['oauth_provider'];
    $_SESSION['username'] = $result['username'];
}

//print_r($_SESSION);
$userFeedRequest = $fb->get('/me/feed');
$userFeed = $userFeedRequest->getDecodedBody();
//print_r($userFeed);
?>
    <header>
        <div class="supHeader">
            <h1 class="title">JoinSocial</h1>
            <a href="logout.php?action=logout" >Logout</a>
        </div>
    </header>
    <body>
    <div class="content">
<?php
foreach($userFeed['data'] as $post){
    $postImageStr = '/'.$post['id'].'/?fields=full_picture,picture,object_id,type,source';

    $postImageRequest = $fb->get($postImageStr);
    $postImage = $postImageRequest->getDecodedBody();
    echo '<pre>';
    print_r($postImage);
    echo '</pre>';

    /*if($postImage['type'] == 'video'){
        $videoPost = $fb->get('/'.$postImage['id'].'?fields=embed_html');
        $postVideo = $videoPost->getDecodedBody();
        print_r($postVideo);
    }*/

    echo '<section class="socialBox">
            <div class="publicationCard">
                <div class="firstRow">
                    <div class="userInfo">';
    echo '<p class="uname">'.$uname.'</p>';
    echo '<span class="subInfo">'.$post['created_time'].'</span></div>';
    echo '<div class="publiOptions">
                        <div class="brandico-facebook-rect socialLogo facebook"></div>
                        <div class="entypo-down-open moreOptions"></div>
                    </div>
                </div>
                <div class="contentPublished">';
    echo '<div class="text"><p>'.(isset($post['message'])? $post['message'] : $post['story']).'</p></div>';
    echo '<div class="image"><img src="'.$postImage['full_picture'].'"/></div>';
    echo '</div>
                <div class="socialOptions">
                    <div class="comments"><span class="subInfo">comentarios</span></div>
                    <div class="fontawesome-thumbs-up likes"></div>
                </div>
            </div>
        </section>';

}
?>

</body>
