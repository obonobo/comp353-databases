<?php require_once '../database.php';

$statement = $conn->prepare('SELECT * FROM tester1.orgDelagate, tester1.specialUser, tester1.Users WHERE orgDelagate.uID = specialUser.uID AND specialUser.uID = Users.uID' );
$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organization Delegates</title>
</head>

<body>
    <h1>List of Organization Delegates</h1>
    <a href="./create.php">Add new Organization Delegates</a>
    <table>
        <thead>
            <tr>
                <td>delagateID</td>
                <td>fName</td>
                <td>lName</td>
                <td>dateOfBirth</td>
                <td>phoneNum</td>
                <td>email</td>
                <td>uType</td>
                <td>pstID</td>
                <td>username</td>
                <td>password</td>
                <td>uID</td>
                <td>oID</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["delagateID"] ?></td>
                    <td><?= $row["fName"] ?></td>
                    <td><?= $row["lName"] ?></td>
                    <td><?= $row["dateOfBirth"] ?></td>
                    <td><?= $row["phoneNum"] ?></td>
                    <td><?= $row["email"] ?></td>
                    <td><?= $row["uType"] ?></td>
                    <td><?= $row["pstID"] ?></td>
                    <td><?= $row["username"] ?></td>
                    <td><?= $row["password"] ?></td>
                    <td><?= $row["uID"] ?></td>
                    <td><?= $row["oID"] ?></td>
                    <td>
                        <a href="./delete.php?delagateID=<?= $row["delagateID"] ?>">Delete</a>
                        <a href="./edit.php?delagateID=<?= $row["delagateID"] ?>">Edit</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="../">Back to homepage</a>
</body>

<
