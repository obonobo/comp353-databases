<?php require_once '../database.php';

$statement = $conn->prepare("DELETE FROM tester1.VaccineRecords WHERE VaccineRecords.compID = :compID");
$statement->bindParam(":compID", $_GET["compID"]);
$statement->execute();

header("Location: .");
