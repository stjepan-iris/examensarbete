<?php
// min datra bas uppkopling
$host = "localhost";
    $user = "root";
    $pass = "";
    $db = "eshop";

    //mysql_query("");

    try{
    $dsn = "mysql:host=$host;dbname=$db;";
    $dbh = new PDO($dsn, $user, $pass);
    
    
    }catch(PDOException $e) {
        echo  "error!" .  $e->getMessage() . "<br />";
        die; 

    }
    ?>