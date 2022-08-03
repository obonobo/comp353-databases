<?php require_once '../database.php';

if (
    isset($_POST["vacButInfected"]) && isset($_POST["vacButDied"]) && isset($_POST["vacTotal"]) && isset($_POST["timestamps"])
) {
    $vaccinerecords = $conn->prepare("INSERT INTO tester1.VaccineRecords (vacButInfected,vacButDied,vacTotal,timestamps) VALUES (:vacButInfected,:vacButDied,:vacTotal, :timestamps);");


    $vaccinerecords->bindParam(':vacButInfected', $_POST["vacButInfected"]);
    $vaccinerecords->bindParam(':vacButDied', $_POST["vacButDied"]);
    $vaccinerecords->bindParam(':vacTotal', $_POST["vacTotal"]);
    $vaccinerecords->bindParam(':timestamps', $_POST["timestamps"]);

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
        <label for="timestamps">Timestamp</label><br>
        <input type='datetime-local' name="timestamps" id="timestamps"> <br>
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
