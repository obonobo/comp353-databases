<?php require_once '../database.php';

$statement = $conn->prepare('WITH
cte1 AS
    (SELECT specialUser.username,Suspension.uID,suspendDate FROM Suspension LEFT JOIN specialUser ON Suspension.uID = specialUser.uID)

SELECT cte1.username AS username,fName,lName,cName,email,phoneNum,cte1.suspendDate AS suspendDate
FROM cte1,Users,proStaTer,Country
WHERE Users.uID IN (SELECT uID FROM Suspension) AND Users.pstID = proStaTer.pstID AND proStaTer.cID = Country.cID AND cte1.uID = Users.uID
ORDER BY suspendDate;');

$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q13</title>
</head>

<body>
    <h1>Q13</h1>

    <table>
        <thead>
            <tr>
                <td>username</td>
                <td>fName</td>
                <td>lName</td>
                <td>cName</td>
                <td>phoneNum</td>
                <td>email</td>
                <td>suspendDate</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["username"] ?></td>
                    <td><?= $row["fName"] ?></td>
                    <td><?= $row["lName"] ?></td>
                    <td><?= $row["cName"] ?></td>
                    <td><?= $row["phoneNum"] ?></td>
                    <td><?= $row["email"] ?></td>
                    <td><?= $row["suspendDate"] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="../">Back to homepage</a>
</body>

</html>
