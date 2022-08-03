<?php require_once '../database.php';

$statement = $conn->prepare('SELECT * FROM tester1.Article AS article');
$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
</head>

<body>
    <h1>List of articles</h1>
    <a href="./create.php">Add new article</a>
    <table>
        <thead>
            <tr>
                <td>aID</td>
                <td>authName</td>
                <td>artTitle</td>
                <td>majTopic</td>
                <td>minTopic</td>
                <td>pubDate</td>
                <td>summary</td>
                <td>uID</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["aID"] ?></td>
                    <td><?= $row["authName"] ?></td>
                    <td><?= $row["artTitle"] ?></td>
                    <td><?= $row["majTopic"] ?></td>
                    <td><?= $row["minTopic"] ?></td>
                    <td><?= $row["pubDate"] ?></td>
                    <td><?= $row["summary"] ?></td>
                    <td><?= $row["uID"] ?></td>
                    <td>
                        <a href="./delete.php?aID=<?= $row["aID"] ?>">Delete</a>
                        <a href="./edit.php?aID=<?= $row["aID"] ?>">Edit</a>
                        <a href="./show.php?authName=<?= $row["authName"] ?>">Show</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="../">Back to homepage</a>
</body>

</html>
