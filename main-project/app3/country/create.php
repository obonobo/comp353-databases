<?php require_once '../database.php';

if (
     isset($_POST["cName"]) && isset($_POST["rID"])
) {
    $country = $conn->prepare("INSERT INTO tester1.Country (cName,rID) VALUES (:cName,:rID);");

    $country->bindParam(':cName', $_POST["cName"]);
    $country->bindParam(':rID', $_POST["rID"]);

    if ($country->execute()) {
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
    <title>createCountry</title>
</head>

<body>
    <form action="./create.php" method="post">

        <label for="cName">countryName</label><br>
        <input type='text' name="cName" id="cName"> <br>
        <label for="rID">regionID</label><br>
        <input type='text' name="rID" id="rID"> <br>

        <button type="submit">Add</button>
    </form>
</body>

</html>
