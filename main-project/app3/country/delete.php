<?php require_once '../database.php';

$statement = $conn->prepare("DELETE FROM tester1.Country WHERE Country.cID = :cID");
$statement->bindParam(":cID", $_GET["cID"]);
$statement->execute();

header("Location: .");

?>
