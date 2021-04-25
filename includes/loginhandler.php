<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
// handerar admin login. kontrolerar att lösenord och användarnamn stämmed i databasen
include("../db.php");

$username = $_POST['username'];
$password = md5($_POST['password']);

$query = "SELECT id, username, password, role FROM users WHERE username='$username' AND password='$password'";

$return = $dbh->query($query);

$row = $return->fetch(PDO::FETCH_ASSOC);

if(empty($row)){
    
    echo "du ar inte admin";
    echo "  " . "<a href='../index.php'>tillbacka</a>";
    
}else {
    
    session_start();
    $_SESSION['username'] = $row['username'];
    $_SESSION['password'] = $row['password'];
    $_SESSION['role']     = $row['role'];
    $_SESSION['id']       = $row['id'];

    header("location:checkadmin.php");
}


?>
    
</body>
</html>