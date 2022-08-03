<?php require_once '../database.php';

if (
     isset($_POST["infectedNoVaccine"]) && isset($_POST["totDeaths"])&& isset($_POST["totPopulation"]) && isset($_POST["pstID"])
) {
    $prostatterrecords = $conn->prepare("INSERT INTO tester1.proStaTerRecords (pstID, infectedNoVaccine,totDeaths,totPopulation) VALUES (:pstID, :infectedNoVaccine,:totDeaths,:totPopulation);");

    $prostatterrecords->bindParam(':pstID', $_POST["pstID"]);
    $prostatterrecords->bindParam(':infectedNoVaccine', $_POST["infectedNoVaccine"]);
    $prostatterrecords->bindParam(':totDeaths', $_POST["totDeaths"]);
    $prostatterrecords->bindParam(':totPopulation', $_POST["totPopulation"]);

    if ($prostatterrecords->execute()) {
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
    <title>createProStatTerRecords</title>
</head>

<body>
    <form action="./create.php" method="post">
        <label for="pstID">pstID</label><br>
        <input type='number' name="pstID" id="pstID"> <br>
        <label for="timestamp">Timestamp</label><br>
        <input type='hidden' name="timestamp" id="timestamp"> <br>
        <label for="infectedNoVaccine">InfectedNoVaccine</label><br>
        <input type='number' name="infectedNoVaccine" id="infectedNoVaccine"> <br>
        <label for="totDeaths">TotalDeaths</label><br>
        <input type='number' name="totDeaths" id="totDeaths"> <br>
        <label for="totPopulation">TotalPopulation</label><br>
        <input type='number' name="totPopulation" id="totPopulation"> <br>

        <button type="submit">Add</button>
    </form>
</body>

</html>
