<?php require_once '../database.php';

$statement = $conn->prepare('SELECT rName,cName,COUNT(authName) AS totAuthors,COUNT(artTitle) AS numOfPublications FROM Region,Country,Article, Users, proStaTer
WHERE Country.rID = Region.rID AND Article.uID = Users.uID AND Users.pstID = proStaTer.pstID and proStaTer.cID = Country.cID
GROUP BY cName,rName
ORDER BY rName ASC, numOfPublications DESC;');

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
    <h1>Q16</h1>

    <table>
        <thead>
            <tr>
                <td>rName</td>
                <td>cName</td>
                <td>totAuthors</td>
                <td>numOfPublications</td>

            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["rName"] ?></td>
                    <td><?= $row["cName"] ?></td>
                    <td><?= $row["totAuthors"] ?></td>
                    <td><?= $row["numOfPublications"] ?></td>

                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="../">Back to homepage</a>
</body>

</html>
