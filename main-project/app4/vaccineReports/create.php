<?php require_once '../database.php';

if (
    isset($_POST["compID"]) && isset($_POST["vacButInfected"]) && isset($_POST["vacButDied"]) && isset($_POST["vacTotal"])
) {
    $vaccinerecords = $conn->prepare("INSERT INTO tester1.VaccineRecords (compID,vacButInfected,vacButDied,vacTotal) VALUES (:compID,:vacButInfected,:vacButDied,:vacTotal);");

    $vaccinerecords->bindParam(':compID', $_POST["compID"]);
    $vaccinerecords->bindParam(':vacButInfected', $_POST["vacButInfected"]);
    $vaccinerecords->bindParam(':vacButDied', $_POST["vacButDied"]);
    $vaccinerecords->bindParam(':vacTotal', $_POST["vacTotal"]);

    if ($vaccinerecords->execute()) {
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
    <title>createVaccineRecords</title>
</head>

<body>
    <form action="./create.php" method="post">
        <label for="compID">CompID</label><br>
        <input type='number' name="compID" id="compID"> <br>
        <label for="timestamps">Timestamp</label><br>
        <input type='hidden' name="timestamps" id="timestamps"> <br>
        <label for="vacButInfected">VaccinatedButInfected</label><br>
        <input type='number' name="vacButInfected" id="vacButInfected"> <br>
        <label for="vacButDied">VaccinatedButDied</label><br>
        <input type='number' name="vacButDied" id="vacButDied"> <br>
        <label for="vacTotal">TotalVaccinated</totPopulation><br>
        <input type='number' name="vacTotal" id="vacTotal"> <br>

        <button type="submit">Add</button>
    </form>
</body>

</html>
