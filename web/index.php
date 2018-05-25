<?php
    spl_autoload_register(function($class){
    include("./class/".$class.".php");  
    });
    session_start();
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">    
    <title>Document</title>
</head>
<body>
   
    <?php
    RoutingClass::route();
    ?>

    
    
</body>
</html>