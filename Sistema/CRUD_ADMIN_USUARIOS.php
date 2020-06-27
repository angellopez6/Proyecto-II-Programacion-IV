<?php
//Este es el filtro para que deje acceder solo al usuario competente
//Esto es lo primero que el navegador ve entonces se reanuda la session de la variable super global.

session_start();
//Esto es lo más facil de explicar y entender, si la sessión no esta iniciada nadie que se le ocurra copiar el URL y pegarlo en un navegador podrá acceder a menos que no haya iniciado sessión Previamente.
if(!isset($_SESSION["usuario"]) || $_SESSION["rol"]=="2"){
    
    header("location:../cierre.php");
    //header("Location:../login.php");
        
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>To-Do List | ADMIN-Editar Usuarios</title>
<link rel="stylesheet" type="text/css" href="CSS/hoja.css">
<link rel="shortcut icon" type="image/x-icon" href="imagenes/icono.ico"/>
</head>

<body>
 <header class="headerusuarios">
   <h1>Bienvenido:  <?php echo $_SESSION["usuario"] ?> | Nivel »<?php echo $_SESSION["rol"]?><button style="position:relative;float:right;"><a href="../cierre.php" style="text-decoration:none;color:black;">Cerrar Sesión</a></button><button style="position:relative;float:right;"><a href="CRUD_ADMIN.php" style="text-decoration:none;color:black;">Administrar Tareas</a></button> </h1>
       <!--Enlace para cerrar la sessión--><center><h2>Actualizar Usuarios</h2></center>
   </header> 
<!--Etiqueta PHP-->
<?php
    /*Aquí incluimos el archivo con la conexion de la bbdd*/
    include("conexion.php");   
       //Esto es lo que le comentaba con anterioridad, como estoy obteniendo un mensaje de error que viene de un header location de insertaruseradmin, mistras yo estentre a esta pagina me va a saltar una notificación de que no llegó una variable lo que hago es permitir que se reporten todos los errores menos las notificaciónes que no me sirven en este momento con error reporting E_all menos e_notice;
       error_reporting(E_ALL ^ E_NOTICE);
    $insertarfallido=($_GET["insertarfallido"]);
       echo "<div style='background:#E46363;;width:40%;margin:0 auto;border-radius:5px 5px 5px 5px;font-family:slab serif;position:relative;z-index:1;'><h2 style='color:white;text-align:center;'>$insertarfallido</h2></div>";
    /*En esta parte de manera simplificada hacemos una consulta SQL Utilizando PDO  que es mucho mas eficiente y se puede hacer en una sola linea de código como lo hago aqui abajo.*/
    
    $registros=$base->query("SELECT * FROM USUARIOS_PASS WHERE ID<>{$_SESSION["id"]}")->fetchALL(PDO::FETCH_OBJ);
    
?>
<!--Aqui voy a crear un formulario en dónde voy a poner la opcion para actualizar la información-->

<!--eSTE ES EL BUSCADOR QUE UTILIZARÉ PARA FILTRAR LA INFORMACIÓN-->  
 <form action="../insertar_user_admin.php" method="post">
 <?php// echo $_SERVER['PHP_SELF'];?>
 
  <table width="50%" border="0" align="center" style="position:relative;top:100px;">
    <tr >
      <td class="primera_fila">ID</td>
      <td class="primera_fila">Usuario</td>
      <td class="primera_fila">Contraseña</td>
      <td class="primera_fila">Rol</td>
      <td class="primera_fila">Nombre</td>
      <td class="primera_fila">Apellido</td>
      <td class="primera_fila">Correo</td>
      <td class="primera_fila">Profesión</td>
    </tr> 
      
<?php	
      /*Esto es un bucle que lo que hace es que por cada objeto el cual llamo persona repite el código que hay dentro del foreach*/
    foreach($registros as $persona):?>
<!--Cada td es un campo donde apareceran los atributos-->
   	<tr>
      <td><?php echo $persona->ID?> </td>
      <td><?php echo $persona->USUARIOS?></td>
      <td><?php echo "**********"?></td>
      <td><?php echo $persona->ROL?></td>
      <td><?php echo $persona->NOMBRE?></td>
      <td><?php echo $persona->APELLIDO?></td>
      <td><?php echo $persona->CORREO?></td>
      <td><?php echo $persona->PROFESION?></td>
      
 <!--Esto puede ser un poco confuso pero lo que estoy haciendo aqui es crear un enlace en donde estoy pasando como parametro por la URL un ID. -->
     <!--PARA "BORRAR LA INFORMACION" porque realmente se borra de la tabla principal pero luego se archiva.-->
      <td class="bot">
      <a href="BORRAR_ADMIN_USUARIOS.php?ID=<?php echo $persona->ID?>">
      <input type='button' name='del' id='del' value='Borrar' style="background:rgba(231, 76, 60);color:white;border:1px solid rgba(231, 76, 60);border-radius:3px 3px 3px 3px;">
      </a>
      </td>
      <!--PARA "ACTUALIZAR LA INFORMACION".-->
      <td class='bot'>
      <a href="EDITAR_ADMIN_USUARIOS.php?ID=<?php echo $persona->ID?> & username=<?php echo $persona->USUARIOS?> & usupass=<?php echo $persona->PASSWORD?> & usurol=<?php echo $persona->ROL?> & name=<?php echo $persona->NOMBRE?> & lastname=<?php echo $persona->APELLIDO?> & email=<?php echo $persona->CORREO?> & usuprof=<?php echo $persona->PROFESION?>">
      <input type='button' name='up' id='up' value='Actualizar'  style="background:rgba(241, 196, 15);color:white;border:1px solid rgba(244, 208, 63);border-radius:3px 3px 3px 3px;">
      </a>
      </td>
    </tr>
     
<?php
    endforeach;
?>

	<tr>
	<td></td>
      <td><input type='text' name='usu' size='10' class='centrado' placeholder="Usuario" required></td>
      <td><input type='password' name='pass' size='10' class='centrado' placeholder="DEFAULT" disabled></td>
       <td>
         <select name="nivel" id="nivel" required>
         <option value="" selected="select" hidden>Nivel</option>
         <option value="1">Admin</option>
         <option value="2">Usuario</option>
          </select>
      </td>
      <td><input type='text' name='nom' size='10' class='centrado' placeholder="Nombre" required></td>
      <td><input type='text' name='ape' size='10' class='centrado' placeholder="Apellido" required></td>
      <td><input type='email' name='email' size='15' class='centrado' placeholder="Correo" required></td>
      <td><input type='text' name='prof' size='15' class='centrado' placeholder="Profesión" required></td>
      
      <td class='bot'><input type='submit' name='cr' id='cr' value='Insertar' style="background:rgba(52, 73, 94);color:white;border:1px solid rgba(52, 73, 94);border-radius:3px 3px 3px 3px;"></td></tr>    
  </table>
</form>
<p>&nbsp;</p>
 <footer class="footerusuarios">© Copyrights To-Do List Programación IV</footer>
</body>
</html>