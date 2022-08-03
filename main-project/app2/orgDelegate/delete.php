<?php require_once '../database.php';

$statement = $conn->prepare("DELETE FROM tester1.orgDelegate WHERE orgDelegate.delegateID = :delegateID");
$statement->bindParam(":delegateID", $_GET["delegateID"]);
$statement->execute();

header("Location: .");
