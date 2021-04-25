<?php
    // destroyar session så att admin blir utloggad 
    session_start();
    session_destroy();

    header("location:../index.php");


?>