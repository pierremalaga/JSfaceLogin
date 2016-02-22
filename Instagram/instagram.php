<?php
set_time_limit(0);
ini_set('default_socket_timeout',300);
session_start();	
/******************** 	INSTAGRAM API KEYS *****************************/
define("ClientId", '41f65a5c684048bca797dbf0775c9ec7');
define("ClientSECRET", '95647e6ef2a445ff92e8b27c82bf8da6');
//define("redirectURL", 'http://joinsocial.esy.es/index.php');
define("redirectURL", 'http://localhost:80/Instagram/instagram.php');

require 'instagram/vendor/cosenary/instagram/src/Instagram.php';
use MetzWeb\Instagram\Instagram;

$insta = new Instagram(array(
	'apiKey'      => '41f65a5c684048bca797dbf0775c9ec7',
	'apiSecret'   => '95647e6ef2a445ff92e8b27c82bf8da6',
	'apiCallback' => 'http://localhost:8080/Instagram/instagram.php'
));
echo $insta->getLoginUrl();

echo ClientId . '</br>';
echo ClientSECRET . '</br>';
echo redirectURL . '</br>';



?>
<!doctype html>
<html>
	<body>
	<img src="instagram.ico" alt="Smiley face" height="42" width="42" >
			<a src="instagram.ico"	href = "https://api.instagram.com/oauth/authorize/?client_id=<?php echo ClientId; ?>&redirect_uri=<?php echo redirectURL; ?>&response_type=code">Login1</a>


	</body>
</html>
