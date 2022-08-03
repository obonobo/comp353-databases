<?php require_once '../database.php';

$statement = $conn->prepare('SELECT * FROM tester1.proStaTer AS proStaTer');
$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProStaTer</title>
</head>

<body>
    <h1>List of Regions</h1>
    <a href="./create.php">Add new proStaTer</a>
    <table>
        <thead>
            <tr>
                <td>pstID</td>
                <td>cID</td>
                <td>pstName</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["pstID"] ?></td>
                    <td><?= $row["cID"] ?></td>
                    <td><?= $row["pstName"] ?></td>

                    <td>
                        <a href="./delete.php?pstID=<?= $row["pstID"] ?>">Delete</a>
                        <a href="./edit.php?pstID=<?= $row["pstID"] ?>">Edit</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="../">Back to homepage</a>
</body>

</html>
