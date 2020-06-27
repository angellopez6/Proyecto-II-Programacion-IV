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
<title>To-Do List | ADMIN-Editar</title>
<link rel="stylesheet" type="text/css" href="CSS/hoja.css">
<link rel="shortcut icon" type="image/x-icon" href="imagenes/icono.ico"/>
</head>

<body>
 <header class="headerusuarios">
   <h1>Sesión:  <?php echo $_SESSION["usuario"] ?> | Nivel »<?php echo $_SESSION["rol"]?><button style="position:relative;float:right;"><a href="../cierre.php" style="text-decoration:none;color:black;">Cerrar Sesión</a></button><button style="position:relative;float:right;"><a href="CRUD_ADMIN_USUARIOS.php" style="text-decoration:none;color:black;">Volver a Usuarios</a></button></h1><center><img src="imagenes/actualizaradminusuarios.png" alt=""></center>
       <!--Enlace para cerrar la sessión-->
   </header> 

<?php
/*Almacenamos los datos que le llegan por parametros a travez de la URL*/
    
    //Actualizar
    include("conexion.php");
    
    //Declaro mis constantes
     const usercontra = "22222";
    const admincontra = "12345";
    
    if(!isset($_POST["bot_actualizar"])){ 
    
     $ID=$_GET["ID"];
     $username=$_GET["username"];
     $usupass=$_GET["usupass"];
     $usurol=$_GET["usurol"];
     $name=$_GET["name"];
     $lastname=$_GET["lastname"];
     $email=$_GET["email"];
     $usuprof=$_GET["usuprof"];
        
    }else{
        
     $ID=$_POST["ID"];
     $username=$_POST["username"];
     $usupass=$_POST["restablecer"];
     $usurol=$_POST["usurol"];
     $name=$_POST["name"];
     $lastname=$_POST["lastname"];
     $email=$_POST["email"];
     $usuprof=$_POST["usuprof"];
        
        if(!isset($usupass)){ 
        //Esto esta muñeco.
        $sql="UPDATE USUARIOS_PASS SET USUARIOS=:miUsername, ROL=:miRol, NOMBRE=:miName,APELLIDO=:miLastname,CORREO=:miEmail , PROFESION=:miProf WHERE ID=:miUsuid";
        
        
        $resultado=$base->prepare($sql);
        try{ 
        $resultado->execute(array(":miUsuid"=>$ID, ":miUsername"=>$username,":miRol"=>$usurol,":miName"=>$name,":miLastname"=>$lastname,":miEmail"=>$email,":miProf"=>$usuprof));
        
        
        header("Location:CRUD_ADMIN_USUARIOS.php");
            
        }catch(Exception $e){
             
            
            echo "<div style='background:#E46363;;width:40%;margin:0 auto;border-radius:5px 5px 5px 5px;font-family:slab serif;position:relative;z-index:1;'><h2 style='color:white;text-align:center;'>Alerta!</h2><p style='color:white;text-align:justify'>No se pudo actualizar la información, usted esta realizando operaciones maliciosas para perjudicar el sistema, esta siendo advertido, SERA BANEADO PERMANENTEMENTE</p></div>";
      
        }
            
            
    }elseif(isset($usupass) && $usurol==1){ 
        //Esto esta muñeco.
        $sql="UPDATE USUARIOS_PASS SET USUARIOS=:miUsername, PASSWORD=:miPass, ROL=:miRol, NOMBRE=:miName,APELLIDO=:miLastname,CORREO=:miEmail , PROFESION=:miProf WHERE ID=:miUsuid";
        
        
        $resultado=$base->prepare($sql);
            $pass_admin_default_cifrada=password_hash(admincontra, PASSWORD_DEFAULT, array("cost"=>12));
        try{ 
        $resultado->execute(array(":miUsuid"=>$ID,":miPass"=>$pass_admin_default_cifrada, ":miUsername"=>$username,":miRol"=>$usurol,":miName"=>$name,":miLastname"=>$lastname,":miEmail"=>$email,":miProf"=>$usuprof));
        
        
        header("Location:CRUD_ADMIN_USUARIOS.php");
            
        }catch(Exception $e){
            
            echo $e;
        }
        
        
    }elseif(isset($usupass) && $usurol==2){ 
        //Esto esta muñeco.
        $sql="UPDATE USUARIOS_PASS SET USUARIOS=:miUsername, PASSWORD=:miPass, ROL=:miRol, NOMBRE=:miName,APELLIDO=:miLastname,CORREO=:miEmail , PROFESION=:miProf WHERE ID=:miUsuid";
        
        
        $resultado=$base->prepare($sql);
            $pass_user_default_cifrada=password_hash(usercontra, PASSWORD_DEFAULT, array("cost"=>12));
        try{ 
        $resultado->execute(array(":miUsuid"=>$ID,":miPass"=>$pass_user_default_cifrada, ":miUsername"=>$username,":miRol"=>$usurol,":miName"=>$name,":miLastname"=>$lastname,":miEmail"=>$email,":miProf"=>$usuprof));
        
        
        header("Location:CRUD_ADMIN_USUARIOS.php");
            
        }catch(Exception $e){
            echo "<div style='background:#E46363;;width:40%;margin:0 auto;border-radius:5px 5px 5px 5px;font-family:slab serif;position:relative;z-index:1;'><h2 style='color:white;text-align:center;'>Alerta!</h2><p style='color:white;text-align:justify'>No se pudo actualizar la información, usted esta realizando operaciones maliciosas para perjudicar el sistema, esta siendo advertido, SERA BANEADO PERMANENTEMENTE</p></div>";
        }
        
        
    }
    }
        
        
?>

<p>
 
</p>
<p>&nbsp;</p>
<!--Fíjese que lo que hago aquí es enviar la información por medio del action hacia la misma pagina y eso lo logra con la funcion PHPSELF-->
<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <table width="25%" border="0" align="center" style="position:relative;top:25%;">
    <tr>
      <td></td>
      <td><label for="ID"></label>
      <!--Esto es un campo oculto porque vamos a utilizar el id para actualizar la información-->
      <input type="hidden" name="ID" id="ID" value="<?php echo $ID ?>"></td>
    </tr> 
    <tr>
      <td>Usuario</td>
       <td>
      <input type="text" name="username" value="<?php echo $username ?>" size="10" class="centrado">
        </td>
    </tr>
     <tr>
         <td>Restablecer Contraseña</td>
            <td>
            <input type="checkbox" name="restablecer" value="<?php echo $usupass ?>">
             </td>
         </tr>
    <tr>
      <td>Rol</td>
      <td>
         <!--Esto funciona bien y lo que hace es mostrarme en palabras que tipo de usuario es en vez de 1 o 2 pues-->
          <select name="usurol" id="usurol" value="">
              <option value="<?php echo $usurol ?>" selected="select" hidden><?php if($usurol==1){echo "ADMIN";}elseif($usurol==2){echo "USUARIO";}?></option>
              <option value="1">ADMIN</option>
              <option value="2">USUARIO</option>
          </select>
      </td>
      </tr>
      <tr>
         <td>Nombre</td>
              <td><input type='text' name='name' size='10' class='centrado' value="<?php echo $name ?>" required></td>
         </tr>
          <tr>
         <td>Apellido</td>
              <td><input type='text' name='lastname' size='10' class='centrado' value="<?php echo $lastname?>" required></td>
         </tr>
          <tr>
         <td>Correo</td>
              <td><input type='text' name='email' size='10' class='centrado' value="<?php echo $email ?>" required></td>
         </tr>
          <tr>
         <td>Profesión</td>
              <td><input type='text' name='usuprof' size='10' class='centrado' value="<?php echo $usuprof ?>" required></td>
         </tr>
      <tr>
      <td colspan="2"><input type="submit" name="bot_actualizar" id="bot_actualizar" value="Actualizar"  style="background:rgba(241, 196, 15);color:white;border:1px solid rgba(244, 208, 63);border-radius:3px 3px 3px 3px;"></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
<footer class="footerusuarios">© Copyrights To-Do List Programación IV</footer>
</body>
</html>