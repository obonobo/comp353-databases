<?php require_once '../database.php';

if (isset($_POST["artTitle"]))
    $statement = $conn->prepare("INSERT INTO tester1.RemovedArticles (aID,removalDate) VALUES (:aID,:removalDate)");
$statement->bindParam(":aID", $_POST["aID"]);
$statement->bindParam(":aID", $_POST["removalDate"]);
$statement->execute();

if ($article->execute()) {
    header("Location: .");
}
?>
