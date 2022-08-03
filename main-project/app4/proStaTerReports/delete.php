<?php require_once '../database.php';

$statement = $conn->prepare("DELETE FROM tester1.proStaTerRecords WHERE proStaTerRecords.pstID = :pstID");
$statement->bindParam(":pstID", $_GET["pstID"]);
$statement->execute();

header("Location: .");
