<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>To-Do List | Recuperación</title>
<link rel="stylesheet" type="text/css" href="CSS/estilo.css">
<link rel="shortcut icon" type="image/x-icon" href="img/Restablecer.ico"/>
</head>
<body>
   <header class="headerlogin">
   <h1>Sistema To-Do List <img src="img/Logoprog.png" width="30px"alt="" style="float:right"></h1>
   </header>
    <div class="estiloform">
    <h1>Recupere sus<span>Datos</span></h1>
    <form action="RECUPERAR.php" method="POST">
        
        <table>
            <tr>
                <td class="der"><input type="email" name="correo" placeholder="ejemplo@hotmail.com" required></td>
            </tr>
            <tr>
                <td class="der">
                    <input type="password" name="password" placeholder="Nueva Contaseña" required>
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
         <a href="index.php" class="iraregistro">Iniciar Sesión</a> 
    </form>
    </div>
     <footer class="footerlogin">© Copyrights To-Do List Programación IV</footer>
</body>
</html>