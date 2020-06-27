<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>To-Do List | Validar</title>
</head>
<body>
    <?php
     
    
    try {
        //CONEXION CON LA BASE DE DATOS
 $base=new PDO("mysql:host=localhost;dbname=pruebas","root","");
        
 $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 //obtengo los datos del formulario...
 $nombre=htmlentities(addslashes($_POST['login']));
 $clave=htmlentities(addslashes($_POST['password']));
 //variable auxiliar para comprobar que el usuario existe (una forma de hacerlo)
 $contador = 0;
        
 $sql = "SELECT * FROM USUARIOS_PASS WHERE USUARIOS = :nombre";
        
 $resultado=$base->prepare($sql);

  $resultado->execute(array(":nombre"=>$nombre));
	
 while($registro=$resultado->fetch(PDO::FETCH_ASSOC)) {
  if(password_verify($clave, $registro["PASSWORD"]) && $registro["ROL"]==2) {
  
            session_start();
      
      //Aqui vamos a pasarle un rol al usuario con motivo de poder validar en cualquier pagina si verdaderamente el usuario que esta ingresando es el correcto si no será expulsado y obligado a cerrar sesion.
      
             $_SESSION["usuario"]=$registro["NOMBRE"];    
             $_SESSION["rol"]=$registro["ROL"];
             $_SESSION["id"]=$registro["ID"];
            
            header("location:Sistema/");
      
            $contador++;
  }elseif(password_verify($clave, $registro["PASSWORD"]) && $registro["ROL"]==1){
      
            session_start(); 
      
             $_SESSION["usuario"]=$registro["NOMBRE"];    
             $_SESSION["rol"]=$registro["ROL"];
             $_SESSION["id"]=$registro["ID"];
           
      
            header("location:Sistema/CRUD_ADMIN.php");
      $contador++;
  }
 }

 if ($contador==0) {
     header("Location:login_fallido.php");
 } 

 $base = null;
} catch(Exception $e) {
   die($e->getMessage());
}
    
    
    
    ?>
</body>
</html>