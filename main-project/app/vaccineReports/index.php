<?php require_once '../database.php';

$statement = $conn->prepare('SELECT * FROM tester1.VaccineRecords AS vaccinerecords');
$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VaccineRecords</title>
</head>

<body>
    <h1>List of VaccineRecords</h1>
    <a href="./create.php">Add new VaccineRecords</a>
    <table>
        <thead>
            <tr>
                <td>compID</td>
                <td>timestamp</td>
                <td>vacButInfected</td>
                <td>vacButDied</td>
                <td>vacTotal</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["compID"] ?></td>
                    <td><?= $row["timestamp"] ?></td>
                    <td><?= $row["vacButInfected"] ?></td>
                    <td><?= $row["vacButDied"] ?></td>
                    <td><?= $row["vacTotal"] ?></td>
                    <td>
                        <a href="./delete.php?compID=<?= $row["compID"] ?>">Delete</a>
                        <a href="./edit.php?compID=<?= $row["compID"] ?>">Edit</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="../">Back to homepage</a>
</body>

<