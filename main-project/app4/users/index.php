<?php require_once '../database.php';

$statement = $conn->prepare('SELECT * FROM tester1.Users AS Users');
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
    <h1>List of Users</h1>
    <a href="./create.php">Add new User</a>
    <table>
        <thead>
            <tr>
                <td>uID</td>
                <td>fName</td>
                <td>lName</td>
                <td>dateOfBirth</td>
                <td>phoneNum</td>
                <td>email</td>
                <td>uType</td>
                <td>pstID</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["uID"] ?></td>
                    <td><?= $row["fName"] ?></td>
                    <td><?= $row["lName"] ?></td>
                    <td><?= $row["dateOfBirth"] ?></td>
                    <td><?= $row["phoneNum"] ?></td>
                    <td><?= $row["email"] ?></td>
                    <td><?= $row["uType"] ?></td>
                    <td><?= $row["pstID"] ?></td>
                    <td>
                        <a href="./delete.php?uID=<?= $row["uID"] ?>">Delete</a>
                        <a href="./edit.php?uID=<?= $row["uID"] ?>">Edit</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="../">Back to homepage</a>
</body>

<
