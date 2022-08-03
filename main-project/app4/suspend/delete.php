<?php require_once '../database.php';

$statement = $conn->prepare("DELETE FROM tester1.Suspension WHERE Suspension.uID = :uID");
$statement->bindParam(":uID", $_GET["uID"]);
$statement->execute();

header("Location: .");
