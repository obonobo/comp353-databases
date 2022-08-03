<?php require_once '../database.php';

$statement = $conn->prepare("SELECT * FROM tester1.Users AS Users WHERE Users.uID = :uID");
$statement->bindParam(":uID", $_GET["uID"]);
$statement->execute();
$user= $statement->fetch(PDO::FETCH_ASSOC);

if (
    isset($_POST["uID"])
    && isset($_POST["fName"])
    && isset($_POST["lName"])
    && isset($_POST["dateOfBirth"])
    && isset($_POST["phoneNum"])
    && isset($_POST["email"])
    && isset($_POST["uType"])
    && isset($_POST["pstID"])
) {
    $statement = $conn->prepare("UPDATE tester1.Users SET
                                                uID = :uID,
                                                fName= :fName,
                                                lName = :lName,
                                                dateOfBirth = :dateOfBirth,
                                                phoneNum = :phoneNum,
                                                email = :email,
                                                uType = :uType,
                                                pstID = :pstID

                                                WHERE uID = :uID;");


    $statement->bindParam(':uID', $_POST["uID"]);
    $statement->bindParam(':fName', $_POST["fName"]);
    $statement->bindParam(':lName', $_POST["lName"]);
    $statement->bindParam(':dateOfBirth', $_POST["dateOfBirth"]);
    $statement->bindParam(':phoneNum', $_POST["phoneNum"]);
    $statement->bindParam(':email', $_POST["email"]);
    $statement->bindParam(':uType', $_POST["uType"]);
    $statement->bindParam(':pstID', $_POST["pstID"]);

    if ($statement->execute()) {
        header("Location: .");
    } else {
        header("Location: ./edit.php?uID=".$_POST["uID"]);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Users</title>
</head>

<body>
    <h1>Edit Users</h1>
    <form action="./edit.php" method="post">
        <label for="fName">fName</label><br>
        <input type='text' name="fName" id="fName" value="<?= $user["fName"] ?>"> <br>
        <label for="lName">lName</label><br>
        <input type='text' name="lName" id="lName" value="<?= $user["lName"] ?>"> <br>
        <label for="dateOfBirth">dateOfBirth</label><br>
        <input type='date' name="dateOfBirth" id="dateOfBirth" value="<?= $user["dateOfBirth"] ?>"> <br>
        <label for="phoneNum">phoneNum</label><br>
        <input type='text' name="phoneNum" id="phoneNum" value="<?= $user["phoneNum"] ?>"> <br>
        <label for="email">email</label><br>
        <input type='text' name="email" id="email" value="<?= $user["email"] ?>"> <br>
        <label for="uType">uType</label><br>
        <input type='text' name="uType" id="uType" value="<?= $user["uType"] ?>"> <br>
        <label for="pstID">pstID</label><br>
        <input type='number' name="pstID" id="pstID" value="<?= $user["pstID"] ?>"> <br>
        <label for="uID">uID</label><br>
        <input type='hidden' name="uID" id="uID" value="<?= $user["uID"] ?>"> <br>

        <button type="submit">Edit</button>
    </form>
</body>

</html>
