<?php require_once '../database.php';

$statement = $conn->prepare("SELECT * FROM tester1.Admin, tester1.specialUser, tester1.Users WHERE Admin.uID = specialUser.uID AND specialUser.uID = Users.uID AND Admin.adminID = :adminID");
$statement->bindParam(":adminID", $_GET["adminID"]);
$statement->execute();
$administrator = $statement->fetch(PDO::FETCH_ASSOC);

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
) {
    $statement = $conn->prepare("UPDATE tester1.Admin SET
                                                fName = :fName,
                                                lName= :lName,
                                                dateOfBirth = :dateOfBirth,
                                                phoneNum = :phoneNum,
                                                email = :email,
                                                uType= :uType
                                                pstID = :pstID,
                                                username = :username,
                                                password = :password,
                                                uID =:uID
                                                adminID = :adminID

                                                WHERE adminID = :adminID;");


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
    $statement->bindParam(':adminID', $_POST["adminID"]);

    if ($statement->execute()) {
        header("Location: .");
    } else {
        header("Location: ./edit.php?adminID=" . $_POST["adminID"]);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Administrator</title>
</head>

<body>
    <h1>Edit Administrator</h1>
    <form action="./edit.php" method="post">
        <label for="fName">FirstName</label><br>
        <input type='text' name="fName" id="fName" value="<?= $administrator["fName"] ?>"> <br>
        <label for="lName">LastName</label><br>
        <input type='text' name="lName" id="lName" value="<?= $administrator["lName"] ?>"> <br>
        <label for="dateOfBirth">dateOfBirth</label><br>
        <input type='date' name="dateOfBirth" id="dateOfBirth" value="<?= $administrator["dateOfBirth"] ?>"> <br>
        <label for="phoneNum">PhoneNumber</totPopulation><br>
        <input type='number' name="phoneNum" id="phoneNum"  value="<?= $administrator["phoneNum"] ?>"> <br>
        <label for="email">Email</label><br>
        <input type='text' name="email" id="email" value="<?= $administrator["email"] ?>"> <br>
        <label for="uType">UserType</label><br>
        <input type='text' name="uType" id="uType" value="<?= $administrator["uType"] ?>"> <br>
        <label for="pstID">pstID</label><br>
        <input type='number' name="pstID" id="pstID" value="<?= $administrator["pstID"] ?>"> <br>
        <label for="username">Username</label><br>
        <input type='text' name="username" id="username" value="<?= $administrator["username"] ?>"> <br>
        <label for="password">Password</totPopulation><br>
        <input type='text' name="password" id="password"  value="<?= $administrator["password"] ?>"> <br>
        <label for="uID">uID</label><br>
        <input type='hidden' name="uID" id="uID" value="<?= $administrator["uID"] ?>"> <br>
        <label for="adminID">adminID</label><br>
        <input type='hidden' name="adminID" id="adminID" value="<?= $administrator["adminID"] ?>"> <br>

        <button type="submit">Edit</button>
    </form>
</body>

</html>
