<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Document</title>
</head>
<body>
    <?php
    include("../header2.php");
    ?>
    <!--ett änkelt formulär som andvänds för att logga in  -->
<div class="loginContainer">
    <form class="loginForm" action="../includes/loginhandler.php" method="post">
           <p> Username </p>
            
            <input class="userInput" type="text" name="username" >
            
            <p> Password </p>
        
            <input class="passInput" type="password" name="password" >
            
            <input class="loginInput" type="submit" value="loggin">
        </form>
    </body>
</div>
</html>