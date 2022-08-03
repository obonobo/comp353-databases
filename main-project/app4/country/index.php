<?php require_once '../database.php';

$statement = $conn->prepare('SELECT * FROM tester1.Country AS country');
$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Country</title>
</head>

<body>
    <h1>List of Countries</h1>
    <a href="./create.php">Add new country</a>
    <table>
        <thead>
            <tr>
                <td>cID</td>
                <td>cName</td>
                <td>rID</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["cID"] ?></td>
                    <td><?= $row["cName"] ?></td>
                    <td><?= $row["rID"] ?></td>

                    <td>
                        <a href="./delete.php?cID=<?= $row["cID"] ?>">Delete</a>
                        <a href="./edit.php?cID=<?= $row["cID"] ?>">Edit</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="../">Back to homepage</a>
</body>

</html>
