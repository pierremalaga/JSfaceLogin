<?php
/*
 * Created by PhpStorm.
 * User: Janet
 * Date: 22/02/2016
 * Time: 16:50
 */
include 'accessTokenFacebook.php';

$uname = $userNode->getName();
$uId = $userNode->getId();
$provider = $_SESSION['oauth_provider'];

$mysqli = new mysqli('localhost', 'root', '', 'facebook');

$query = $mysqli->query("SELECT * FROM users WHERE oauth_provider = '$provider' AND oauth_uid = ". $uId);

$line = '';
//print_r($query);
if($query->num_rows){
    while($user = $query->fetch_object()){
        //print_r($user);
        $_SESSION['id'] = $user->id;
        $_SESSION['oauth_uid'] = $user->oauth_uid;
        $_SESSION['oauth_provider'] = $user->oauth_provider;
        $_SESSION['username'] = $user->username;
        $_SESSION['email'] = $user->username;
    }
}else{
    header('Location: http://localhost/JSfaceLogin/register.php');
}
if(isset($_SESSION['username'])){

    $userFeedRequest = $fb->get('/me/feed?limit=5');
    $userFeed = $userFeedRequest->getDecodedBody();
?>
<header>

    <div class="supHeader">
        <h1 class="title">JoinSocial</h1>
        <!--<a href="logout.php?action=logout" >Logout</a>-->
    </div>
    <div class="hidden_supHeader">
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
    <!--Menu-->
    <div class="menu">
        <form>
            <fieldset>
                <legend>JoinSocial</legend>

                <label for="fullname">Buscar</label>
                <input type="text" id="fullname" />
                <p><a href="logout.php?action=logout" >Logout</a></p>

                <p>Redes Sociales</p>
                <p><input type="checkbox" value="Dart" id="dart" /> <label for="dart">Facebook</label></p>
                <p><input type="checkbox" value="CSS3" id="css3" /> <label for="css3">Instagram</label></p>
                <p><input type="checkbox" value="HTML5" id="html5" /> <label for="html5">Youtube</label></p>
                <p><input type="checkbox" value="JavaScript" id="javascript" /> <label for="javascript">Twitter</label></p>
                <p>Filtrar por </p>
                <p><input type="checkbox" value="Dart" id="dart" /> <label for="dart">Likes</label></p>
                <p><input type="checkbox" value="CSS3" id="css3" /> <label for="css3">Comentarios</label></p>
                <p><input type="checkbox" value="HTML5" id="html5" /> <label for="html5">reproducciones</label></p>

            </fieldset>

        </form>
        </div>
</body>
<?php
}
$query->close();