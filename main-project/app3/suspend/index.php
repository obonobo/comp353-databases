<?php require_once '../database.php';

$statement = $conn->prepare('SELECT * FROM tester1.Suspension AS Suspension');

$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suspension</title>
</head>

<body>
    <h1>Suspended</h1>

    <a href="./create.php">Add new Suspended</a>

    <table>
        <thead>
            <tr>
                <td>userID</td>
                <td>suspendDate</td>
                <td>Actions</td>


            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["uID"] ?></td>
                    <td><?= $row["suspendDate"] ?></td>
                    <td><a href="./delete.php?uID=<?= $row["uID"] ?>">Delete</a></td>

                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="../">Back to homepage</a>
</body>

</html>
