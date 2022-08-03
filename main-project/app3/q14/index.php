<?php
require_once '../database.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q14</title>
</head>

<body>
    <h1>Q14</h1>

    <form action="." method="post">
        <label for="author">Author:</label>
        <br>
        <input type='text' name="author" id="author">
        <br>
        <button type="submit">Run Query</button>
    </form>
    <br>
    <br>

    <?php
    if (isset($_POST["author"])) {
        $articles = $conn->prepare(<<<SQL
        SELECT
            pubDate,
            majTopic,
            minTopic,
            summary,
            artTitle
        FROM Article
        WHERE Article.authName = :author
        ORDER BY pubDate;
        SQL);

        $articles->bindParam(':author', $_POST["author"]);
        if ($articles->execute()) {
            ?>
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
                    <?php
                        while ($row = $articles->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
                    ?>
                            <tr>
                            <td><?= $row["pubDate"] ?>
                            <td><?= $row["majTopic"] ?>
                            <td><?= $row["minTopic"] ?>
                            <td><?= $row["summary"] ?>
                            <td><?= $row["artTitle"] ?>
                            </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <?php
        }
    }
    ?>

    <a href="../">Back to homepage</a>
</body>
</html>
