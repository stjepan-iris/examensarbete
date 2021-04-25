<?php
session_start();
include("../db.php");
// if sats som kolla om vi skickar med en action == delete då ska hela produckt/bil tas bort
if(isset($_GET['action']) && $_GET['action'] == "delete"){

    $query = "DELETE FROM product WHERE id=".$_GET['id'];
    $tabort = $dbh->exec($query);

    header("location:../views/adminpage.php");


}
// lägger till att som kommer från adminnewcar och lägger till det som en ny produckt/bil i databasen  
else{
    
    if(isset($_POST['submit'])){

        $carInfo = (!empty($_POST['carInfo']) ? $_POST['carInfo'] : "");
        $carModel = (!empty($_POST['carModel']) ? $_POST['carModel'] : "");
        $manufacturer = (!empty($_POST['manufacturer']) ? $_POST['manufacturer'] : "");
        $mileage = (!empty($_POST['mileage']) ? $_POST['mileage'] : "");
        $color  = (!empty($_POST['color']) ? $_POST['color'] : "");
        $gearbox = (!empty($_POST['gearbox']) ? $_POST['gearbox'] : "");
        $fuel = (!empty($_POST['fuel']) ? $_POST['fuel'] : "");
        $modelYear = (!empty($_POST['modelYear']) ? $_POST['modelYear'] : "");
        $city = (!empty($_POST['city']) ? $_POST['city'] : "");
        $address = (!empty($_POST['address']) ? $_POST['address'] : "");
        $price = (!empty($_POST['price']) ? $_POST['price'] : "");

        $carInfo = htmlspecialchars($carInfo);  
        $carModel = htmlspecialchars($carModel);
        $manufacturer = htmlspecialchars($manufacturer);
        $mileage = htmlspecialchars($mileage);
        $color = htmlspecialchars($color);
        $gearbox = htmlspecialchars($gearbox);
        $fuel = htmlspecialchars($fuel);
        $modelYear = htmlspecialchars($modelYear);
        $city = htmlspecialchars($city);
        $address = htmlspecialchars($address);
        $price = htmlspecialchars($price);

        $errors = false;
        $errorMessages = "";

        
        if(empty($_POST['carInfo'])){
            $errorMessages .= "du måste skriva ett medelande";
            $errors = true;
        }
        if(empty($_POST['carModel'])){
            $errorMessages .= "du måste skriva model";
            $errors = true;
        }
        if(empty($_POST['manufacturer'])){
            $errorMessages .= "du måste skriva tillvärkare";
            $errors = true;
        }
        if(empty($_POST['color'])){
            $errorMessages .= "du måste skriva färg";
            $errors = true;
        }
        if(empty($_POST['gearbox'])){
            $errorMessages .= "du måste skriva vexellåda";
            $errors = true;
        }
        if(empty($_POST['Fuel'])){
            $errorMessages .= "du måste skriva bränsle";
            $errors = true;
        }
        if(empty($_POST['modelYear'])){
            $errorMessages .= "du måste skriva model year";
            $errors = true;
        }
        if(empty($_POST['city'])){
            $errorMessages .= "du måste skriva model year";
            $errors = true;
        }
        if(empty($_POST['address'])){
            $errorMessages .= "du måste skriva model year";
            $errors = true;
        }
        if(empty($_POST['price'])){
            $errorMessages .= "du måste skriva pris";
            $errors = true;
        }

        if($errors == true){
            echo $errorMessages;
            echo '<a href="includes/login.php">gå tillbaka</a>';
            die;

        }
        $userID = (int)$_SESSION['id'];
        $query = "INSERT INTO product (carModel,carInfo, userID, manufacturer, mileage, color, gearbox, fuel, modelYear, city, address, price) VALUES(:carModel, :carInfo, :id, :manufacturer, :mileage, :color, :gearbox, :fuel, :modelYear, :city, :address, :price);";

        $sth = $dbh->prepare($query);
        $sth->bindParam(':carModel', $carModel);
        $sth->bindParam(':carInfo', $carInfo);
        $sth->bindParam(':id', $userID);
        $sth->bindParam(':manufacturer', $manufacturer);
        $sth->bindParam(':mileage', $mileage);
        $sth->bindParam(':color', $color);
        $sth->bindParam(':gearbox', $gearbox);
        $sth->bindParam(':fuel', $fuel);
        $sth->bindParam(':modelYear', $modelYear);
        $sth->bindParam(':city', $city);
        $sth->bindParam(':address', $address);
        $sth->bindParam(':price', $price);

       $return = $sth->execute();

        $carId = $dbh->lastInsertId();

        if (!empty($_FILES['file']['name'])){
    
        $file = count($_FILES['file']['name']);

        for($i=0;$i<$file;$i++){
            $file_name = $_FILES['file']['name'][$i];
            
    // post variabler för writepost
        $file_tmp_name = $_FILES['file']['tmp_name'][$i];
        $file_size = $_FILES['file']['size'][$i];
        $file_error = $_FILES['file']['error'][$i];
        $file_type = $_FILES['file']['type'][$i];

        $file_ext = explode('.', $file_name);
        $file_actual_ext = strtolower(end($file_ext)); 

        $allowed = array('jpg', 'jpeg', 'png', ' ');

        // lägger till file för posten samt gör en rad för ny post.
        if (in_array($file_actual_ext, $allowed)) {
            if ($file_error === 0) {
                if ($file_size < 10000000) {
                    $file_new_name = uniqid('', true) . "." . $file_actual_ext;
                    $file_destination = '../img/' . $file_new_name;
                    move_uploaded_file($file_tmp_name, $file_destination);
                
                    
                } else {
                    echo "Din fil är för stor!";
                }
            } else {
                echo "Det blev ett error vid uppladdningen av filen";
            }
        } else {
        echo "Du kan inte ladda upp filer av denna typ";
            }
        
            if (empty($_FILES['file']['name'])){
            $file_new_name = " ";
            }

                    $query_image = "INSERT INTO img(carId, fileName) VALUES (:car_id, :file_new_name)";
                    $sth = $dbh->prepare($query_image);
                    $sth->bindParam(':car_id', $carId);
                    $sth->bindParam(':file_new_name', $file_new_name);
                    $return = $sth->execute();
                
                    $sth->debugDumpParams();
            }
        }
}
        if(!$return){
        print_r($dbh->errorInfo()); 
        }
        else{
            header("location:../views/adminpage.php");
        }
}
?>