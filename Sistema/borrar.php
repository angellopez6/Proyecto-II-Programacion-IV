<?php
//Este es el filtro para que deje acceder solo al usuario competente
//Esto es lo primero que el navegador ve entonces se reanuda la session de la variable super global.

session_start();
//Esto es lo más facil de explicar y entender, si la sessión no esta iniciada nadie que se le ocurra copiar el URL y pegarlo en un navegador podrá acceder a menos que no haya iniciado sessión Previamente.
if(!isset($_SESSION["usuario"])){
    
  header("location:../cierre.php");

        
}

/*Este archivo lo que hace es capturar mediante URL el ID*/
include("conexion.php");

$ID=$_GET["ID"];

if($_SESSION["rol"]=="2"){ 
//Esto es un gran logro para mi xD pero bueno he aqui mi gran consulta.
$base->query("INSERT INTO tareas_archivadas(ID, CATEGORIA, DESCRIPCION, FECHA_CREACION, FECHA_ACTUALIZACION,FECHA_ELIMINACION, STATUS, USUARIO_ID) SELECT ID, CATEGORIA, DESCRIPCION, FECHA_CREACION, FECHA_ACTUALIZACION,CURRENT_TIMESTAMP, STATUS, USUARIO_ID FROM tareas where ID='$ID'; DELETE FROM TAREAS WHERE ID='$ID';");

header("Location:index.php");
    
}else if($_SESSION["rol"]=="1"){ 
//Esto es un gran logro para mi xD pero bueno he aqui mi gran consulta.
$base->query("INSERT INTO tareas_archivadas(ID, CATEGORIA, DESCRIPCION, FECHA_CREACION, FECHA_ACTUALIZACION,FECHA_ELIMINACION, STATUS, USUARIO_ID) SELECT ID, CATEGORIA, DESCRIPCION, FECHA_CREACION, FECHA_ACTUALIZACION,CURRENT_TIMESTAMP, STATUS, USUARIO_ID FROM tareas where ID='$ID'; DELETE FROM TAREAS WHERE ID='$ID';");

header("Location:CRUD_ADMIN.php");
}
?>