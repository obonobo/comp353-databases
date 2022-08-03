<?php require_once '../database.php';

$statement = $conn->prepare('SELECT * FROM tester1.RemovedArticles AS RemovedArticles');

$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>removedArticles</title>
</head>

<body>
    <h1>removed Articles</h1>

    <table>
        <thead>
            <tr>
                <td>articleID</td>
                <td>suspendDate</td>



            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["aID"] ?></td>
                    <td><?= $row["removalDate"] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="../">Back to homepage</a>
</body>

</html>