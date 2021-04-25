<?php
    include("../db.php");
    session_start();

    // handerar allt data som kommer ifrån edit form och skriver in det i databasen och tar bort det gamla som står där

       
    if(isset($_POST['submit'])){

        

        if (!empty($_FILES['file']['name'])){
    
            $file = count($_FILES['file']['name']);
    
            for($i=0;$i<$file;$i++){
                $file_name = $_FILES['file']['name'][$i];
                
        
            $file_tmp_name = $_FILES['file']['tmp_name'][$i];
            $file_size = $_FILES['file']['size'][$i];
            $file_error = $_FILES['file']['error'][$i];
            $file_type = $_FILES['file']['type'][$i];
    
            $file_ext = explode('.', $file_name);
            $file_actual_ext = strtolower(end($file_ext)); 
    
            $allowed = array('jpg', 'jpeg', 'png', ' ');
    
            
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

                        $carId = (isset($_POST['productid']) ? $_POST['productid'] : '');

                        $query_image = "INSERT INTO img(carId, fileName) VALUES (:car_id, :file_new_name)";
                        $sth = $dbh->prepare($query_image);
                        $sth->bindParam(':car_id', $carId);
                        $sth->bindParam(':file_new_name', $file_new_name);
                        $return = $sth->execute();
                    
                        $sth->debugDumpParams();
                }
            }
       
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
            $id = (!empty($_POST['productid']) ? $_POST['productid'] : "");

            
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


            $query = "UPDATE product SET carModel='$carModel', carInfo='$carInfo', manufacturer='$manufacturer', mileage='$mileage', color='$color', gearbox='$gearbox', fuel='$fuel', modelYear='$modelYear', city='$city', address='$address', price='$price' WHERE id= $id";

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
}

    

    

    
    
    header("location:../views/writepost.php?action=write&id=$id");

?>