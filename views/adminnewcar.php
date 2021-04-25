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
    <!-- ett formulär som mägger till en ny produckt/bil till databasen -->
            <div class="addCarFormContainer">
                <form class="addCarForm" action='../includes/adminposthandler.php' method='POST' enctype='multipart/form-data'>
                
                    <input class="carInfoInputs" type='text' name='manufacturer' placeholder='Tillvärkare' required>
                    
                    <input class="carInfoInputs" type='text' name='carModel' placeholder='Modell' required>
                    
                    <textarea class="carInfoInputs" type='text' name='carInfo' placeholder='Skriv mer info'></textarea>
                    
                    <input class="carInfoInputs" type='file' name='file[]' id='fileToUpload' multiple required>
                    
                    <input class="carInfoInputs" type='text' name='mileage' id='mileage' placeholder='Miltal' required>
                    
                    <input class="carInfoInputs" type='text' name='color' id='color' placeholder='Färg' required>
                    
                    <input class="carInfoInputs" type='text' name='gearbox' id='gearbox' placeholder='Växellåda' required>
                    
                    <input class="carInfoInputs" type='text' name='Fuel' id='fuel' placeholder='Bränsle' required>
                    
                    <input class="carInfoInputs" type='text' name='modelYear' id='modelYear' placeholder='Modellår' required>
                    
                    <input class="carInfoInputs" type='text' name='city' id='city' placeholder='stad' required>
                    
                    <input class="carInfoInputs" type='text' name='address' id='address' placeholder='adress' required>
                    
                    <input class="carInfoInputs" type='text' name='price' id='price' placeholder='pris' required>
                    
                    <input class="addCarBtn" type='submit' name='submit' value='submit'>
                    <a class="backFromForm" href='adminpage.php'>tillbacka</a>

                </form>
            </div>
</body>
</html>