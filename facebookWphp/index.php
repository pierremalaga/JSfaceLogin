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
$userFeed = $fb->get('/me/feed');
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
        <section class="socialBox">
            <div class="publicationCard">
                <div class="firstRow">
                    <div class="userInfo">
                        <p class="uname"><?php echo $uname; ?></p>
                        <span class="subInfo">publicado a las 11:27</span>
                    </div>
                    <div class="publiOptions">
                        <div class="brandico-facebook-rect socialLogo facebook"></div>
                        <div class="entypo-down-open moreOptions"></div>
                    </div>
                </div>
                <div class="contentPublished">
                    <div class="image"></div>
                    <div class="text"><p>Image is a blank image</p></div>
                </div>
                <div class="socialOptions">
                    <div class="comments"><span class="subInfo">comentarios</span></div>
                    <div class="fontawesome-thumbs-up likes"></div>
                </div>
            </div>
        </section>
        <section class="socialBox">
            <div class="publicationCard">
                <div class="firstRow">
                    <div class="userInfo">
                        <p class="uname">Victor Cappanera</p>
                        <span class="subInfo">publicado a las 11:27</span>
                    </div>
                    <div class="publiOptions">
                        <div class="brandico-instagram-filled socialLogo insta"></div>
                        <div class="entypo-down-open moreOptions"></div>
                    </div>
                </div>
                <div class="contentPublished">
                    <div class="image"></div>
                    <div class="text"><p>Image is a blank image</p></div>
                </div>
                <div class="socialOptions"></div>
            </div>
        </section>
    </div>
</body>
