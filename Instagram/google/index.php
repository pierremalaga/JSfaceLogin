<?php

require 'setup.php';

$client = new apiClient();

$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setDeveloperKey($api_key);
$client->setRedirectUri($redirect_url);
$client->setApprovalPrompt(false);
$oauth2 = new apiOauth2Service($client);


if (isset($_GET['code'])) {
	
	$client->authenticate();
	
	$info = $oauth2->userinfo->get();
	
	$person = ORM::for_table('usuario_google')->where('email', $info['email'])->find_one();
	
	if(!$person){
		
		$person = ORM::for_table('usuario_google')->create();
		
		$person->email = $info['email'];
		$person->name = $info['name'];
		
		if(isset($info['picture'])){
			$person->photo = $info['picture'];
		}
		else{
			$person->photo = 'img/default_avatar.jpg';
		}
		
		$person->save();
	}
	
	$_SESSION['user_id'] = $person->id();
	
	header("Location: $redirect_url");
	exit;
}

if (isset($_GET['logout'])) {
	unset($_SESSION['user_id']);
}

$person = null;
if(isset($_SESSION['user_id'])){
	$person = ORM::for_table('usuario_google')->find_one($_SESSION['user_id']);
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Inicia sesion con tu cuenta de google...</title>
        
        <link rel="stylesheet" href="estilo/estilo.css" />
        
        <!--[if lt IE 9]>
          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    
    <body>

        <div id="barra">
			<?php if($person):?>
				<span class="sastifactorio">Usuario : <b><?php echo htmlspecialchars($person->name)?></span>
				<span class="avatar" style="background-image:url(<?php echo $person->photo?>?sz=35)"></span>
            	<span> <a href="?logout" class="logoutBoton">desconectar</a></span>
            	
			<?php else:?>
            	<a href="<?php echo $client->createAuthUrl()?>" class="loginboton">Inicia sesi&oacute;n</a>
            <?php endif;?>

        </div>
        <!-- publicidad bloguero ayudar mediante clics es dar gracias a los aportes-->
        <br /><br /><br /><br /><br /><br />
        <div align="center">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- bloguero-cuadro -->
<ins class="adsbygoogle"
     style="display:inline-block;width:250px;height:250px"
     data-ad-client="ca-pub-6927159933673851"
     data-ad-slot="2218183522"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>

      
    </body>
</html>