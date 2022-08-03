<?php require_once '../database.php';

$statement = $conn->prepare(<<<SQL
SELECT rName,
    cName,
    COUNT(authName) AS totAuthors,
    COUNT(artTitle) AS numOfPublications
FROM Region,
    Country,
    Article,
    Users,
    proStaTer
WHERE Country.rID = Region.rID
    AND Article.uID = Users.uID
    AND Users.pstID = proStaTer.pstID
    and proStaTer.cID = Country.cID
GROUP BY cName, rName
ORDER BY rName ASC, numOfPublications DESC;
SQL);

$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q16</title>
</head>

<body>
    <h1>Q16</h1>
    <table>
        <caption>Details of the authors and publications in the system</caption>
        <thead>
            <th>rName</th>
            <th>cName</th>
            <th>totAuthors</th>
            <th>numOfPublications</th>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["rName"] ?>
                    <td><?= $row["cName"] ?>
                    <td><?= $row["totAuthors"] ?>
                    <td><?= $row["numOfPublications"] ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="../">Back to homepage</a>
</body>

</html>