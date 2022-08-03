<?php require_once '../database.php';

if (
    isset($_POST["uID"]) && isset($_POST["suspendDate"])
) {
    $article = $conn->prepare("INSERT INTO tester1.Suspension (uID,suspendDate) VALUES (:uID, :suspendDate);");

    $article->bindParam(':uID', $_POST["uID"]);
    $article->bindParam(':suspendDate', $_POST["suspendDate"]);


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

        <label for="uID">uID</label><br>
        <input type='number' name="uID" id="uID"> <br>
        <label for="suspendDate">suspendDate</label><br>
        <input type='date' name="suspendDate" id="suspendDate"> <br>

        <button type="submit">Add</button>
    </form>
</body>

</html>