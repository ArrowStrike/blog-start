<?php
require "../includes/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $config['title']; ?></title>

    <?php
    require "../includes/links.php";
    ?>

</head>
<body>

<div id="wrapper">

    <?php include "../includes/header.php"; ?>

    <div id="content">
        <div class="container">
            <div class="row">
                <section class="content__left col-md-8">
                    <?php
                    if (isset($_GET['search'])) {
                        include "../includes/search.php";
                     }
                    else{
                        include "../includes/bodyAllArticles.php";
                    }
                    ?>


                </section>
                <section class="content__right col-md-4">

                    <?php include "../includes/sidebar.php"; ?>

                </section>
            </div>
        </div>
    </div>

    <? include "../includes/footer.php";
    ?>
</div>

</body>
</html>