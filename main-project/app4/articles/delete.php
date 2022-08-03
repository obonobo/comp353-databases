<?php require_once '../database.php';

if (isset($_POST["aID"]))
{
  $statement = $conn->prepare("INSERT INTO tester1.RemovedArticles (aID) VALUES (:aID);");
  $statement->bindParam(":aID", $_POST["aID"]);
  $statement->execute();

  if ($statement->execute()) {
      header("Location: ./");
  }
}



?>
