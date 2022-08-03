<?php require_once '../database.php';

$statement = $conn->prepare('SELECT authName,pubDate,majTopic,minTopic,summary,artTitle FROM Article
WHERE Article.authName = :authName
ORDER BY pubDate;');

$statement->bindParam(':authName', $_GET["authName"]);
$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>authName</title>
</head>

<body>
    <h1>Q14</h1>

    <table>
        <thead>
            <tr>
                <td>authName</td>
                <td>pubDate</td>
                <td>majTopic</td>
                <td>minTopic</td>
                <td>summary</td>
                <td>artTitle</td>


            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["authName"] ?></td>
                    <td><?= $row["pubDate"] ?></td>
                    <td><?= $row["majTopic"] ?></td>
                    <td><?= $row["minTopic"] ?></td>
                    <td><?= $row["summary"] ?></td>
                    <td><?= $row["artTitle"] ?></td>

                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="../">Back to homepage</a>
</body>

</html>
