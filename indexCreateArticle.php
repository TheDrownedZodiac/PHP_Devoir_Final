<?php
require("./templates/header.php");
if (!isset($_SESSION["user"])) {
    header("Location: index.php");
}
?>
<link rel="stylesheet" href="./css/style_createArticle.css">
<?php
require("./templates/createArticle.php");
require("./templates/footer.php");
?>