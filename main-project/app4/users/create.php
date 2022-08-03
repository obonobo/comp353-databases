<?php require_once '../database.php';

if (
    isset($_POST["fName"]) && isset($_POST["lName"]) && isset($_POST["dateOfBirth"])
    && isset($_POST["phoneNum"]) && isset($_POST["email"]) && isset($_POST["uType"])
    && isset($_POST["pstID"])
) {
    $article = $conn->prepare("INSERT INTO tester1.Users (fName,lName,dateOfBirth,phoneNum,email,uType,pstID) VALUES (:fName,:lName,:dateOfBirth,:phoneNum,:email,:uType,:pstID);");

    $article->bindParam(':fName', $_POST["fName"]);
    $article->bindParam(':lName', $_POST["lName"]);
    $article->bindParam(':dateOfBirth', $_POST["dateOfBirth"]);
    $article->bindParam(':phoneNum', $_POST["phoneNum"]);
    $article->bindParam(':email', $_POST["email"]);
    $article->bindParam(':uType', $_POST["uType"]);
    $article->bindParam(':pstID', $_POST["pstID"]);

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
    <title>Create User</title>
</head>

<body>
    <form action="./create.php" method="post">
        <label for="fName">fName</label><br>
        <input type='text' name="fName" id="fName"> <br>
        <label for="lName">lName</label><br>
        <input type='text' name="lName" id="lName"> <br>
        <label for="dateOfBirth">dateOfBirth</label><br>
        <input type='date' name="dateOfBirth" id="dateOfBirth"> <br>
        <label for="phoneNum">phoneNum</label><br>
        <input type='text' name="phoneNum" id="phoneNum"> <br>
        <label for="email">email</label><br>
        <input type='text' name="email" id="email"> <br>
        <label for="uType">uType</label><br>
        <input type='text' name="uType" id="uType"> <br>
        <label for="pstID">pstID</label><br>
        <input type='number' name="pstID" id="pstID"> <br>

        <button type="submit">Add</button>
    </form>
</body>

</html>
