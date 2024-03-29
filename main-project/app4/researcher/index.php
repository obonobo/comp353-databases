<?php require_once '../database.php';

$statement = $conn->prepare('SELECT * FROM tester1.Researcher, tester1.specialUser, tester1.Users WHERE Researcher.uID = specialUser.uID AND specialUser.uID = Users.uID');
$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Researcher</title>
</head>

<body>
    <h1>List of Researchers</h1>
    <a href="./create.php">Add new Researchesr</a>
    <table>
        <thead>
            <tr>
                <td>researcherID</td>
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
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["researcherID"] ?></td>
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
                    <td>
                        <a href="./delete.php?researcherID=<?= $row["researcherID"] ?>">Delete</a>
                        <a href="./edit.php?researcherID=<?= $row["researcherID"] ?>">Edit</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="../"> Back to homepage </a>
</body>
