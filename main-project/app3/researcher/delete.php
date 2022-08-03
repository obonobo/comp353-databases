<?php require_once '../database.php';

$statement = $conn->prepare("DELETE FROM tester1.Researcher WHERE Researcher.researcherID = :researcherID");
$statement->bindParam(":researcherID", $_GET["researcherID"]);
$statement->execute();

header("Location: .");
