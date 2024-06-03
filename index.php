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
            if(isset($_POST['like'])) {
                $postId = $_POST['like'];
                $updateQuery = "UPDATE posts SET likes = likes + 1 WHERE id = :postId";
                $stmt = $conn->prepare($updateQuery);
                $stmt->bindParam(':postId', $postId);
                $stmt->execute();
            }

            $query = "SELECT * FROM posts ORDER BY likes DESC";
            $stmt = $conn->query($query);

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='post'>";
                echo "<div class='header'>";
                echo "<h2>" . htmlspecialchars($row['titel']) . "</h2>";
                echo "<img src='" . htmlspecialchars($row['img_url']) . "' alt='" . htmlspecialchars($row['titel']) . "'>";
                echo "</div>";
                echo "<span class='details'>Geschreven op: " . htmlspecialchars($row['datum']) . "</span>";
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
