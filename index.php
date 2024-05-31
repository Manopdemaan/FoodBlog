
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

                $query = "SELECT * FROM posts";
                $stmt = $conn->query($query);

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<div class='post'>";
                    echo "<div class='header'>";
                    echo "<h2>" . htmlspecialchars($row['titel']) . "</h2>";
                    echo "<img src='" . htmlspecialchars($row['img_url']) . "' alt='" . htmlspecialchars($row['titel']) . "'>";
                    echo "</div>";
                    echo "<span class='details'>Geschreven op: " . htmlspecialchars($row['datum']) . " door <b>" . htmlspecialchars($row['auteur']) . "</b></span>";
                    echo "<p>" . nl2br(htmlspecialchars($row['inhoud'])) . "</p>";
                    echo "</div>";
                }
           } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
          ?>
        </div>
    </body>
</html>
