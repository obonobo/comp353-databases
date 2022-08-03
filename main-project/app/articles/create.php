<?php require_once '../database.php';

if (
    isset($_POST["artTitle"]) && isset($_POST["authName"]) && isset($_POST["majTopic"])
    && isset($_POST["minTopic"]) && isset($_POST["pubDate"]) && isset($_POST["summary"])
    && isset($_POST["uID"])
) {
    $article = $conn->prepare("INSERT INTO tester1.Article (artTitle,authName,majTopic,minTopic,pubDate,summary,uID) VALUES (:artTitle,:authName,:majTopic,:minTopic,:pubDate,:summary,:uID);");

    $article->bindParam(':artTitle', $_POST["artTitle"]);
    $article->bindParam(':authName', $_POST["authName"]);
    $article->bindParam(':majTopic', $_POST["majTopic"]);
    $article->bindParam(':minTopic', $_POST["minTopic"]);
    $article->bindParam(':pubDate', $_POST["pubDate"]);
    $article->bindParam(':summary', $_POST["summary"]);
    $article->bindParam(':uID', $_POST["uID"]);

    if ($article->execute()) {
        header("Location: .");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>createArticle</title>
</head>

<body>
    <form action="./create.php" method="post">
        <label for="artTitle">Title</label><br>
        <input type='text' name="artTitle" id="artTitle"> <br>
        <label for="authName">AuthName</label><br>
        <input type='text' name="authName" id="authName"> <br>
        <label for="majTopic">majTopic</label><br>
        <input type='text' name="majTopic" id="majTopic"> <br>
        <label for="minTopic">minTopic</label><br>
        <input type='text' name="minTopic" id="minTopic"> <br>
        <label for="pubDate">pubDate</label><br>
        <input type='date' name="pubDate" id="pubDate"> <br>
        <label for="summary">summary</label><br>
        <input type='text' name="summary" id="summary"> <br>
        <label for="uID">uID</label><br>
        <input type='number' name="uID" id="uID"> <br>
        <button type="submit">Add</button>
    </form>
</body>

</html>
