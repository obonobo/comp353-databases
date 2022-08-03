<?php require_once '../database.php';

$statement = $conn->prepare(<<<SQL
SELECT
    Authors.fullName AS author,
    Article.majTopic AS majorTopic,
    Article.minTopic AS minorTopic,
    Article.pubDate AS publicationDate,
    Authors.citizenship AS citizenship
FROM Article
    JOIN Authors ON Authors.username = Article.authName
    JOIN RemovedArticles ON RemovedArticles.aID = Article.aID
ORDER BY citizenship ASC, RemovedArticles.removalDate ASC;
SQL);

$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q12</title>
</head>

<body>
    <h1>Q12</h1>
    <table>
        <caption>A briefing of all removed articles in the system</caption>
        <thead>
            <th>author</th>
            <th>majorTopic</th>
            <th>minorTopic</th>
            <th>publicationDate</th>
            <th>citizenship</th>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["author"] ?>
                    <td><?= $row["majorTopic"] ?>
                    <td><?= $row["minorTopic"] ?>
                    <td><?= $row["publicationDate"] ?>
                    <td><?= $row["citizenship"] ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="../">Back to homepage</a>
</body>

</html>