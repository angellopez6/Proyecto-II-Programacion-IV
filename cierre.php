<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <?php
    //Aqui lo que vamos a hacer es construir un código que sea capaz de destruir la sesión abierta para asi lograr deslogearse de la página.
    session_start();
    
    session_destroy();
    
    header("Location:index.php");
    ?>
</body>
</html>