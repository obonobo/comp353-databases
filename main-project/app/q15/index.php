<?php require_once '../database.php';

$statement = $conn->prepare(<<<SQL
SELECT authName,
    cName,
    COUNT(artTitle) AS numOfPublications
FROM Article,
    Users,
    proStaTer,
    Country
WHERE Article.uID = Users.uID
    AND Users.pstID = proStaTer.pstID
    AND proStaTer.cID = Country.cID
GROUP BY authName, Article.uID
ORDER BY numOfPublications DESC;
SQL);

$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
</head>

<body>
    <h1>Q15</h1>
    <table>
        <caption>Details of all the authors that have published articles in the system</caption>
        <thead>
            <th>authName</th>
            <th>cName</th>
            <th>numOfPublications</th>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["authName"] ?>
                    <td><?= $row["cName"] ?>
                    <td><?= $row["numOfPublications"] ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="../">Back to homepage</a>
</body>

</html>
