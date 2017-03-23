<?php
require_once "start.php";
?>
<!DOCTYPE html>
<hmtl>
    <head>
        <meta charset="utf-8">
        <title>Админка Блога Влада</title>
        <link rel="stylesheet" href="../media/css/style.css?version=<?php echo $version ?>">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
              integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
              crossorigin="anonymous">
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
                                <li style="text-align: left;"><a href="index.php">
                                        <z><b>Админ панель</b></z>
                                    </a>
                                <li><a href="../index.php">Перейти на сайт</a>
                                <li><a href="logout.php">Выход</a>
                            </ul>

                        </nav>
                    </div>
                </div>
            </nav>
            <!-- END Header (navbar) -->
            <div id="addart">
                <form method="post" enctype="multipart/form-data"
                      action="index.php?action=<?= $_GET['action'] ?>&id=<?= $_GET['id'] ?>">
                    <label>
                        Выбор категории<br>
                        <select required name="category_id" autofocus>
                            <?php
                            if ($category != null) {
                                foreach ($category as $cat) {
                                    ?>
                                    <option value="<?php echo $cat['id']; ?>"><?php echo $cat['title'];
                                    ?></option><?php
                                }
                            } else { ?>
                                <option disabled selected></option><?php }
                            foreach ($categories as $cat) {
                                ?>
                                <option value="<?php echo $cat['id']; ?>"><?php echo $cat['title']; ?></option>
                            <?php } ?>
                        </select>
                    </label>

                    <label>
                        Название
                        <input type="text" name="title" value="<?= $article['title'] ?>" class="form-item"
                               required>
                    </label><br><br>
                    <label>
                        <?php if ($article['image'] != null && $article['image'] != 'default.jpg') { ?>
                            <div class="articles">Фотография статьи
                                <div class="article">
                                    <div class="article__image"
                                         style="background-image: url(../static/imagesPreview/<?php echo $article['image']; ?>);">
                                    </div>
                                </div>
                            </div>

                        <?php } ?>
                    </label>
                    <?php if ($article['image'] != null && $article['image'] != 'default.jpg') {
                        ?>
                        <label>
                            <input type="submit" name="imageDelete" value="Удалить фото" formmethod="post"
                                   formaction="index.php?action=deleteImage&id=<?= $_GET['id'] ?>" class="btn">
                        </label>
                    <?php } ?>
                    <label>
                        <?php if ($article['image'] != null && $article['image'] != 'default.jpg') {
                            ?>Изменить фотографию
                        <?php } else {
                            ?> Добавить фотографию<?php } ?>
                        <input type="file" name="image">
                    </label>
                    <label>
                        <?php if ($_GET['action'] == 'edit') {
                            if ($article['image'] != null && $article['image'] != 'default.jpg') {
                                ?><input type="submit" name="imageDelete" value="Изменить" formmethod="post"
                                         formaction="index.php?action=changeImage&id=<?= $_GET['id'] ?>" class="btn">
                            <?php } else {
                                ?> <input type="submit" name="imageDelete" value="Добавить" formmethod="post"
                                          formaction="index.php?action=changeImage&id=<?= $_GET['id'] ?>"
                                          class="btn"><?php }
                        } ?>
                    </label><br><br><br>
                    <label>
                        Содержимое
                        <textarea class="form-item" name="text" required><?= $article['text'] ?></textarea>
                    </label>
                    <input type="submit" value="Сохранить" class="btn">
                </form>
                <?php if ($_GET['id'] != null) { ?>
                    <table class="table">
                    <label>
                        <br>Комментарии
                    </label>
                    <?php
                    if ($comments != null) { ?>
                        <tr>
                            <th><b>Дата и время публикации</b></th>
                            <th><b>Автор</b></th>
                            <th><b>Текст</b></th>
                            <th><b>Удаление</b></th>
                        </tr>
                        <?php
                        foreach ($comments as $com): ?>
                            <tr id="form">
                                <td><?= $com['pubdate'] ?></td>
                                <td><?= $com['author'] ?></td>
                                <td><?= introArticle($com['text'], 80) ?></td>
                                <td>
                                    <a href="index.php?action=deleteComment&id=<?= $com['id'] ?>&articleID=<?= $_GET['id'] ?>#form">Удалить</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                        </table>
                    <?php }
                    if ($comments == null) {
                        ?>

                        В настоящий момент комментариев не добавлено

                    <?php }
                } ?>
            </div>

    </div>
    <footer>
        <p>
            Блог Влада<br>Copyright &copy; 2017
        </p>
    </footer>
    </body>