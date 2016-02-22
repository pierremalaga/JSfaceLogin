<?php
/**
 * Created by PhpStorm.
 * User: Alumne
 * Date: 08/02/2016
 * Time: 15:33
 */

require 'instagram/vendor/cosenary/instagram/src/Instagram.php';
use MetzWeb\Instagram\Instagram;
// initialize class
$instagram = new Instagram(array(
    'apiKey'      => '41f65a5c684048bca797dbf0775c9ec7',
    'apiSecret'   => '95647e6ef2a445ff92e8b27c82bf8da6',
    'apiCallback' => 'http://localhost/instagram_toOld.php'
));
session_start();
$token = false;
if (isset($_SESSION['access_token'])) {
    // user authenticated -> receive and set token
    $token = $_SESSION['access_token'];
} else {
    // receive OAuth code parameter
    $code = $_GET['code'];
    // authentication in progress?
    if (isset($code)) {
        // receive and store OAuth token
        $data = $instagram->getOAuthToken($code);
        $token = $data->access_token;
        $_SESSION['access_token'] = $token;
    } else {
        // check whether an error occurred
        if (isset($_GET['error'])) {
            echo 'An error occurred: ' . $_GET['error_description'];
        }
    }
}
// check authentication
if ($token === false) {
    // authentication failed -> redirect to login
    header('Location: index.php');
} else {
    // store user access token
    $instagram->setAccessToken($token);

    // now we have access to all authenticated user methods
    $media = $instagram->getUserMedia();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram - photo stream</title>
    <link href="https://vjs.zencdn.net/4.2/video-js.css" rel="stylesheet">
    <link href="assets/style.css" rel="stylesheet">
    <script src="https://vjs.zencdn.net/4.2/video.js"></script>
</head>
<body>
<div class="container">
    <header class="clearfix">
        <img src="assets/instagram.png" alt="Instagram logo">
        <h1>Instagram photos <span>taken by <?php echo $data->user->username ?></span></h1>
    </header>
    <div class="main">
        <ul class="grid">
            <?php
            // display all user likes
            foreach ($result->data as $media) {
                $content = "<li>";
                // output media
                if ($media->type === 'video') {
                    // video
                    $poster = $media->images->low_resolution->url;
                    $source = $media->videos->standard_resolution->url;
                    $content .= "<video class=\"media video-js vjs-default-skin\" width=\"250\" height=\"250\" poster=\"{$poster}\"
                           data-setup='{\"controls\":true, \"preload\": \"auto\"}'>
                             <source src=\"{$source}\" type=\"video/mp4\" />
                           </video>";
                } else {
                    // image
                    $image = $media->images->low_resolution->url;
                    $content .= "<img class=\"media\" src=\"{$image}\"/>";
                }
                // create meta section
                $avatar = $media->user->profile_picture;
                $username = $media->user->username;
                $comment = $media->caption->text;
                $content .= "<div class=\"content\">
                           <div class=\"avatar\" style=\"background-image: url({$avatar})\"></div>
                           <p>{$username}</p>
                           <div class=\"comment\">{$comment}</div>
                         </div>";
                // output media
                echo $content . "</li>";
            }
            ?>
        </ul>
        <!-- GitHub project -->
        <footer>
            <p>created by <a href="https://github.com/cosenary/Instagram-PHP-API">cosenary's Instagram class</a>, available on GitHub</p>
            <iframe width="95px" scrolling="0" height="20px" frameborder="0" allowtransparency="true" src="http://ghbtns.com/github-btn.html?user=cosenary&repo=Instagram-PHP-API&type=fork&count=true"></iframe>
        </footer>
    </div>
</div>
<!-- javascript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // rollover effect
        $('li').hover(
            function() {
                var $media = $(this).find('.media');
                var height = $media.height();
                $media.stop().animate({ marginTop: -(height - 82) }, 1000);
            }, function() {
                var $media = $(this).find('.media');
                $media.stop().animate({ marginTop: '0px' }, 1000);
            }
        );
    });
</script>
</body>
</html>