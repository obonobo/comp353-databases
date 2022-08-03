<!-- !!! THIS QUESTION NEEDS A FORM SUBMISSION  !!! -->
<!-- !!! THIS QUESTION NEEDS A FORM SUBMISSION  !!! -->
<!-- !!! THIS QUESTION NEEDS A FORM SUBMISSION  !!! -->
<!-- !!! THIS QUESTION NEEDS A FORM SUBMISSION  !!! -->
<!-- !!! THIS QUESTION NEEDS A FORM SUBMISSION  !!! -->
<!-- !!! THIS QUESTION NEEDS A FORM SUBMISSION  !!! -->
<!-- !!! THIS QUESTION NEEDS A FORM SUBMISSION  !!! -->
<!-- !!! THIS QUESTION NEEDS A FORM SUBMISSION  !!! -->
<!-- !!! THIS QUESTION NEEDS A FORM SUBMISSION  !!! -->
<!-- !!! THIS QUESTION NEEDS A FORM SUBMISSION  !!! -->
<!-- !!! THIS QUESTION NEEDS A FORM SUBMISSION  !!! -->
<!-- !!! THIS QUESTION NEEDS A FORM SUBMISSION  !!! -->
<!-- !!! THIS QUESTION NEEDS A FORM SUBMISSION  !!! -->
<!-- !!! THIS QUESTION NEEDS A FORM SUBMISSION  !!! -->
<!-- !!! THIS QUESTION NEEDS A FORM SUBMISSION  !!! -->
<!-- !!! THIS QUESTION NEEDS A FORM SUBMISSION  !!! -->
<!-- !!! THIS QUESTION NEEDS A FORM SUBMISSION  !!! -->
<!-- !!! THIS QUESTION NEEDS A FORM SUBMISSION  !!! -->
<!-- !!! THIS QUESTION NEEDS A FORM SUBMISSION  !!! -->

<?php require_once '../database.php';

$statement = $conn->prepare(<<<SQL
SELECT
    pubDate,
    majTopic,
    minTopic,
    summary,
    artTitle
FROM Article
WHERE Article.authName = '' #some input
ORDER BY pubDate;
SQL);

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
    <h1>Q14</h1>
    <table>
        <caption>
            For a given author, returns the details of all the articles published
            by the author
        </caption>
        <thead>
            <th>pubDate</th>
            <th>majTopic</th>
            <th>minTopic</th>
            <th>summary</th>
            <th>artTitle</th>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["pubDate"] ?>
                    <td><?= $row["majTopic"] ?>
                    <td><?= $row["minTopic"] ?>
                    <td><?= $row["summary"] ?>
                    <td><?= $row["artTitle"] ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="../">Back to homepage</a>
</body>

</html>