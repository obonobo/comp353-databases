<?php require_once '../database.php';

if (
    isset($_POST["cID"]) && isset($_POST["pstName"])
) {
    $proStaTer = $conn->prepare("INSERT INTO tester1.proStaTer (cID,pstName) VALUES (:cID,:pstName);");

    $proStaTer->bindParam(':cID', $_POST["cID"]);
    $proStaTer->bindParam(':pstName', $_POST["pstName"]);

    if ($proStaTer->execute()) {
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
    <title>create proStaTer</title>
</head>

<body>
    <form action="./create.php" method="post">

        <label for="cID">Country ID</label><br>
        <input type='text' name="cID" id="cID"> <br>

        <label for="pstName">ProStaTer Name</label><br>
        <input type='text' name="pstName" id="pstName"> <br>

        <button type="submit">Add</button>
    </form>
</body>

</html>
