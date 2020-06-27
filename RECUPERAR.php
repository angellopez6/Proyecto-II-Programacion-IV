<?php 
try {
        //CONEXION CON LA BASE DE DATOS
 $base=new PDO("mysql:host=localhost;dbname=pruebas","root","");
        
 $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 //obtengo los datos del formulario...
 $nombre=htmlentities(addslashes($_POST['correo']));
 $clave=htmlentities(addslashes($_POST['password']));
   
 //variable auxiliar para comprobar que el usuario existe (una forma de hacerlo)
 $contador = 0;
        
 $sql = "SELECT * FROM USUARIOS_PASS WHERE CORREO = :correo";
        
 $resultado=$base->prepare($sql);

  $resultado->execute(array(":correo"=>$nombre));
	
 while($registro=$resultado->fetch(PDO::FETCH_ASSOC)) {
  if($registro["CORREO"]==true) {
       $nuevo_pass_cifrado=password_hash($clave, PASSWORD_DEFAULT, array("cost"=>12));
       $sql = "UPDATE USUARIOS_PASS SET PASSWORD=:miPass  WHERE CORREO = :correo";
        
      $resultado=$base->prepare($sql);

      $resultado->execute(array(":correo"=>$nombre,":miPass"=>$nuevo_pass_cifrado));
   
            
            header("location:recuperar_exito.php");
      
            $contador++;
  }
 }

 if ($contador==0) {
  header("Location:recuperar_fallido.php");
 } 

 $base = null;
} catch(Exception $e) {
   die($e->getMessage());
}