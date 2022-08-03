<?php require_once '../database.php';

$statement = $conn->prepare("SELECT * FROM tester1.Organization AS Organization WHERE Organization.oID = :oID");
$statement->bindParam(":oID", $_GET["oID"]);
$statement->execute();
$organization = $statement->fetch(PDO::FETCH_ASSOC);

if (
    isset($_POST["orgName"])
    && isset($_POST["orgType"])
    && isset($_POST["cID"])
    && isset($_POST["oID"])
) {
    $statement = $conn->prepare("UPDATE tester1.Organization SET 
                                                orgName = :orgName,
                                                orgType= :orgType,
                                                cID = :cID, 
                                                oID = :oID
                                                
                                                WHERE oID = :oID;");


    $statement->bindParam(':orgName', $_POST["orgName"]);
    $statement->bindParam(':orgType', $_POST["orgType"]);
    $statement->bindParam(':cID', $_POST["cID"]);
    $statement->bindParam(':oID', $_POST["oID"]);

    if ($statement->execute()) {
        header("Location: .");
    } else {
        header("Location: ./edit.php?aID=" . $_POST["oID"]);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Organization</title>
</head>

<body>
    <h1>Edit Organization</h1>
    <form action="./edit.php" method="post">
        <label for="orgName">Organization Name</label><br>
        <input type='text' name="orgName" id="orgName" value="<?= $organization["orgName"] ?>"> <br>
        <label for="orgType">Organization Type</label><br>
        <input type='text' name="orgType" id="orgType" value="<?= $organization["orgType"] ?>"> <br>
        <label for="cID">cID</label><br>
        <input type='number' name="cID" id="cID" value="<?= $organization["cID"] ?>"> <br>
        <label for="oID">oID</label><br>
        <input type='hidden' name="oID" id="oID" value="<?= $organization["oID"] ?>"> <br>

        <button type="submit">Edit</button>
    </form>
</body>

</html>