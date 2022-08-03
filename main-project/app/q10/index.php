<?php require_once '../database.php';

$statement = $conn->prepare(<<<SQL
SELECT uType AS role,
    IFNULL(username, 'NONE') AS username,
    fName AS firstName,
    lName AS lastName,
    cName AS citizenship,
    email,
    phoneNum
FROM Users u,
    (
        SELECT u.uID, username
        FROM Users u
        LEFT JOIN specialUser su ON u.uID = su.uID
    ) AS allUsers,
    proStaTer pst,
    Country c
WHERE u.uID = allUsers.uID
    AND u.pstID = pst.pstID
    AND pst.cID = c .cID
ORDER BY role, citizenship ASC;
SQL);

$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q10</title>
</head>

<body>
    <h1>Q10</h1>
    <table>
        <caption>Details of all users in the system</caption>
        <thead>
            <th>role</th>
            <th>username</th>
            <th>firstName</th>
            <th>lastName</th>
            <th>citizenship</th>
            <th>email</th>
            <th>phoneNum</th>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["role"] ?></td>
                    <td><?= $row["username"] ?></td>
                    <td><?= $row["firstName"] ?></td>
                    <td><?= $row["lastName"] ?></td>
                    <td><?= $row["citizenship"] ?></td>
                    <td><?= $row["email"] ?></td>
                    <td><?= $row["phoneNum"] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="../">Back to homepage</a>
</body>

</html>