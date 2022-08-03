<?php require_once '../database.php';

$statement = $conn->prepare("SELECT * FROM tester1.proStaTerRecords AS proStaTerRecords WHERE proStaTerRecords.pstID = :pstID");
$statement->bindParam(":pstID", $_GET["pstID"]);
$statement->execute();
$prostatterrecords = $statement->fetch(PDO::FETCH_ASSOC);

if (
    isset($_POST["timestamp"])
    && isset($_POST["infectedNoVaccine"])
    && isset($_POST["totDeaths"])
    && isset($_POST["totPopulation"])
) {
    $statement = $conn->prepare("UPDATE tester1.proStaTerRecords SET
                                                timestamp = :timestamp,
                                                infectedNoVaccine= :infectedNoVaccine,
                                                totDeaths = :totDeaths,
                                                totPopulation = :totPopulation,
                                                pstID = :pstID

                                                WHERE pstID = :pstID;");


    $statement->bindParam(':timestamp', $_POST["timestamp"]);
    $statement->bindParam(':infectedNoVaccine', $_POST["infectedNoVaccine"]);
    $statement->bindParam(':totDeaths', $_POST["totDeaths"]);
    $statement->bindParam(':totPopulation', $_POST["totPopulation"]);
    $statement->bindParam(':pstID', $_POST["pstID"]);

    if ($statement->execute()) {
        header("Location: .");
    } else {
        header("Location: ./edit.php?pstID=" . $_POST["pstID"]);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit proStaTerRecords</title>
</head>

<body>
    <h1>Edit proStaTerRecords</h1>
    <form action="./edit.php" method="post">
    <label for="timestamp">timestamp</label><br>
        <input type='datetime' name="timestamp" id="timestamp" value="<?= $prostatterrecords["timestamp"] ?>"> <br>
        <label for="infectedNoVaccine">InfectedNoVaccine</label><br>
        <input type='number' name="infectedNoVaccine" id="infectedNoVaccine" value="<?= $prostatterrecords["infectedNoVaccine"] ?>"> <br>
        <label for="totDeaths">TotalDeaths</label><br>
        <input type='number' name="totDeaths" id="totDeaths" value="<?= $prostatterrecords["totDeaths"] ?>"> <br>
        <label for="totPopulation">TotalPopulation</totPopulation><br>
        <input type='number' name="totPopulation" id="totPopulation" value="<?= $prostatterrecords["totPopulation"] ?>"> <br>
        <label for="pstID">pstID</label><br>
        <input type='hidden' name="pstID" id="pstID" value="<?= $prostatterrecords["pstID"] ?>"> <br>

        <button type="submit">Edit</button>
    </form>
</body>

</html>
