<?php

// Leer los datos del formulario

$email = $_POST["signup_email"];
$password = $_POST["signup_password"];
$newsletter = $_POST["signup_newsletter"];
 // Realizar la validación de los datos

 $error_message = ""
if (strlen($password) < 6) {
    $error_message = "La contraseña es demasiado corta. Por favor, introduzca al menos 6 caracteres";
} else if ( $password != $_POST["signup_confirm_password"]) {
    $error_message = "Las contraseñas no coinciden. Por favor, inténtelo de nuevo";
}
if ( ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error_message = "Por favor, compruebe la dirección de email introducida";

 // Insertar el usuario en la base de datos
$random_key = generate_random_key();
$stm = $dbh->prepare("insert into usuarios (email,password,activation_key,validated) " .
                     "values ( ? , ? , ? , 0 )");
$stm->bind_param("sss",$email,$password,$random_key);
if (!$stm->execute()) {
    // La inserción puede fallar si el usuario ya existía en la base de datos
    $error_message = "Error, el usuario ya existía en la base de datos";
} else {
    // Enviar un mensaje para confirmar la dirección de correo del usuario
    echo "Correooooo";
}
 function generate_random_key() {
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
 
    $new_key = "";
    for ($i = 0; $i < 32; $i++) {
        $new_key .= $chars[rand(0,35)];
    }
    return $new_key;
}
 // Enviar un email de confirmación
 mail($email,"joinsocial.esy.es - Activación de la cuenta",
     "Bienvenido a ejemplo.com!
 
     Gracias por registrarse en nuestro sitio.
     Su cuenta ha sido creada, y debe ser activada antes de poder ser utilizada.
     Para activar la cuenta, haga click en el siguiente enlace o copielo en la
     barra de direcciones del navegador:
     http://joinsocial.esy.es/activate.php?activation=".$random_key);
 $activation_key = $_GET["activation"];
$dbh = get_dbh();
// Busca la entrada en la tabla de usuarios para la clave de activación recibida
$stm = $dbh->prepare("select count(1) from users where activation_key=?");
$stm->bind_param("s",$activation_key);
$stm->bind_result($total);
$message = "";
$stm->execute();
$stm->fetch();
$stm->close();
if ($total == 1) { // Si se ha encontrado...
    // Retrieve the email address
    $stm = $dbh->prepare("select email from users where activation_key=?");
    $stm->bind_param("s",$activation_key);
    $stm->bind_result($email);
    $stm->execute();
    $stm->fetch();
    $stm->close();
    // Poner a uno el campo validated en la tabla usuarios
    $stm = $dbh->prepare("update usuarios set validated=1 where activation_key=?");
    $stm->bind_param("s",$activation_key);
    $stm->execute();
    $stm->close();
    // Introducir al usuario en sesión
    $_SESSION["user"] = $email;
    $message .= "Gracias por registrarse con nosotros<br/><br/>" .
        "¡Bienvenido a ejemplo.com!<br/><br/>" .
        "<a href='http://ejemplo.com' class=\"btn\"'>Continuar</a>";
?>