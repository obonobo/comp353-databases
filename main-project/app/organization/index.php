<?php require_once '../database.php';

$statement = $conn->prepare('SELECT * FROM tester1.Organization AS organization');
$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organization</title>
</head>

<body>
    <h1>List of Organizations</h1>
    <a href="./create.php">Add new organization</a>
    <table>
        <thead>
            <tr>
                <td>oID</td>
                <td>orgName</td>
                <td>orgType</td>
                <td>cID</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["oID"] ?></td>
                    <td><?= $row["orgName"] ?></td>
                    <td><?= $row["orgType"] ?></td>
                    <td><?= $row["cID"] ?></td>
                    <td>
                        <a href="./delete.php?oID=<?= $row["oID"] ?>">Delete</a>
                        <a href="./edit.php?oID=<?= $row["oID"] ?>">Edit</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="../">Back to homepage</a>
</body>

<