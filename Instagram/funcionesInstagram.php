<?php
function connectToInstagram($url){
	$ch = curl_init();						//used to transfer data with a url
	
	curl_setopt_array($ch, array(			//sets options for a curl transfer
		CURLOPT_URL => $url,				//the url
		CURLOPT_RETURNTRANSFER => true,		//return the results if successful
		CURLOPT_SSL_VERIFYPEER => false,	//we dont need to verify any certificates
		CURLOPT_SSL_VERIFYHOST => 2			//we wont verify host
	));

	

	$result = curl_exec($ch);				//executue the transfer
	curl_close($ch);						//close the curl session
	return $result;							//returns all the data we gathered
}
function connectToInstagramSS($url){
	$ch = curl_init();
	
$data = array('client_id' => ClientId, 'client_secret' => ClientSECRET, 'grant_type' => 'authorization_code', 'redirect_uri'=> 'http://localhost/JSfaceLogin/Instagram/instagram.php', 'code'=> ClientId);

($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false); // requerido a partir de PHP 5.6.0
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);


	
	$result = curl_exec($ch);				//executue the transfer
	curl_close($ch);

    return $result;	
}

function getUserID($userName){
	$url = 'https:/dertjk.stagram.com/v1/users/search?q='. $userName .'&client_id='. ClientId;
	$instagramInfo = connectToInstagram($url);
	$results = json_decode($instagramInfo, true); 	//takes a JSON encoded string and converts it into a PHP variables

	return $results['data'][0]['id'];				//returns the userID
}
function getUser($access_token){
	//echo 'https://api.instagram.com/v1/users/self/?access_token='.ClientId;
	$url = 'https://api.instagram.com/oauth/access_token';
$instagramInfo = connectToInstagramSS($url);	
$results = json_decode($instagramInfo, true);
print_r($instagramInfo);
}
function printImages($userID){
	$url = 'https://api.instagram.com/v1/users/'. $userID .'/media/recent?client_id='. ClientId .'&count=5';
	$instagramInfo = connectToInstagram($url);
	$results = json_decode($instagramInfo, true);
	
	//parse through results
	foreach($results['data'] as $item){
		$image_url = $item['images']['low_resolution']['url'];
		echo '<img src="'.$image_url.'" /> <br/>';
		savePicture($image_url);
	}
}
?>