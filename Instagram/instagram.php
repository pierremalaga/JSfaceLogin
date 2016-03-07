<?php
set_time_limit(0);
ini_set('default_socket_timeout',300);
session_start();	
/******************** 	INSTAGRAM API KEYS *****************************/
define("ClientId", '41f65a5c684048bca797dbf0775c9ec7');
define("ClientSECRET", '95647e6ef2a445ff92e8b27c82bf8da6');
//define("redirectURL", 'http://joinsocial.esy.es/index.php');
define("redirectURL", 'http://localhost/JSfaceLogin/Instagram/instagram.php');

require 'instagram/vendor/cosenary/instagram/src/Instagram.php';
use MetzWeb\Instagram\Instagram;

$insta = new Instagram(array(
	'apiKey'      => '41f65a5c684048bca797dbf0775c9ec7',
	'apiSecret'   => '95647e6ef2a445ff92e8b27c82bf8da6',
	'apiCallback' => 'http://localhost/JSfaceLogin/Instagram/instagram.php'
));
if(isset($_GET['code'])) {
	echo $_GET['code'];
	$accessToken = $insta->getOAuthToken($_GET['code']);
	$insta->setAccessToken($accessToken);
	$token = $insta->getAccessToken().'<br>';
	print_r($accessToken);
	$id = $accessToken->user->id;
	echo $full_name = $accessToken->user->username;

	echo '<pre>';

	echo '</pre>';
	$imagen = $accessToken->user->profile_picture;
	echo '<img src="'.$imagen.'"/>';
	echo $insta->getUserLikes(1)->data[0]->likes->count."Me gusta";
	$follow = ($insta->getUserFollows());



	print_r($insta->getUserMedia());
} else {

	// check whether an error occurred
	if (isset($_GET['error'])) {
		echo 'An error occurred: ' . $_GET['error_description'];
	}
	//print_r($insta->getUserLikes(1));
}




?>
<!doctype html>
<html>
	<body>
	<img src="instagram.ico"  height="42" width="42" >
	<a src="instagram.ico"	href = "<?php echo $insta->getLoginUrl(); ?>">Login1</a>
	</body>
</html>
