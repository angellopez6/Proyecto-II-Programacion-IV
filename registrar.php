<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>To-Do List | Registrar User</title>
<link rel="stylesheet" type="text/css" href="CSS/estilo.css">
<link rel="shortcut icon" type="image/x-icon" href="img/Registrar.ico"/>
</head>
<body>
    <header class="headerlogin">
   <h1>Sistema To-Do List <img src="img/Logoprog.png" width="30px"alt="" style="float:right"></h1>
   </header>
    <div class="estiloform2">
    <h1>Complete el<span>Formulario</span></h1>
    <form action="insertar_user.php" method="POST">
        <h5> <a href="index.php" class="Iniciarderegistrar">Iniciar Sesión</a></h5>
        <table>
            <tr>
                <td class="der"><input type="text" name="usu" placeholder="Usuario" required maxlength="20"></td>
            </tr>
            <tr>
                <td class="der">
                    <input type="password" name="pass" placeholder="Contraseña" required maxlength="16">
                </td>
            </tr>
             <tr>
                <td class="der"><input type="text" name="nom" placeholder="Nombre" required max="20"></td>
            </tr>
             <tr>
                <td class="der"><input type="text" name="ape" placeholder="Apellido" required maxlength="20"></td>
            </tr>
             <tr>
                <td class="der"><input type="email" name="email" placeholder="Correo" required maxlength="50"></td>
            </tr>
             <tr>
                <td class="der"><input type="text" name="prof" placeholder="Profesión" required maxlength="30"></td>
            </tr>
            <tr>
            <td colspan="2">
                <input type="submit" name="enviar" value="Registrar">
            </td>
            </tr>
        </table>  
    </form>
    </div>
    <footer class="footerlogin">© Copyrights To-Do List Programación IV</footer>
</body>
</html>