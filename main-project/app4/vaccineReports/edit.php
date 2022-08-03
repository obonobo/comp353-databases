<?php require_once '../database.php';

$statement = $conn->prepare("SELECT * FROM tester1.VaccineRecords AS VaccineRecords WHERE VaccineRecords.compID = :compID");
$statement->bindParam(":compID", $_GET["compID"]);
$statement->execute();
$vaccinerecords = $statement->fetch(PDO::FETCH_ASSOC);

if (
    isset($_POST["timestamps"])
    && isset($_POST["vacButInfected"])
    && isset($_POST["vacButDied"])
    && isset($_POST["vacTotal"])
) {
    $statement = $conn->prepare("UPDATE tester1.VaccineRecords SET
                                                timestamps = :timestamps,
                                                vacButInfected= :vacButInfected,
                                                vacButDied = :vacButDied,
                                                vacTotal = :vacTotal,
                                                compID = :compID

                                                WHERE compID = :compID;");


    $statement->bindParam(':timestamps', $_POST["timestamps"]);
    $statement->bindParam(':vacButInfected', $_POST["vacButInfected"]);
    $statement->bindParam(':vacButDied', $_POST["vacButDied"]);
    $statement->bindParam(':vacTotal', $_POST["vacTotal"]);
    $statement->bindParam(':compID', $_POST["compID"]);

    if ($statement->execute()) {
        header("Location: .");
    } else {
        header("Location: ./edit.php?compID=" . $_POST["compID"]);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit VaccineRecords</title>
</head>

<body>
    <h1>Edit VaccineRecords</h1>
    <form action="./edit.php" method="post">
    <label for="timestamps">Timestamp</label><br>
        <input type='datetime' name="timestamps" id="timestamps" value="<?= $vaccinerecords["timestamps"] ?>"> <br>
        <label for="vacButInfected">VaccinatedButInfected</label><br>
        <input type='number' name="vacButInfected" id="vacButInfected" value="<?= $vaccinerecords["vacButInfected"] ?>"> <br>
        <label for="vacButDied">VaccinatedButDied</label><br>
        <input type='number' name="vacButDied" id="vacButDied" value="<?= $vaccinerecords["vacButDied"] ?>"> <br>
        <label for="vacTotal">TotalVaccinated</totPopulation><br>
        <input type='number' name="vacTotal" id="vacTotal"  value="<?= $vaccinerecords["vacTotal"] ?>"> <br>
        <label for="compID">compID</label><br>
        <input type='hidden' name="compID" id="compID" value="<?= $vaccinerecords["compID"] ?>"> <br>

        <button type="submit">Edit</button>
    </form>
</body>

</html>
