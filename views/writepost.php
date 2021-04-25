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
include("../db.php");

include("../header2.php");

session_start();

// hela if satsen skriver ut all info om en produkt/bil 
if(isset($_GET['action']) && $_GET['action'] == "write"){

    $query = "SELECT id,carModel, carInfo, datePosted,manufacturer, mileage, color, gearbox, fuel, modelYear, city, address, price FROM product WHERE id=:id LIMIT 1";
    $id = $_GET['id'];
    $sth = $dbh->prepare($query);
    $sth->bindParam(':id', $id);
    $return = $sth->execute();

    // sql fråga som hämtar alla bilder som är kopplade med product/carid
    $query_image = "SELECT img.fileName FROM img JOIN product ON product.id = img.carId WHERE product.id = $id";
    $return_image = $dbh->query($query_image);
    $row_image = $return_image->fetchAll();

    if (!$return) {
        print_r($dbh->errorInfo());
        die;
    }

    $row = $sth->fetch();
    // kollar om man är admin 
    echo "<div  class='singelCarImgWrapper'>";
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
        foreach($row_image as $img){
            echo "<div class='singleImgContainer'>";
                echo "<img class='singlePostImg' src='../img/" . $img['fileName'] . "'>";
                echo "<a class='deletImgBtn' href='../includes/deletImg.php?car=" . $id . "&fileName=" . $img['fileName'] . "'>delet image</a>";
            echo "</div>";
        }
    }else {
        foreach($row_image as $img){
            echo "<img class='singlePostImg' src='../img/" . $img['fileName'] . "'>";
        }
    }
        // skriver ut all info på en bil ifrån databasen
    
    echo "</div>";
    echo "<div class='singleCarPageInfoContainer'>";
        echo "<div class='singleCarPageInfo'>";
            echo "<span class='guestspan'>Bil märke:" . " " . $row['manufacturer']. "</span>";
            echo "<span class='guestspan'>bil modell:" . " " . $row['carModel']. "</span>";
            echo "<span class='guestspan'>mer info:" . " " . $row['carInfo']. "</span>";
            echo "<span class='guestspan'>posted" . " " . $row['datePosted']. "</span>";
            echo "<span class='guestspan'>Miltal:" . " " . $row['mileage']. "</span>";
            echo "<span class='guestspan'>Färg:" . " " . $row['color']. "</span>";
            echo "<span class='guestspan'>Växellåda:" . " " . $row['gearbox']. "</span>";
            echo "<span class='guestspan'>Bränsle:" . " " . $row['fuel']. "</span>";
            echo "<span class='guestspan'>modellår:" . " " . $row['modelYear']. "</span>";
            echo "<span class='guestspan'>city:" . " " . $row['city']. "</span>";
            echo "<span class='guestspan'>address:" . " " . $row['address']. "</span>";
            echo "<span class='guestspan'>pris:" . " " . $row['price']. "</span>";
            echo "<div class='singelCarBtns'>";
                if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
                    echo "<a class='singelBtn' href='../includes/adminposthandler.php?action=delete&id=" . $row['id'] . "'>DELETE!</a>";
                    echo "<a class='singelBtn' href='../views/editform.php?id=" . $row['id'] . "'>Edit product!</a>";
                    echo "<a class='singelBtn' href='adminpage.php'>tillbacka</a>";
                    }else{
                        echo "  " . "<a class='singelBtn' href='../index.php'>tillbacka</a>";
                    }
            echo "</div>";
        echo "</div>";
    echo "</div>";
  
    

}


?>
</body>
</html>