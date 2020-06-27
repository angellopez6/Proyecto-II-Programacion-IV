<?php
//Este es el filtro para que deje acceder solo al usuario competente
//Esto es lo primero que el navegador ve entonces se reanuda la session de la variable super global.

session_start();
//Esto es lo más facil de explicar y entender, si la sessión no esta iniciada nadie que se le ocurra copiar el URL y pegarlo en un navegador podrá acceder a menos que no haya iniciado sessión Previamente.
if(!isset($_SESSION["usuario"]) || $_SESSION["rol"]=="1"){
    
    header("location:../cierre.php");
    //header("Location:../login.php");
        
}


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>To-Do List | Editar Tareas Usuarios</title>
<link rel="stylesheet" type="text/css" href="CSS/hoja.css">
<link rel="shortcut icon" type="image/x-icon" href="imagenes/icono.ico"/>
</head>

<body>
 <header class="headerusuarios">
   <h1>Sesión:  <?php echo $_SESSION["usuario"] ?> | Nivel »<?php echo $_SESSION["rol"]?><button style="position:relative;float:right;"><a href="../cierre.php" style="text-decoration:none;color:black;">Cerrar Sesión</a></button><button style="position:relative;float:right;"><a href="index.php" style="text-decoration:none;color:black;">Volver a Tareas</a></button> </h1>
       <!--Enlace para cerrar la sessión--><center><img src="imagenes/actualizar.jpg" alt="" style="height:15em;width:40em;"></center>
       <hr>
   </header> 
<?php
    
/*Almacenamos los datos que le llegan por parametros a travez de la URL*/
    
    //Actualizar
    include("conexion.php");
    
    if(!isset($_POST["bot_actualizar"])){ 
    
    $ID=$_GET["ID"];
    
    $categoria=$_GET["Cat"];
        
    $descripcion=$_GET["Des"];
        
    $status=$_GET["Sta"];
        
    }else{
        
        $ID=$_POST["ID"];
        
        $categoria=$_POST["Cat"];
        
        $descripcion=$_POST["Des"];
        
        $status=$_POST["Sta"];
        //Esto esta muñeco.
        $sql="UPDATE TAREAS SET CATEGORIA=:miCat, DESCRIPCION=:miDes, STATUS=:miSta,FECHA_ACTUALIZACION=current_timestamp() WHERE ID=:miID";
        
        
        $resultado=$base->prepare($sql);
        
        $resultado->execute(array(":miID"=>$ID, ":miCat"=>$categoria,":miDes"=>$descripcion,":miSta"=>$status));
        
        header("Location:index.php");
    }    
?>

<p>
 
</p>
<p>&nbsp;</p>
<!--Fíjese que lo que hago aquí es enviar la información por medio del action hacia la misma pagina y eso lo logra con la funcion PHPSELF-->
<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <table width="25%" border="0" align="center" style="position:relative;top:50%;">
    <tr>
      <td></td>
      <td><label for="ID"></label>
      <!--Esto es un campo oculto porque vamos a utilizar el id para actualizar la información-->
      <input type="hidden" name="ID" id="ID" value="<?php echo $ID ?>"></td>
    </tr>
    
    <tr>
      <td>Categoría</td>
       <td>
        <select name="Cat" id="Cat" value="<?php echo $categoria ?>">
        <option value="<?php echo $categoria ?>" selected="select" hidden><?php echo $categoria ?></option>
         <option value="Capacitación">Capacitación</option>
         <option value="Clases">Clases</option>
         <option value="DevelRoot">DevelRoot</option>
          <option value="Entretenimiento">Entretenimiento</option>
          <option value="Salud">Salud</option>
          <option value="Social">Social</option>
          <option value="Trabajos">Trabajos</option>
          </select>
        </td>
    </tr>
    <tr>
      <td>Descripción</td>
      <td><label for="Des"></label>
      <input type="text" name="Des" id="Des"  value="<?php echo $descripcion ?>" required></td>
    </tr>
    
     <tr>
      <td>Status</td>
      <td>
          <select name="Sta" id="Sta" value="<?php echo $status?>">
             <option value="<?php echo $status?>" selected="select" hidden><?php echo $status?></option>
              <option value="Por Hacer">Por Hacer</option>
              <option value="En Proceso">En Proceso</option>
              <option value="Finalizado">Finalizado</option>
          </select>
      </td>
      </tr>
    <tr>
      <td colspan="2"><input type="submit" name="bot_actualizar" id="bot_actualizar" value="Actualizar" style="background:rgba(241, 196, 15);color:white;border:1px solid rgba(244, 208, 63);border-radius:3px 3px 3px 3px;"></td>
    </tr>
  </table>
</form>
    <p>&nbsp;</p>
<footer class="footerusuarios">© Copyrights To-Do List Programación IV</footer>
</body>
</html>