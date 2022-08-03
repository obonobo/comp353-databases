<?php
require_once '../database.php';
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

    <form action="." method="post">
        <label for="from">From:</label>
        <br>
        <input type='date' name="from" id="from">
        <br>
        <label for="to">To:</label>
        <br>
        <input type='date' name="to" id="to">
        <br>
        <button type="submit">Run Query</button>
    </form>
    <br>
    <br>

    <?php
    if (isset($_POST["from"])) {
        $emails = $conn->prepare(<<<SQL
        SELECT Emails.timestamp, Users.email, Emails.subject
        FROM Emails
            JOIN specialUser ON Emails.username = specialUser.username
            JOIN Users ON Users.uID = specialUser.uID
        WHERE Emails.timestamp >= :from AND Emails.timestamp <= :to
        ORDER BY Emails.timestamp ASC;
        SQL);

        $emails->bindParam(':from', $_POST["from"]);
        $emails->bindParam(':to', $_POST["to"]);

        if ($emails->execute()) {
            ?>
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
                    <?php while ($row = $emails->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                        <tr>
                            <td><?= $row["timestamp"] ?>
                            <td><?= $row["email"] ?>
                            <td><?= $row["subject"] ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php
        }
    }
    ?>

    <a href="../">Back to homepage</a>
</body>
</html>
