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

 
//Esto es un gran logro para mi xD pero bueno he aqui mi gran consulta.
$base->query("INSERT INTO usuarios_pass_archivados SELECT * FROM usuarios_pass WHERE ID='$ID';
INSERT INTO `tareas_archivadas`(`ID`, `CATEGORIA`, `DESCRIPCION`, `FECHA_CREACION`, `FECHA_ACTUALIZACION`, `FECHA_ELIMINACION`, `STATUS`, `USUARIO_ID`)
SELECT `ID`, `CATEGORIA`, `DESCRIPCION`, `FECHA_CREACION`, `FECHA_ACTUALIZACION`,CURRENT_TIMESTAMP, `STATUS`, `USUARIO_ID` FROM `tareas` WHERE USUARIO_ID='$ID';
DELETE FROM usuarios_pass WHERE ID='$ID';");

header("Location:CRUD_ADMIN_USUARIOS.php");
    

?>