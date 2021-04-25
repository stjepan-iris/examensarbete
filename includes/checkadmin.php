<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php
    // kollar om du är admin och skickar dig vidare till rätt sida 
        session_start();
        echo (isset($_GET['err']) && $_GET['err'] == true ? "något gick fel" : "");

        if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){

            //echo "hej ". $_SESSION['username'] . " du är admin" ."!<br />";
            //include("../views/adminpage.php");
            header("location:../views/adminpage.php");
            

        }
       else {
            
        echo "du ar inte admin";
        echo "  " . "<a href='../index.php'>tillbacka</a>";

        } 
    ?>
</body>
</html>