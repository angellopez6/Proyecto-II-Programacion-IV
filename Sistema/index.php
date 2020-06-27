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
<title>To-Do List | Tareas Usuarios</title>
<link rel="stylesheet" type="text/css" href="CSS/hoja.css">
<link rel="shortcut icon" type="image/x-icon" href="imagenes/icono.ico"/>
</head>

<body>
  <header class="headerusuarios">
   <h1>Bienvenido:  <?php echo $_SESSION["usuario"] ?> | Nivel »<?php echo $_SESSION["rol"]?><button style="position:relative;float:right;"><a href="../cierre.php" style="text-decoration:none;color:black;">Cerrar Sesión</a></button> </h1>
       <!--Enlace para cerrar la sessión--><center><img src="imagenes/banner.jpg" alt="" style="height:200px;width:30em;"></center>
   </header>  
<!--Etiqueta PHP-->
<?php
    //Vamos a darle la Bienvenida al usuario que se ha logeado correctamente.
    
   
    /*Aquí incluimos el archivo con la conexion de la bbdd*/
    include("conexion.php");   
    
    
    /*En esta parte de manera simplificada hacemos una consulta SQL Utilizando PDO que es mucho mas eficiente y se puede hacer en una sola linea de código como lo hago aqui abajo.*/
    
    $registros=$base->query("SELECT * FROM TAREAS WHERE USUARIO_ID={$_SESSION['id']}")->fetchALL(PDO::FETCH_OBJ);
    
    //para crear
    if(isset($_POST["cr"])){
        
        
        $categoria=$_POST["Cat"];
        
        $descripcion=$_POST["Des"];
        
        $status=$_POST["Sta"];
        
        /*INSERT INTO `tareas` (`ID`, `CATEGORIA`, `DESCRIPCION`, `FECHA_CREACION`, `FECHA_ACTUALIZACION`, `STATUS`, `USUARIO_ID`) VALUES (NULL, 'NEGOCIOS', 'PAGAR TLF', current_timestamp(), current_timestamp(), 'POR HACER', '2');*/
        $sql="INSERT INTO TAREAS (CATEGORIA,DESCRIPCION,FECHA_CREACION,FECHA_ACTUALIZACION,STATUS,USUARIO_ID) VALUES (:Cat,:Des,current_timestamp(),current_timestamp(),:Sta,{$_SESSION['id']})";
        
        $resultado=$base->prepare($sql);
        
        $resultado->execute(array(":Cat"=>$categoria,":Des"=>$descripcion,":Sta"=>$status));
        
        header("Location:index.php");
    }
?>

<!--Aqui voy a crear un formulario en dónde voy a poner la opcion para actualizar la información-->

<!--eSTE ES EL BUSCADOR QUE UTILIZARÉ PARA FILTRAR LA INFORMACIÓN--> 
  
   <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" >
      <div class="divbuscar">
      <select name="buscat" id="buscat" style="position:relative;margin:auto;">
         <option value="" selected="select">Todos los registros</option>
          <option value="Capacitación">Capacitación</option>
         <option value="Clases">Clases</option>
         <option value="DevelRoot">DevelRoot</option>
          <option value="Entretenimiento">Entretenimiento</option>
          <option value="Salud">Salud</option>
          <option value="Social">Social</option>
          <option value="Trabajos">Trabajos</option>
      </select>
       <input type="submit" name="buscador" id="enviar" value="Buscar" style="background:rgba(10, 33, 60);color:white;border:1px solid rgba(10, 33, 60);border-radius:3px 3px 3px 3px;"><br>
       <input type="radio" id="Todos" name="Sta" value="" required checked>
              <label for="Todos">Todos</label><br>
        <input type="radio" id="PorHacer" name="Sta" value="Por Hacer" required>
              <label for="PorHacer">Por Hacer</label><br>
          <input type="radio" id="EnProceso" name="Sta" value="En Proceso" required>
              <label for="EnProceso">En Proceso</label><br>
          <input type="radio" id="Finalizado" name="Sta" value="Finalizado" required>
              <label for="Finalizado">Finalizado</label>
    </div>
   </form>
   <?php
  if(isset($_POST["buscador"])){
      
      $buscat=$_POST["buscat"];
      $estado=$_POST["Sta"];
      
       $registros=$base->query("SELECT * FROM TAREAS WHERE CATEGORIA LIKE '%$buscat%' AND STATUS LIKE '%$estado%' AND USUARIO_ID={$_SESSION['id']}")->fetchALL(PDO::FETCH_OBJ);
      
      if(empty($registros)){
         
          echo "<div style='background:#E46363;;width:40%;margin:0 auto;border-radius:5px 5px 5px 5px;font-family:slab serif;position:relative;z-index:1;'><h2 style='color:white;text-align:center;'>Alerta!</h2><p style='color:white;'>Ningún registro con esa categoría o status fue encontrado para ".$_SESSION["usuario"]."</p></div>";
      
      }
      
  }
    ?>
   
 <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
 
  <table width="50%" border="0" align="center">
    <tr >
      <td class="primera_fila">ID</td>
      <td class="primera_fila">Categoría</td>
      <td class="primera_fila">Descripción</td>
      <td class="primera_fila">Creación</td>
      <td class="primera_fila">Actualización</td>
      <td class="primera_fila">Status</td>
    </tr> 
      
<?php	
      /*Esto es un bucle que lo que hace es que por cada objeto el cual llamo persona repite el código que hay dentro del foreach*/
    foreach($registros as $persona):?>
<!--Cada td es un campo donde apareceran los atributos-->
   	<tr>
      <td><?php echo $persona->ID?> </td>
      <td><?php echo $persona->CATEGORIA?></td>
      <td><?php echo $persona->DESCRIPCION?></td>
      <td><?php echo $persona->FECHA_CREACION?></td>
      <td><?php echo $persona->FECHA_ACTUALIZACION?></td>
      <td><?php echo $persona->STATUS?></td>
      
 <!--Esto puede ser un poco confuso pero lo que estoy haciendo aqui es crear un enlace en donde estoy pasando como parametro por la URL un ID. -->
     <!--PARA "BORRAR LA INFORMACION" porque realmente se borra de la tabla principal pero luego se archiva.-->
      <td class="bot">
      <a href="borrar.php?ID=<?php echo $persona->ID?>">
      <input type='button' name='del' id='del' value='Borrar' style="background:rgba(231, 76, 60);color:white;border:1px solid rgba(231, 76, 60);border-radius:3px 3px 3px 3px;">
      </a>
      </td>
      <td class='bot'>
      <a href="editar.php?ID=<?php echo $persona->ID?> & Cat=<?php echo $persona->CATEGORIA?> & Des=<?php echo $persona->DESCRIPCION?> & Sta=<?php echo $persona->STATUS?>">
      <input type='button' name='up' id='up' value='Actualizar' style="background:rgba(241, 196, 15);color:white;border:1px solid rgba(244, 208, 63);border-radius:3px 3px 3px 3px;">
      </a>
      </td>
    </tr> 
    
<?php
    endforeach;
?>

	<tr>
	<td></td>
      <td>
         <select name="Cat" id="Cat">
         <option value="Capacitación">Capacitación</option>
         <option value="Clases">Clases</option>
         <option value="DevelRoot">DevelRoot</option>
          <option value="Entretenimiento">Entretenimiento</option>
          <option value="Salud">Salud</option>
          <option value="Social">Social</option>
          <option value="Trabajos">Trabajos</option>
          </select>
      </td>
      <td><input type='text' name='Des' size='10' class='centrado' placeholder="Descripción" required></td>
      <td><input type='hidden' name='Cre' size='10' class='centrado'></td>
      <td><input type='hidden' name='Act' size='10' class='centrado'></td>
      <td>
          <select name="Sta" id="Sta">
              <option value="Por Hacer">Por Hacer</option>
              <option value="En Proceso">En Proceso</option>
              <option value="Finalizado">Finalizado</option>
          </select>
      </td>
      
      <td class='bot'><input type='submit'  name='cr' id='cr' value='Insertar' style="background:rgba(52, 73, 94);color:white;border:1px solid rgba(52, 73, 94);border-radius:3px 3px 3px 3px;"></td></tr>  
  </table>
</form>
<p>&nbsp;</p>
 <footer class="footerusuarios">© Copyrights To-Do List Programación IV</footer>
</body>
</html>