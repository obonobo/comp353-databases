<?php require_once '../database.php';

$statement = $conn->prepare('SELECT * FROM tester1.Region AS region');
$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regions</title>
</head>

<body>
    <h1>List of Regions</h1>
    <a href="./create.php">Add new region</a>
    <table>
        <thead>
            <tr>
                <td>rID</td>
                <td>rName</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["rID"] ?></td>
                    <td><?= $row["rName"] ?></td>
                    <td>
                        <a href="./delete.php?rID=<?= $row["rID"] ?>">Delete</a>
                        <a href="./edit.php?rID=<?= $row["rID"] ?>">Edit</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="../">Back to homepage</a>
</body>

</html>
