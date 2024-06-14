<?php
require_once 'connection.php';

if (isset($_POST["submit"]) && $_POST["submit"] === "Publiceer") {
    $titel = $_POST['titel'];
    $img_url = $_POST['img_url'];
    $inhoud = $_POST['inhoud'];
    $auteur_id = $_POST['auteur_id'];

    try {
        $sql = "INSERT INTO posts (titel, img_url, inhoud, auteur_id) VALUES (:titel, :img_url, :inhoud, :auteur_id)";
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':titel', $titel);
        $stmt->bindParam(':img_url', $img_url);
        $stmt->bindParam(':inhoud', $inhoud);
        $stmt->bindParam(':auteur_id', $auteur_id);
        
        $stmt->execute();

        $post_id = $conn->lastInsertId();

        $tags = array_map('trim', explode(',', $_POST["tags"]));
        foreach ($tags as $tag) {
            $sql = 'INSERT INTO tags (titel) VALUES (:titel) ON DUPLICATE KEY UPDATE id=LAST_INSERT_ID(id)';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':titel', $tag);
            $stmt->execute();

            $tag_id = $conn->lastInsertId();

            $sql = 'INSERT INTO posts_tags (post_id, tag_id) VALUES (:post_id, :tag_id)';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':post_id', $post_id);
            $stmt->bindParam(':tag_id', $tag_id);
            $stmt->execute();
        }

        header("Location: index.php");
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Nieuwe post</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div id="header">
            <h1>Nieuwe post</h1>
            <p><a href="index.php">Alle posts</a></p>
        </div>

        <form action="new_post.php" method="post">
            <label for="titel">Titel:</label>
            <input type="text" name="titel" id="titel" required>

            <label for="img_url">URL afbeelding:</label>
            <input type="text" name="img_url" id="img_url" required>

            <label for="inhoud">Inhoud:</label>
            <textarea name="inhoud" id="inhoud" rows="10" cols="100" required></textarea>

            <label for="tags">Tags (door komma gescheiden):</label>
            <input type="text" name="tags" id="tags" required>

            <label for="auteur_id">Auteur:</label>
            <select name="auteur_id" id="auteur_id" required>
                <option value="1">Mounir Toub</option>
                <option value="2">Miljuschka</option>
                <option value="3">Wim Ballieu</option>
            </select>

            <input type="submit" name="submit" value="Publiceer">
        </form>
    </div>
</body>
</html>
