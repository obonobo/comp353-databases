<?php require_once '../database.php';

$statement = $conn->prepare("DELETE FROM tester1.Users WHERE Users.uID = :uID");
$statement->bindParam(":uID", $_GET["uID"]);
$statement->execute();

header("Location: .");
