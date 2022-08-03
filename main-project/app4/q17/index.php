<?php require_once '../database.php';

$statement = $conn->prepare(<<<SQL
WITH
    cte1 AS (
        SELECT pstName,
            proStaTer.pstID,
            SUM(vacTotal) AS totalVaccinated,
            SUM(vacButDied) AS totalVaccinatedbutDied
        FROM VaccineCompany, proStaTer, VaccineRecords
        WHERE proStaTer.pstID = VaccineCompany.pstID
        AND VaccineRecords.compID = VaccineCompany.compID
        GROUP BY proStaTer.pstName, proStaTer.pstID
    ),
    cte2 AS (
        SELECT cName,
            SUM(totPopulation) AS popSum,
            SUM(totDeaths) AS deathSum
        FROM proStaTer, Country, proStaTerRecords
        WHERE Country.cID = proStaTer.cID
        AND proStaTer.pstID = proStaTerRecords.pstID
        GROUP BY proStaTer.cID
    )
SELECT rName,
    Country.cName,
    cte2.popSum,
    cte2.deathSum,
    SUM(cte1.totalVaccinated) AS totalVaccinatedCountry,
    SUM(cte1.totalVaccinatedbutDied) AS totalVaccinatedbutDiedCountry
FROM Region
    JOIN Country
    JOIN proStaTer
    JOIN cte1
    JOIN cte2
WHERE Region.rID = Country.rID
    AND Country.cName = cte2.cName
    AND proStaTer.pstID = cte1.pstID
    AND proStaTer.cID = Country.cID
GROUP BY Country.cID, cte2.popSum, cte2.deathSum
ORDER BY cte2.deathSum ASC;
SQL);

$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q17</title>
</head>

<body>
    <h1>Q17</h1>
    <table>
        <caption>Details of the progress of the COVID-19 for all the countries in the system</caption>
        <thead>
            <th>rName</th>
            <th>cName</th>
            <th>popSum</th>
            <th>deathSum</th>
            <th>totalVaccinatedCountry</th>
            <th>totalVaccinatedbutDiedCountry</th>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["rName"] ?>
                    <td><?= $row["cName"] ?>
                    <td><?= $row["popSum"] ?>
                    <td><?= $row["deathSum"] ?>
                    <td><?= $row["totalVaccinatedCountry"] ?>
                    <td><?= $row["totalVaccinatedbutDiedCountry"] ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="../">Back to homepage</a>
</body>

</html>
