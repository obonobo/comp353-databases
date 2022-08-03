<?php require_once '../database.php';

$statement = $conn->prepare("DELETE FROM tester1.Region WHERE Region.rID = :rID");
$statement->bindParam("rID", $_GET["rID"]);
$statement->execute();

header("Location: .");

?>
