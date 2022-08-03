<?php require_once '../database.php';

$statement = $conn->prepare("DELETE FROM tester1.orgDelagate WHERE orgDelagate.delagateID = :delagateID");
$statement->bindParam(":delagateID", $_GET["delagateID"]);
$statement->execute();

header("Location: .");
