<?php

	$usuario= $_POST["usu"];
	$contrasenia= $_POST["pass"];
    $nom=$_POST["nom"];
    $ape=$_POST["ape"];
    $email=$_POST["email"];
    $prof=$_POST["prof"];
    $nivel=$_POST["nivel"];
    //Aqui ciframos la contraseña atendiendo a los requerimientos del profesor sin embargo utilizamos la funcion password_hash porque es mas segura.
    $pass_cifrado=password_hash($contrasenia, PASSWORD_DEFAULT, array("cost"=>12));
				
    //Defino constantes para cada nivel de usuarios que el admin cree, esto lo lei en php manuel y no s epuede definir una constante dentro de un flujo de ejecucion asi que la definimos afuera.
    const usercontra = "22222";
    const admincontra = "12345";
    
    
     $base=new PDO("mysql:host=localhost;dbname=pruebas","root","");
        
     $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
     $sql = "SELECT * FROM USUARIOS_PASS WHERE USUARIOS = :nombre";
        
     $resultado=$base->prepare($sql);

     $resultado->execute(array(":nombre"=>$usuario));
	
     $registro=$resultado->fetch(PDO::FETCH_ASSOC); 
         

	try{
         $base=new PDO("mysql:host=localhost;dbname=pruebas","root","");
        
     $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //ESTO FUE UN ARREGLO DE úLTIMO MOMENTO PORQUE ME PARECIÓ SUMAMENTE IMPORTANTE PARA NO PERJUDICAR EL SISTEMA EL HECHO DE QUE NO PUEDAN EXISTIR 2 USUARIOS CON EL MISMO USERNAME PORQUE SINO PERJUDICA LAS FUNCIONES DEL SISTEMA...POSTDATA:SI POR ALGUNA RAZÓN EL SISTEMA PRESENTA ALGÚN TIPO DE FALLA EXTRAÑA "QUE LO DUDO" ES PROBABLE DE QUE ESTE IF QUE ENGLOBA LA FUNCION DE AÑADIR USUARIOS AL SISTEMA SEA EL RESPONSABLE Y NO ME DIÓ TIEMPO DE HACER LAS VALIDACIONES PERTINENTES PARA DETECTAR TODAS LAS FALLAS, SIN EMBARGO HICE UNA PRUEBA RÁPIDA Y TODO PARECE ANDAR BIEN...
         $contador=0;
         if($registro>0){ 
             $insertarfallido="El username ya está en uso, porfavor intente otro.";
             //echo "El usuario existe"; $contador++;
             header("Location:Sistema/CRUD_ADMIN_USUARIOS.php?insertarfallido=$insertarfallido");
                        
                        
                        }else{ 
        //La idea que le habia comentado la implementé lo que hace es lo siguiente, verifica que la variable nivel devuelva un valor de true osea si esta seteada de no ser asi quiere decir que es un usuario regular el que se esta registranro, de otro modo llegue lo que me llegue desde cualquier otro form que por motivos de seguridad va a estar dentro del panel administrador voy a crear un usuario que el admin escoja.
        
        if(isset($nivel) && $nivel==1) {
            //Si no es verdad se ejecuta esto osea que me llegó un nivel quiere decir que un administrador lo esta mandando entonces ejecuta lo siguiente.
            
            $admindefault=password_hash(admincontra, PASSWORD_DEFAULT, array("cost"=>12));
            
        $base=new PDO('mysql:host=localhost; dbname=pruebas', 'root', '');
		
		$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$base->exec("SET CHARACTER SET utf8");
            //consulta
		$sql="INSERT INTO USUARIOS_PASS (USUARIOS, PASSWORD,ROL,NOMBRE,APELLIDO,CORREO,PROFESION) VALUES (:usu, :pass,:nivel,:nom,:ape,:email,:prof)"; 
        
		$resultado=$base->prepare($sql);		
		
		
		$resultado->execute(array(":usu"=>$usuario, ":pass"=>$admindefault, ":nivel"=>$nivel,":nom"=>$nom,":ape"=>$ape,":email"=>$email,":prof"=>$prof));		
		
		
		header("Location:Sistema/CRUD_ADMIN_USUARIOS.php");
		
		$resultado->closeCursor();
            
            //Para el usuario
        }else if(isset($nivel) && $nivel==2) {
            //Si no es verdad se ejecuta esto osea que me llegó un nivel quiere decir que un administrador lo esta mandando entonces ejecuta lo siguiente.
            //CREO MI CONTRASEÑA POR DEFECTO 
            //$default="22222";
            //La cifro
            $userdefault=password_hash(usercontra, PASSWORD_DEFAULT, array("cost"=>12));
            
        $base=new PDO('mysql:host=localhost; dbname=pruebas', 'root', '');
		
		$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$base->exec("SET CHARACTER SET utf8");
            //consulta
		$sql="INSERT INTO USUARIOS_PASS (USUARIOS, PASSWORD,ROL,NOMBRE,APELLIDO,CORREO,PROFESION) VALUES (:usu, :pass,:nivel,:nom,:ape,:email,:prof)"; 
        
		$resultado=$base->prepare($sql);		
		
		
		$resultado->execute(array(":usu"=>$usuario, ":pass"=>$userdefault, ":nivel"=>$nivel,":nom"=>$nom,":ape"=>$ape,":email"=>$email,":prof"=>$prof));		
		
		
		header("Location:Sistema/CRUD_ADMIN_USUARIOS.php");
		
		$resultado->closeCursor();
        }
         }

	}catch(Exception $e){			
		
		
		echo "Usted esta realizando operaciones extrañas que no cumplen lo establecido para registrar un usuario,esta siendo advertido! Podrá ser Baneado Permanentemente: " . $e->getLine();
		
	}finally{
		
		$base=null;
		
		
	}

?>