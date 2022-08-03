<?php require_once '../database.php';

$statement = $conn->prepare("DELETE FROM tester1.Organization WHERE Organization.oID = :oID");
$statement->bindParam(":oID", $_GET["oID"]);
$statement->execute();

header("Location: .");
