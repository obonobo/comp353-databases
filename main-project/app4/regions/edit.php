<?php require_once '../database.php';

$statement = $conn->prepare("SELECT * FROM tester1.Region AS Region WHERE Region.rID = :rID");
$statement->bindParam(":rID", $_GET["rID"]);
$statement->execute();
$country = $statement->fetch(PDO::FETCH_ASSOC);

if (
    isset($_POST["rID"])
    && isset($_POST["rName"])
) {
    $statement = $conn->prepare("UPDATE tester1.Region SET

                                                rName= :rName,
                                                rID = :rID

                                                WHERE rID = :rID;");


    $statement->bindParam(':rID', $_POST["rID"]);
    $statement->bindParam(':rName', $_POST["rName"]);

    if ($statement->execute()) {
        header("Location: .");
    } else {
        header("Location: ./edit.php?rID=".$_POST["rID"]);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Region</title>
</head>

<body>
    <h1>Edit Region</h1>

    <form action="./edit.php" method="post">

        <label for="rID">Region ID</label><br>
        <input type='hidden' name="rID" id="rID" value="<?= $country["rID"] ?>"> <br>
        <label for="rName">Region Name</label><br>
        <input type='text' name="rName" id="rName" value="<?= $country["rName"] ?>"> <br>

        <button type="submit">Edit</button>
    </form>
</body>

</html>
