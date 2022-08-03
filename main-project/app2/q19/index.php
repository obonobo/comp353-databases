<?php require_once '../database.php';

$statement = $conn->prepare(<<<SQL
SELECT
    DATE(VaccineRecords.timestamp) AS date,
    proStaTerRecords.totPopulation AS population,
    VaccineCompany.vaccine AS vaccine,
    SUM(vacTotal) AS totalVaccinated,
    SUM(vacButInfected) + SUM(infectedNoVaccine) AS totalInfected
FROM VaccineRecords
    JOIN VaccineCompany ON VaccineCompany.compID = VaccineRecords.compID
    JOIN proStaTer ON proStaTer.pstID = VaccineCompany.pstID
    JOIN Country ON proStaTer.cID = Country.cID
    LEFT JOIN proStaTerRecords ON (proStaTerRecords.pstID, proStaTerRecords.timestamp) = (
            -- This subquery retrieves the proStaTerRecord whose date is closest
            -- to our VaccineRecord.
            SELECT proStaTerRecords.pstID, proStaTerRecords.timestamp
            FROM proStaTerRecords
                JOIN proStaTer ON proStaTer.pstID = proStaTerRecords.pstID
                JOIN Country AS InnerCountry ON proStaTer.cID = Country.cID
            WHERE InnerCountry.cID = Country.cID
            AND DATE(timestamp) <= DATE(VaccineRecords.timestamp)
            ORDER BY timestamp DESC
            LIMIT 1
        )
WHERE LOWER(Country.cName) = 'canada'
GROUP BY date, population, vaccine
ORDER BY date DESC;
SQL);

$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q19</title>
</head>

<body>
    <h1>Q19</h1>
    <table>
        <caption>Details of the historical progress of COVID-19 in Canada</caption>
        <thead>
            <th>date</th>
            <th>population</th>
            <th>vaccine</th>
            <th>totalVaccinated</th>
            <th>totalInfected</th>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["date"] ?>
                    <td><?= $row["population"] ?>
                    <td><?= $row["vaccine"] ?>
                    <td><?= $row["totalVaccinated"] ?>
                    <td><?= $row["totalInfected"] ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="../">Back to homepage</a>
</body>

</html>