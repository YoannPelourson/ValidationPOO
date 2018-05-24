<?php
    #phpinfo();
    require_once ('./autoload.php');
    session_start();
    
   
    //$game->createFighters();

?>

<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="./assets/css/style.css">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<header></header>

<main>


    <?php

        $game = new GameClass();
       //$game->fight();


    ?>

</main>

<footer>
    <a href="index.php?state=reset">RESET</a>
</footer>
</body>
</html>
