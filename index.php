<?php
require "includes/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $config['title']; ?></title>

    <?php
    require "includes/links.php";
    ?>

</head>
<body>

<div id="wrapper">

    <?php include "includes/header.php"; ?>

    <div id="content">
        <div class="container">
            <div class="row">
                <section class="content__left col-md-8">

                    <?php include "includes/bodyRecentArticles.php"; ?>

                    <div class="block">
                        <a href="pages/articles.php?category=2">Все записи</a>
                        <h3>Кулинария [Новейшее]</h3>
                        <div class="block__content">
                            <div class="articles articles__horizontal">

                                <?php
                                $articles = mysqli_query($connection, "SELECT * FROM articles WHERE category_id=2 ORDER BY id DESC LIMIT 10");
                                include "includes/bodyCategories.php"; ?>

                            </div>
                        </div>

                    </div>
                    <div class="block">
                        <a href="pages/articles.php?category=1">Все записи</a>
                        <h3>Спорт [Новейшее]</h3>
                        <div class="block__content">
                            <div class="articles articles__horizontal">

                                <?php
                                $articles = mysqli_query($connection, "SELECT * FROM articles WHERE category_id=1 ORDER BY id DESC LIMIT 10");
                                include "includes/bodyCategories.php"; ?>

                            </div>
                        </div>
                    </div>
                </section>
                <section class="content__right col-md-4">

                    <?php include "includes/sidebar.php"; ?>

                </section>
            </div>
        </div>
    </div>

    <? include "includes/footer.php";
    ?>
</div>

</body>
</html>