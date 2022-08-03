<?php require_once '../database.php';

if (
    isset($_POST["rName"])
) {
    $region = $conn->prepare("INSERT INTO tester1.Region (rName) VALUES (:rName);");

    $region->bindParam(':rName', $_POST["rName"]);

    if ($region->execute()) {
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
    <title>createRegion</title>
</head>

<body>
    <form action="./create.php" method="post">
        <label for="rName">Region Name</label><br>
        <input type='text' name="rName" id="rName"> <br>

        <button type="submit">Add</button>
    </form>
</body>

</html>
