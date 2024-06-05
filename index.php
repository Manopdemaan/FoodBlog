<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Foodblog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div id="header">
            <h1>Foodblog</h1>
            <p><a href="new_post.php">Nieuwe post</a></p>
        </div>

        <?php
        require_once 'connection.php';
        try {
            if (isset($_POST['like'])) {
                $postId = $_POST['like'];
                $updateQuery = "UPDATE posts SET likes = likes + 1 WHERE id = :postId";
                $stmt = $conn->prepare($updateQuery);
                $stmt->bindParam(':postId', $postId);
                $stmt->execute();
            }

            $popularChefsQuery = "
                SELECT a.name, SUM(p.likes) AS totaal_likes
                FROM authors a
                JOIN posts p ON a.id = p.auteur_id
                GROUP BY a.name
                HAVING totaal_likes > 10";
            $stmt = $conn->query($popularChefsQuery);
            $popularChefs = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo "<div id='popular-chefs'><h3>Populaire chefs</h3><ul>";
            foreach ($popularChefs as $chef) {
                echo "<li>" . htmlspecialchars($chef['name']) . "</li>";
            }
            echo "</ul></div>";

            $query = "
                SELECT p.*, a.name AS author_name
                FROM posts p
                JOIN authors a ON p.auteur_id = a.id
                ORDER BY p.likes DESC";
            $stmt = $conn->query($query);

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='post'>";
                echo "<div class='header'>";
                echo "<h2>" . htmlspecialchars($row['titel']) . "</h2>";
                echo "<img src='" . htmlspecialchars($row['img_url']) . "' alt='" . htmlspecialchars($row['titel']) . "'>";
                echo "</div>";
                echo "<span class='details'>Geschreven op: " . htmlspecialchars($row['datum']) . " door " . htmlspecialchars($row['author_name']) . "</span>";
                echo "<p>" . nl2br(htmlspecialchars($row['inhoud'])) . "</p>";
                echo "<form action='index.php' method='post'>";
                echo "<button type='submit' name='like' value='" . $row['id'] . "'>" . $row['likes'] . " likes</button>";
                echo "</form>";
                echo "</div>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>
    </div>
</body>
</html>
