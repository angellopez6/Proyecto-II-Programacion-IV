<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>To-Do List | Log In</title>
<link rel="stylesheet" type="text/css" href="CSS/estilo.css">
<link rel="shortcut icon" type="image/x-icon" href="img/Key.ico"/>
<meta name="viewport" content="width-device-width,user-scalable-no,initial-scale1.0,maximun-scale1.0,minimun-scale-1.0">
</head>
<body>
   <header class="headerlogin">
   <h1>Sistema To-Do List <img src="img/Logoprog.png" width="30px"alt="" style="float:right"></h1>
   </header>
    <div class="estiloform">
    <h1>Iniciar <span>Sesión</span></h1>
    <form action="comprueba_login.php" method="POST">
        
        <table>
            <tr>
                <td class="der"><input type="text" name="login" placeholder="Usuario" required></td>
            </tr>
            <tr>
                <td class="der">
                    <input type="password" name="password" placeholder="Contraseña" required>
                </td>
            </tr>
            <tr>
            <td colspan="2">
                <input type="submit" name="enviar" value="Enviar">
            </td>
            </tr>
        </table> 
        <a href="registrar.php" class="iraregistro">¿Aún no tienes cuenta?<br>Registrate Ahora.</a>
        <br>
       
         <a href="FORMULARIO_RECUPERAR_USUARIOS.php" class="iraregistro">¿Olvidaste tu contaseña?<br>Recuperar Ahora.</a> 
    </form>
    </div>
    <footer class="footerlogin">© Copyrights To-Do List Programación IV</footer>
</body>
</html>