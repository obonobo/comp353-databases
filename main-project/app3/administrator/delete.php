<?php require_once '../database.php';

$statement = $conn->prepare("DELETE FROM tester1.Admin WHERE Admin.adminID = :adminID");
$statement->bindParam(":adminID", $_GET["adminID"]);
$statement->execute();

header("Location: .");
