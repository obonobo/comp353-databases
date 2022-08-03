<?php require_once '../database.php';

if (
    // isset($_POST["fName"])
    //  && isset($_POST["lName"]) 
    //  && isset($_POST["dateOfBirth"])
    //  && isset($_POST["phoneNum"])
    //  && isset($_POST["email"])
    //  && isset($_POST["uType"])
    //  && isset($_POST["pstID"])
    //  && isset($_POST["username"])
    //  && isset($_POST["password"])
    // && 
     isset($_POST["uID"])
    // && isset($_POST["oID"])
) {
    $delegate = $conn->prepare("INSERT INTO tester1.orgDelegate (uID) VALUES (:uID);");

    // $delegate->bindParam(':fName', $_POST["fName"]);
    // $delegate->bindParam(':lName', $_POST["lName"]);
    // $delegate->bindParam(':dateOfBirth', $_POST["dateOfBirth"]);
    // $delegate->bindParam(':phoneNum', $_POST["phoneNum"]);
    // $delegate->bindParam(':email', $_POST["email"]);
    // $delegate->bindParam(':uType', $_POST["uType"]);
    // $delegate->bindParam(':pstID', $_POST["pstID"]);
    // $delegate->bindParam(':username', $_POST["username"]);
    // $delegate->bindParam(':password', $_POST["password"]);
    $delegate->bindParam(':uID', $_POST["uID"]);
    // $delegate->bindParam(':oID', $_POST["oID"]);

    if ($delegate->execute()) {
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
    <title>createOrganizationDelegate</title>
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
        <label for="username">Username</totPopulation><br>
        <input type='text' name="username" id="username"> <br>
        <label for="password">password</label><br>
        <input type='text' name="password" id="password"> <br> -->
        <label for="uID">uID</totPopulation><br>
        <input type='number' name="uID" id="uID"> <br>
        <!-- <label for="oID">oID</totPopulation><br>
        <input type='number' name="oID" id="oID"> <br> -->

        <button type="submit">Add</button>
    </form>
</body>

</html>