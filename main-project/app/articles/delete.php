<?php require_once '../database.php';

$statement = $conn->prepare("DELETE FROM tester1.Article WHERE Article.aID = :aID");
$statement->bindParam(":aID", $_GET["aID"]);
$statement->execute();

header("Location: .");

?>
