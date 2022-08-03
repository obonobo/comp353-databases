<?php require_once '../database.php';

if (
 isset($_POST["uID"])
) {
    $administrator = $conn->prepare("INSERT INTO tester1.Admin (uID) VALUES (:uID);");

    // $administrator->bindParam(':fName', $_POST["fName"]);
    // $administrator->bindParam(':lName', $_POST["lName"]);
    // $administrator->bindParam(':dateOfBirth', $_POST["dateOfBirth"]);
    // $administrator->bindParam(':phoneNum', $_POST["phoneNum"]);
    // $administrator->bindParam(':email', $_POST["email"]);
    // $administrator->bindParam(':uType', $_POST["uType"]);
    // $administrator->bindParam(':pstID', $_POST["pstID"]);
    // $administrator->bindParam(':username', $_POST["username"]);
    // $administrator->bindParam(':password', $_POST["password"]);
    $administrator->bindParam(':uID', $_POST["uID"]);

    if ($administrator->execute()) {
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
    <title>createAdministrator</title>
</head>

<body>
    <form action="./create.php" method="post">
        <!-- <label for="fName">FirstName</label><br>
        <input type='Text' name="fName" id="fName"> <br>
        <label for="lName">LastName</label><br>
        <input type='text' name="lName" id="lName"> <br>
        <label for="dateOfBirth">DateOfBirth</label><br>
        <input type='date' name="dateOfBirth" id="dateOfBirth"> <br>
        <label for="phoneNum">PhoneNumber</totPopulation><br>
        <input type='number' name="phoneNum" id="phoneNum"> <br>
        <label for="email">Email</label><br>
        <input type='text' name="email" id="email"> <br>
        <label for="uType">UserType</label><br>
        <input type='text' name="uType" id="uType"> <br>
        <label for="pstID">pstID</label><br>
        <input type='number' name="pstID" id="pstID"> <br>
        <label for="username">Usernname</totPopulation><br>
        <input type='text' name="username" id="username"> <br>
        <label for="password">password</label><br>
        <input type='text' name="password" id="password"> <br> -->
        <label for="uID">uID</totPopulation><br>
        <input type='number' name="uID" id="uID"> <br>

        <button type="submit">Add</button>
    </form>
</body>

</html>
