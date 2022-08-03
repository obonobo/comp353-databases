<?php require_once '../database.php';

$statement = $conn->prepare('SELECT authName,cName,COUNT(artTitle) AS numOfPublications FROM Article,Users,proStaTer, Country
WHERE Article.uID = Users.uID AND Users.pstID = proStaTer.pstID AND proStaTer.cID = Country.cID
GROUP BY Article.uID
ORDER BY numOfPublications DESC;');

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
        <thead>
            <tr>
                <td>authName</td>
                <td>cName</td>
                <td>numOfPublications</td>

            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["authName"] ?></td>
                    <td><?= $row["cName"] ?></td>
                    <td><?= $row["numOfPublications"] ?></td>

                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="../">Back to homepage</a>
</body>

</html>
