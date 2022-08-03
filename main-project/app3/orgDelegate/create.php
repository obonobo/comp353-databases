<?php require_once '../database.php';

if (

     isset($_POST["uID"]) &&
     isset($_POST["oID"])

) {
    $delegate = $conn->prepare("INSERT INTO tester1.orgDelagate (uID, oID) VALUES (:uID, :oID);");

    $delegate->bindParam(':uID', $_POST["uID"]);
    $delegate->bindParam(':oID', $_POST["oID"]);


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

        <label for="uID">uID</label><br>
        <input type='number' name="uID" id="uID"> <br>

        <label for="oID">oID</label><br>
        <input type='number' name="oID" id="oID"> <br>

        <button type="submit">Add</button>
    </form>
</body>

</html>
