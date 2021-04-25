<?php

include("db.php");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
    include("header.php");
?>

<!-- sökfrormulär -->
<form method="GET" action="index.php" class="searchFormContainer">
    <div class="formInputsContainer">
            <input class="searchInput" type="search" name="search_query" placeholder="bil märke">
            <input class="searchBtn" type="submit" name="submit">
    </div>
    
</form>




<?php 
// en if stats som kollar om man har sökt på ett bilmärke
        if(isset($_GET['search_query'])){
            $order = "desc";
            if(isset($_GET['order']) && $_GET['order'] == "ascending"){

                $order ="asc";

            }
            // sql fråga till databasen som kolla efter märken man sökte på.
            $searchQuery = $_GET['search_query'];
            $query = "SELECT id, carModel, carInfo, datePosted, manufacturer  FROM product WHERE carModel LIKE :searchQuery OR manufacturer LIKE :searchQuery ORDER BY datePosted $order";
            $sth = $dbh->prepare($query);
            $queryparam = '%' . $searchQuery .'%';
            $sth->bindParam(':searchQuery', $queryparam);


            $return = $sth->execute();

            if(!$return){
                print_r($sth->errorInfo());
                die;
            }
            ?>
            <div class="searchResults">
                <?php
                // skickar ut antalet hittade på märket du sökte på
                echo "<h2>Sökresultat!</h2><p> Vi hittade " . $sth->rowCount() . " bilar på sökordet $searchQuery! " ."</p>"; 
                echo "<a href='index.php'>Tillbaka</a>";   

                ?>
            </div>
            <div class="carContainter">
            <?php
            // en while loop som skickar ut alla produckter/bilar som finns i, 
            //databasen och skriver ut det till användaren med det bilmärket du har sökt på
            while($row = $sth->fetch(PDO::FETCH_ASSOC))
            {
                $id = $row['id'];

                $query_image = "SELECT img.fileName FROM img JOIN product ON product.id = img.carId WHERE product.id = $id";
                $img = $dbh->query($query_image);
                $row_image = $img->fetch();

                echo "<div class='singleCarContainter'>";
                echo '<img class="carImg" src="img/'.$row_image['fileName'].'" alt="product image"/>';
                echo "<div class='singleCarInfoContainter'>";
                    echo "<span>Bil märke:" . " " . $row['manufacturer'] . "</span>";
                    echo "<span>bil modell:" . " " . $row['carModel'] . "</span>";
                    echo "<span>Postat:" . " " . $row['datePosted'] . "</span>";
                echo "</div>";
                echo "<a class='moreInfoBtn' href='views/writepost.php?action=write&id=". $row['id'] ."'class='guestspan'>". "more info" ."</a>";
                echo "</div>";
            }
            ?>

            </div>
    <?php
        
    } else{

    ?>

<?php 
    // här skrivenr den ut allt ifrån databasen så att användaren kan se det.
    $order = "desc";
    if(isset($_GET['order']) && $_GET['order'] == "ascending"){

        $order ="asc";

    }

    $query = "SELECT * FROM product ORDER BY datePosted $order";
    $rows = $dbh->query($query);

    ?>

    <div class="carContainter">
    <?php
    
    foreach ($rows as $row) {
            $id = $row['id'];

            $query_image = "SELECT img.fileName FROM img JOIN product ON product.id = img.carId WHERE product.id = $id";
            $img = $dbh->query($query_image);
            $row_image = $img->fetch();
        
        echo "<div class='singleCarContainter'>";
            echo '<img class="carImg" src="img/'.$row_image['fileName'].'" alt="product image"/>';
            echo "<div class='singleCarInfoContainter'>";
                echo "<span class='guestspan'>Bil märke:" . " " . $row['manufacturer'] . "</span>";
                echo "<span class='guestspan'>bil modell:" . " " . $row['carModel'] . "</span>";
                echo "<span class='guestspan'>Postat:" . " " . $row['datePosted'] . "</span>";
            echo "</div>";
            echo "<a class='moreInfoBtn' href='views/writepost.php?action=write&id=". $row['id'] ."'class='guestspan'>". "more info" ."</a>";
            
            if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
            echo "<a href='../includes/adminposthandler.php?action=delete&id=" . $row['id'] . "'>DELETE!</a>";
            echo "  " . "<a href='../views/editform.php?id=" . $row['id'] . "'>Edit product!</a>";
            }
        echo "</div>";
    }
    ?>

    </div>
    <?php
    }

?>


</form>    
</body>
</html>