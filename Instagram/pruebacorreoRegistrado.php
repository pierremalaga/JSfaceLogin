<!DOCTYPE html>
<html>
<head>
  
    <meta charset="utf-8">
    <!-- Se agrega la biblioteca de jquery y enseguida nuestro js de funciones-->
    <script type="text/javascript" src="./../js/jquery-1.10.2.min.js" ></script>
    <script type="text/javascript" src="./../js/validar.js" ></script>
    <link type="text/css" href="./../css/style.css" rel="stylesheet" />
</head>
 
<body>
    
    <div id="envoltura">
        <div id="contenedor">
 
            <div id="cabecera">
                <img src="./../css/images/logo.gif" >
            </div>
 
            <div id="cuerpo">
                <form id="form-login" action="agregar.php" method="post" >
 
                    <p><label for="nombre">Nombre:</label></p>
                        <input name="nombre" type="text" id="nombre" class="nombre" placeholder="Pon tu nombre" autofocus=""/ ></p>
                        <div id="mensaje1" class="errores"> Ingresa solo caracteres</div>
 
                    <!--=============================================================================================-->
                    <!-- En seguida de cada input se agregará un div con el mensaje de error-->
                    <p><label for="apellidos">Apellidos:</label></p>
                        <input name="apellidos" type="text" id="apellidos" class="apellidos" placeholder="Pon tus apellidos" /></p>
                        <div id="mensaje2" class="errores"> Ingresa solo caracteres</div>
                    <!--=============================================================================================-->
 
                    <p><label for="correo">Correo:</label></p>
                        <input name="correo" type="text" id="correo" class="correo" placeholder="Pon tu mail" /></p>
                        <div id="mensaje3" class="errores"> Mail no valido</div>
 
                    <p><label for="pass">Password:</label></p>
                        <input name="pass" type="password" id="pass" class="pass" placeholder="Pon tu contraseña"/ ></p>
 
                    <p><label for="repass">Repetir Password:</label></p>
                        <input name="repass" type="password" id="repass" class="repass" placeholder="Repite contraseña" /></p>
 
                    <p id="bot"><input name="submit" type="submit" id="boton" value="Registrar" class="boton"/></p>
                </form>
            </div>
 
            <div id="pie">Sistema de Login Y Registro</div>
        </div><!-- fin contenedor -->
 
    </div>
 
</body>
 
</html>