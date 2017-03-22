<?php
session_start();
require_once "articles.php";
require_once "database.php";
$link = db_connect();

if (checkUser($link, $_SESSION["email"], $_SESSION["password"])) {
    redirect("index.php");
    exit();
}
?>

<!DOCTYPE html>
<hmtl>
    <head>
        <meta charset="utf-8">
        <title>Админка блога Влада</title>
        <link rel="stylesheet" href="../media/css/style.css?version=<?php echo $version ?>">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
              integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
              crossorigin="anonymous">
        <link rel="stylesheet" href="../static/avgrund.css">
        <link rel="shortcut icon" href="/media/images/books.ico" type="image/x-icon">
    </head>
    <body>
    <div class="container">
        <!-- Header (navbar) -->
        <header id="header">
            <nav class="navbar navbar-default">
                <div class="header__top" style="padding:0;">
                    <div class="container">
                        <nav class="header__top__menu">
                            <ul>
                                <li><a href="../index.php">Перейти на сайт</a>
                            </ul>

                        </nav>
                    </div>
                </div>
            </nav>

            <?php
            if ($_SESSION["error_auth"] == 1) {
                ?>
                <z><B>Неверные имя пользователя и/или пароль!</B></z>
                <?php
                unset ($_SESSION["error_auth"]);
                ?><br><br><?php
            }
            ?>
            <!-- Header (navbar) -->
            <form name="auth" action="authorization.php" method="post">
                <label><p>
                        E-mail<br>
                        <input type="text" name="email" required></p>
                </label>
                <label>
                    Password<br>
                    <input type="password" name="password" required>
                </label>
                <p>
                    <input type="submit" name="button_auth" value="Enter">
                </p>
            </form>

            <footer>
                <p>
                    Блог Влада<br>Copyright &copy; 2017
                </p>
            </footer>
    </div>
    </body>
</hmtl>
