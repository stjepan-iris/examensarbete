<?php
include("../db.php");
include("../views/writepost.php");
// handerar bortagning av bild som admin vill ta bort av en specifik produckt/bil
$carId = $_GET['car'];
$fileName = $_GET['fileName'];

$delete_path = "../uploads/" . $fileName;


$query = "DELETE FROM img WHERE carId = :carId AND fileName = :fileName";
$sth = $dbh->prepare($query);
$sth->bindParam(':carId', $carId);
$sth->bindParam(':fileName', $fileName);
$return = $sth->execute();


if (!$return) {
    print_r($dbh->errorInfo());
} else {
    header("location:../views/writepost.php?action=write&id=" . $carId);
}

?>