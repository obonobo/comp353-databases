<?php require_once '../database.php';

$statement = $conn->prepare(<<<SQL
SELECT Emails.timestamp, Users.email, Emails.subject
FROM Emails
    JOIN specialUser ON Emails.username = specialUser.username
    JOIN Users ON Users.uID = specialUser.uID
WHERE EXTRACT(YEAR FROM Emails.timestamp) = 2022
ORDER BY Emails.timestamp ASC;
SQL);

$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q18</title>
</head>

<body>
    <h1>Q18</h1>
    <table>
        <caption>
            List all the emails that have been sent by the system to the
            registered users to receive new publications during a specific
            period of time
        </caption>
        <thead>
            <th>timestamp</th>
            <th>email</th>
            <th>subject</th>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["timestamp"] ?>
                    <td><?= $row["email"] ?>
                    <td><?= $row["subject"] ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="../">Back to homepage</a>
</body>

</html>