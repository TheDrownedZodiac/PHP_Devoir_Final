<?php
require("./inc/db.php");
?>
<article>
    <form method="get">
        <label for="title">Titre</label>
        <input type="text" id="title" name="title" required>
        <label for="content">Contenu</label>
        <textarea cols="30" rows="10" id="content" name="content" required></textarea>
        <label for="category">Contenu</label>
        <select id="category" name="category" required>
            <option value="" disabled selected>Choisir la catégorie</option>
            <option value="news">News</option>
            <option value="team">Team</option>
            <option value="work">Work</option>
        </select>
        <button type="submit">Publier</button>
    </form>
    <?php
    // var_dump($_GET);
    $erreur = [];
    $message = [];
    // test article
    if (isset($_GET['title']) && isset($_GET['content']) && isset($_GET['category'])) {
        array_push($message, 'ok pour l\'article');
        header("Location: index.php");
    } else {
        array_push($erreur, 'L\'article n\'est pas valide');
    }

    if ($erreur == []) {
        $request = $pdo->prepare("INSERT INTO article (title, content, category, date, author) VALUES (?, ?, ?, ?, ?);");
        $request->execute([$_GET['title'], $_GET['content'], $_GET['category'], date('Y-m-d H:i:s'), $_SESSION['id']]);
    }

    ?>
    <ul>
        <?php
        foreach ($message as $value) {
            echo "<li>" . $value . "</li>";
        }
        ?>
    </ul>
    <ul>
        <?php
        foreach ($erreur as $item) {
            echo "<li>" . $item . "</li>";
        }
        ?>
    </ul>
</article>