<?php require_once '../database.php';

if (
    isset($_POST["orgName"]) && isset($_POST["orgType"]) && isset($_POST["cID"])
) {
    $organization = $conn->prepare("INSERT INTO tester1.Organization (orgName,orgType,cID) VALUES (:orgName,:orgType,:cID);");

    $organization->bindParam(':orgName', $_POST["orgName"]);
    $organization->bindParam(':orgType', $_POST["orgType"]);
    $organization->bindParam(':cID', $_POST["cID"]);

    if ($organization->execute()) {
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
    <title>createOrganization</title>
</head>

<body>
    <form action="./create.php" method="post">
        <label for="orgName">Organization Name</label><br>
        <input type='text' name="orgName" id="orgName"> <br>
        <label for="orgType">Organization Type</label><br>
        <input type='text' name="orgType" id="orgType"> <br>
        <label for="cID">cID</label><br>
        <input type='number' name="cID" id="cID"> <br>

        <button type="submit">Add</button>
    </form>
</body>

</html>