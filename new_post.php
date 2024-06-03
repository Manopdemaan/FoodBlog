<?php
require_once 'connection.php';

if (isset($_POST["submit"]) && $_POST["submit"] === "Publiceer") {
    $titel = $_POST['titel'];
    $img_url = $_POST['img_url'];
    $inhoud = $_POST['inhoud'];
    $auteur = "Anonieme auteur"; // Auteursnaam hardcoderen of uitbreiden met een input veld

    try {
        $sql = "INSERT INTO posts (titel, img_url, inhoud, auteur) VALUES (:titel, :img_url, :inhoud, :auteur)";
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':titel', $titel);
        $stmt->bindParam(':img_url', $img_url);
        $stmt->bindParam(':inhoud', $inhoud);
        $stmt->bindParam(':auteur', $auteur);
        
        $stmt->execute();

        // Redirect to index.php to follow the PRG pattern
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
                
                <input type="submit" name="submit" value="Publiceer">
            </form>

        </div>
    </body>
</html>
