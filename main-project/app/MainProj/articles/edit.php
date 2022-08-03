<?php require_once '../database.php';

$statement = $conn->prepare("SELECT * FROM tester1.Article AS Article WHERE Article.aID = :aID");
$statement->bindParam(":aID", $_GET["aID"]);
$statement->execute();
$article = $statement->fetch(PDO::FETCH_ASSOC);

if (
    isset($_POST["artTitle"])
    && isset($_POST["authName"])
    && isset($_POST["majTopic"])
    && isset($_POST["minTopic"])
    && isset($_POST["pubDate"])
    && isset($_POST["summary"])
    && isset($_POST["uID"])
    && isset($_POST["aID"])
) {
    $statement = $conn->prepare("UPDATE tester1.Article SET
                                                artTitle = :artTitle,
                                                authName= :authName,
                                                majTopic = :majTopic,
                                                minTopic = :minTopic,
                                                pubDate = :pubDate,
                                                summary = :summary,
                                                uID = :uID,
                                                aID = :aID

                                                WHERE aID = :aID;");


    $statement->bindParam(':artTitle', $_POST["artTitle"]);
    $statement->bindParam(':authName', $_POST["authName"]);
    $statement->bindParam(':majTopic', $_POST["majTopic"]);
    $statement->bindParam(':minTopic', $_POST["minTopic"]);
    $statement->bindParam(':pubDate', $_POST["pubDate"]);
    $statement->bindParam(':summary', $_POST["summary"]);
    $statement->bindParam(':uID', $_POST["uID"]);
    $statement->bindParam(':aID', $_POST["aID"]);

    if ($statement->execute()) {
        header("Location: .");
    } else {
        header("Location: ./edit.php?aID=".$_POST["aID"]);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Article</title>
</head>

<body>
    <h1>Edit Article</h1>
    <form action="./edit.php" method="post">
        <label for="artTitle">Title</label><br>
        <input type='text' name="artTitle" id="artTitle" value="<?= $article["artTitle"] ?>"> <br>
        <label for="authName">AuthName</label><br>
        <input type='text' name="authName" id="authName" value="<?= $article["authName"] ?>"> <br>
        <label for="majTopic">majTopic</label><br>
        <input type='text' name="majTopic" id="majTopic" value="<?= $article["majTopic"] ?>"> <br>
        <label for="minTopic">minTopic</label><br>
        <input type='text' name="minTopic" id="minTopic" value="<?= $article["minTopic"] ?>"> <br>
        <label for="pubDate">pubDate</label><br>
        <input type='date' name="pubDate" id="pubDate" value="<?= $article["pubDate"] ?>"> <br>
        <label for="summary">summary</label><br>
        <input type='text' name="summary" id="summary" value="<?= $article["summary"] ?>"> <br>
        <label for="uID">uID</label><br>
        <input type='number' name="uID" id="uID" value="<?= $article["uID"] ?>"> <br>
        <label for="aID">aID</label><br>
        <input type='hidden' name="aID" id="aID" value="<?= $article["aID"] ?>"> <br>

        <button type="submit">Edit</button>
    </form>
</body>

</html>
