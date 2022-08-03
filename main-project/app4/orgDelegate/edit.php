<?php require_once '../database.php';

$statement = $conn->prepare("SELECT * FROM tester1.orgDelagate, tester1.specialUser, tester1.Users WHERE orgDelagate.uID = specialUser.uID AND specialUser.uID = Users.uID AND orgDelagate.delagateID = :delagateID");
$statement->bindParam(":delagateID", $_GET["delagateID"]);
$statement->execute();
$delagate = $statement->fetch(PDO::FETCH_ASSOC);

if (
    isset($_POST["fName"])
     && isset($_POST["lName"])
     && isset($_POST["dateOfBirth"])
     && isset($_POST["phoneNum"])
     && isset($_POST["email"])
     && isset($_POST["uType"])
     && isset($_POST["pstID"])
     && isset($_POST["username"])
     && isset($_POST["password"])
     && isset($_POST["uID"])
     && isset($_POST["oID"])
     && isset($_POST["delagateID"])
) {
    $statement = $conn->prepare("UPDATE tester1.orgDelagate SET
                                                fName = :fName,
                                                lName= :lName,
                                                dateOfBirth = :dateOfBirth,
                                                phoneNum = :phoneNum,
                                                email = :email,
                                                uType= :uType
                                                pstID = :pstID,
                                                username = :username,
                                                password = :password,
                                                uID =:uID,
                                                oID =:oID,
                                                delagateID = :delagateID


                                                WHERE delagateID = :delagateID;");


    $statement->bindParam(':fName', $_POST["fName"]);
    $statement->bindParam(':lName', $_POST["lName"]);
    $statement->bindParam(':dateOfBirth', $_POST["dateOfBirth"]);
    $statement->bindParam(':phoneNum', $_POST["phoneNum"]);
    $statement->bindParam(':email', $_POST["email"]);
    $statement->bindParam(':uType', $_POST["uType"]);
    $statement->bindParam(':pstID', $_POST["pstID"]);
    $statement->bindParam(':username', $_POST["username"]);
    $statement->bindParam(':password', $_POST["password"]);
    $statement->bindParam(':uID', $_POST["uID"]);
    $statement->bindParam(':oID', $_POST["oID"]);
    $statement->bindParam(':delagateID', $_POST["delagateID"]);


    if ($statement->execute()) {
        header("Location: .");
    } else {
        header("Location: ./edit.php?delagateID=" . $_POST["delagateID"]);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Organization Delegate</title>
</head>

<body>
    <h1>Edit Organization Delegate</h1>
    <form action="./edit.php" method="post">
        <label for="fName">FirstName</label><br>
        <input type='text' name="fName" id="fName" value="<?= $delagate["fName"] ?>"> <br>
        <label for="lName">LastName</label><br>
        <input type='text' name="lName" id="lName" value="<?= $delagate["lName"] ?>"> <br>
        <label for="dateOfBirth">dateOfBirth</label><br>
        <input type='date' name="dateOfBirth" id="dateOfBirth" value="<?= $delagate["dateOfBirth"] ?>"> <br>
        <label for="phoneNum">PhoneNumber</totPopulation><br>
        <input type='number' name="phoneNum" id="phoneNum"  value="<?= $delagate["phoneNum"] ?>"> <br>
        <label for="email">Email</label><br>
        <input type='text' name="email" id="email" value="<?= $delagate["email"] ?>"> <br>
        <label for="uType">UserType</label><br>
        <input type='text' name="uType" id="uType" value="<?= $delagate["uType"] ?>"> <br>
        <label for="pstID">pstID</label><br>
        <input type='number' name="pstID" id="pstID" value="<?= $delagate["pstID"] ?>"> <br>
        <label for="username">Username</label><br>
        <input type='text' name="username" id="username" value="<?= $delagate["username"] ?>"> <br>
        <label for="password">Password</totPopulation><br>
        <input type='text' name="password" id="password"  value="<?= $delagate["password"] ?>"> <br>
        <label for="uID">uID</label><br>
        <input type='hidden' name="uID" id="uID" value="<?= $delagate["uID"] ?>"> <br>
        <label for="delagateID">delagateID</label><br>
        <input type='hidden' name="delagateID" id="delagateID" value="<?= $delagate["delagateID"] ?>"> <br>

        <button type="submit">Edit</button>
    </form>
</body>

</html>
