<?php require_once '../database.php';

$statement = $conn->prepare("DELETE FROM tester1.ProStatTerRecords WHERE ProStatTerRecords.PSTId = :PSTId");
$statement->bindParam(":PSTId", $_GET["PSTId"]);
$statement->execute();

header("Location: .");
