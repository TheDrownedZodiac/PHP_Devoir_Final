<?php
require("./inc/db.php");
$sqlArticle = "SELECT * FROM `article`;";
$sqlUser = "SELECT * FROM `user`;";
$requestArticle = $pdo->query($sqlArticle);
$requestUser = $pdo->query($sqlUser);
$articles = $requestArticle->fetchAll(PDO::FETCH_ASSOC);
$users = $requestUser->fetchAll(PDO::FETCH_ASSOC);
function AuthorToUser($idAuthor, $idUsers)
{
    foreach ($idUsers as $user) {
        if ($user["id"] == $idAuthor) {
            return $user["firstname"] . " " . $user["lastname"];
        }
    }
    return "Inconnue";
}
?>
<section>
    <h1>Latest news</h1>
    <?php foreach ($articles as $get) { ?>
        <article>
            <?php if ($get["category"] == "news") : ?>
                <h3 class="news">news</h3>
            <?php elseif ($get["category"] == "work") : ?>
                <h3 class="work">work</h3>
            <?php elseif ($get["category"] == "team") : ?>
                <h3 class="team">team</h3>
            <?php endif; ?>
            <h2><?php echo $get["title"] ?></h2>
            <div class="info">
                <img src="images/icon-john.png" alt="">
                <h4><strong><?php echo AuthorToUser($get["author"], $users) ?></strong><br><?php echo $get["date"] ?></h4>
            </div>
            <p><?php echo $get["content"] ?>
            </p>
            <a href="./single_article.php?id=<?php echo $get["id"] ?>">Continue reading</a>
        </article>
    <?php } ?>
</section>