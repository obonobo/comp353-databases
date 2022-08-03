<?php require_once '../database.php';

$statement = $conn->prepare(<<<SQL
SELECT
    CONCAT(Users.fName, ' ', Users.lName) AS author,
    Country.cName AS citizenship,
    COUNT(EmailRegistration.username) AS subscriberCount
FROM EmailRegistration
    JOIN specialUser ON specialUser.username = EmailRegistration.author
    JOIN Users ON Users.uID = specialUser.uID
    JOIN proStaTer ON proStaTer.pstID = Users.pstID
    JOIN Country ON Country.cID = proStaTer.cID
GROUP BY EmailRegistration.author
ORDER BY subscriberCount DESC
LIMIT 10;
SQL);

$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q20</title>
</head>

<body>
    <h1>Q20</h1>
    <table>
        <caption>
        Details of the authors that have the highest number of registered users
        to receive notifications for their new publishing of articles by the
        author
        </caption>
        <thead>
            <th>author</th>
            <th>citizenship</th>
            <th>subscriberCount</th>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["author"] ?>
                    <td><?= $row["citizenship"] ?>
                    <td><?= $row["subscriberCount"] ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="../">Back to homepage</a>
</body>

</html>