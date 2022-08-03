<?php require_once '../database.php';

$statement = $conn->prepare("SELECT * FROM tester1.proStaTer AS proStaTer WHERE proStaTer.pstID = :pstID");
$statement->bindParam(":pstID", $_GET["pstID"]);
$statement->execute();
$proStaTer = $statement->fetch(PDO::FETCH_ASSOC);

if (
    isset($_POST["pstID"])
    && isset($_POST["cID"])
    && isset($_POST["pstName"])
) {
    $statement = $conn->prepare("UPDATE tester1.proStaTer SET

                                                cID= :cID,
                                                pstName= :pstName,
                                                pstID = :pstID

                                                WHERE pstID = :pstID;");

    $statement->bindParam(':pstID', $_POST["pstID"]);
    $statement->bindParam(':cID', $_POST["cID"]);
    $statement->bindParam(':pstName', $_POST["pstName"]);

    if ($statement->execute()) {
        header("Location: .");
    } else {
        header("Location: ./edit.php?pstID=".$_POST["pstID"]);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit proStaTer</title>
</head>

<body>
    <h1>Edit proStaTer</h1>

    <form action="./edit.php" method="post">

        <label for="pstID">ProStaTer ID</label><br>
        <input type='hidden' name="pstID" id="pstID" value="<?= $proStaTer["pstID"] ?>"> <br>
        <label for="pstName">ProStaTer Name</label><br>
        <input type='text' name="pstName" id="pstName" value="<?= $proStaTer["pstName"] ?>"> <br>

        <button type="submit">Edit</button>
    </form>
</body>

</html>
