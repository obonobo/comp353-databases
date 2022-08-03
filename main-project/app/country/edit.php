<?php require_once '../database.php';

$statement = $conn->prepare("SELECT * FROM tester1.Country AS Country WHERE Country.cID = :cID");
$statement->bindParam(":cID", $_GET["cID"]);
$statement->execute();
$country = $statement->fetch(PDO::FETCH_ASSOC);

if (
    isset($_POST["cID"])
    && isset($_POST["cName"])
    && isset($_POST["rID"])
) {
    $statement = $conn->prepare("UPDATE tester1.Country SET

                                                cName= :cName,
                                                rID = :rID,
                                                cID = :cID

                                                WHERE cID = :cID;");


    $statement->bindParam(':cID', $_POST["cID"]);
    $statement->bindParam(':cName', $_POST["cName"]);
    $statement->bindParam(':rID', $_POST["rID"]);

    if ($statement->execute()) {
        header("Location: .");
    } else {
        header("Location: ./edit.php?cID=".$_POST["cID"]);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Country</title>
</head>

<body>
    <h1>Edit Country</h1>

    <form action="./edit.php" method="post">

        <label for="cID">cID</label><br>
        <input type='hidden' name="cID" id="cID" value="<?= $country["cID"] ?>"> <br>
        <label for="cName">Country Name</label><br>
        <input type='text' name="cName" id="cName" value="<?= $country["cName"] ?>"> <br>
        <label for="rID">Region ID</label><br>
        <input type='number' name="rID" id="rID" value="<?= $country["rID"] ?>"> <br>

        <button type="submit">Edit</button>
    </form>
</body>

</html>
