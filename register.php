<?php
/*
 * Created by PhpStorm.
 * User: Janet
 * Date: 24/02/2016
 * Time: 21:02
 */
//If the user no exist in the database, we will show a form for register or retry login
include 'accessTokenFacebook.php';

$uname = $userNode->getName();
$uId = $userNode->getId();
$provider = $_SESSION['oauth_provider'];

$mysqli = new mysqli('localhost', 'root', '', 'facebook');
if(isset($_POST['email'])) {
    $email = $_POST['email'];
    $query = $mysqli->query("INSERT INTO users (oauth_provider, oauth_uid, username, email) VALUES ('$provider', '$uId', '$uname', '$email')");
    header('Location: http://localhost/JSfaceLogin/main.php');
}
else{
    echo '<form action="'.$_SERVER['PHP_SELF'].'" method="POST" >';
    echo '<input type="text" name="email" placeholder="Enter your email to end register..." />';
    echo '<input type="submit" value="Go to JoinSocial" />';
    echo '</form>';

    //GAMIFICACIÓN: Te has registrado!!
    //Enviar correo de confirmación de registro a usuario
}
?>
