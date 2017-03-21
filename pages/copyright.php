<?php
require "../includes/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Copy Right</title>
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
                    <div class="block">
                        <h3>Правообладателям</h3>
                        <div class="block__content">
                            <div class="full-text">
                                <h1> Текст о копирайте</h1>

                            </div>
                        </div>
                    </div>

                </section>
                <section class="content__right col-md-4">
                    <?php include "../includes/sidebar.php"; ?>
                </section>
            </div>
        </div>
    </div>

    <? include "../includes/footer.php";?>

</div>

</body>
</html>