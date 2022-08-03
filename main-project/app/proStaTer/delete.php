<?php require_once '../database.php';

$statement = $conn->prepare("DELETE FROM tester1.proStaTer WHERE proStaTer.pstID = :pstID");
$statement->bindParam("pstID", $_GET["pstID"]);
$statement->execute();

header("Location: .");

?>
