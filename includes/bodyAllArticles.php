<div class="block">
    <?php

    $countOfArticlesPerPage = 6;//количество записей на стринце
    $page = 1; //текущая страница
    if (isset($_GET['page'])) {
        $page = (int)$_GET['page'];
    }
    $categoryInclude = false;
    $totalCountQuery = mysqli_query($connection, "SELECT COUNT(id) AS total_count FROM articles");
    if (isset($_GET['category'])) {
        $totalCountQuery = mysqli_query($connection, "SELECT COUNT(category_id) AS total_count FROM articles WHERE category_id=" . (int)$_GET['category']);
        $categoryInclude = true;
    }

    $totalCount = mysqli_fetch_assoc($totalCountQuery);
    $totalCount = $totalCount['total_count'];//количество записей(статей)

    $totalPages = ceil($totalCount / $countOfArticlesPerPage);
    if ($page <= 1 || $page > $totalPages) {
        $page = 1;
    }

    $offset = ($countOfArticlesPerPage * $page) - $countOfArticlesPerPage; //сдвиг
    $articles = mysqli_query($connection, "SELECT * FROM articles ORDER BY id DESC LIMIT $offset,$countOfArticlesPerPage");
    if (isset($_GET['category'])) {
        $query = "SELECT * FROM articles WHERE category_id=" . (int)$_GET['category'] . " ORDER BY id DESC LIMIT $offset,$countOfArticlesPerPage";
        $articles = mysqli_query($connection, $query);
    }
    $articlesExist = true;

    if (mysqli_num_rows($articles) <= 0) {
        echo "<h3>Извините, в данной категории отсутсвуют статьи</h3>";
        $articlesExist = false;
    } else echo "<h3>Все статьи</h3>"; ?>

    <div class="block__content">
        <div class="articles articles__horizontal">
            <?php
            while ($art = mysqli_fetch_assoc($articles)) {
                ?>
                <article class="article">
                    <div class="article__image"
                         style="background-image: url(/static/imagesPreview/<?php echo $art['image']; ?>);"></div>
                    <div class="article__info">
                        <a href="/article/<?php echo $art['id']."-".translit($art['title']); ?>"><?php echo $art['title']; ?></a>
                        <div class="article__info__meta">
                            <?php
                            $art_cat = false;
                            foreach ($categories as $cat) {
                                if ($cat['id'] == $art['category_id']) {
                                    $art_cat = $cat;
                                    break;
                                }
                            }
                            ?>
                            <small>Категория: <a
                                    href="/category/<?php echo $art_cat['id']."-".translit($art_cat['title']); ?>"><?php echo $art_cat['title']; ?></a>
                            </small>
                        </div>
                        <div
                            class="article__info__preview"><?php introArticle($art['text'], $word_limit = 10); ?>
                        </div>
                    </div>
                </article>
                <?php
            }
            ?>
        </div>

        <?php
        if ($articlesExist == true && $categoryInclude != true) {
            if ($page > 1) {
                echo '<a href="/articles/' . ($page - 1) . '"><div class="paginationLeft">&laquo; Предыдущая страница</div></a>';
            }
            if ($page < $totalPages) {
                echo '<a href="/articles/' . ($page + 1) . '"><div class="paginationRight">Следующая страница &raquo;</div></a>';
            }
        }
        if ($articlesExist == true && $categoryInclude == true) {
            if ($page > 1) {
                echo '<a href="/category/' . (int)$_GET['category'] ."-".translit($art_cat['title']). '/' . ($page - 1) . '"><div class="paginationLeft">&laquo; Предыдущая страница</div></a>';
            }
            if ($page < $totalPages) {
                echo '<a href="/category/' . (int)$_GET['category'] ."-".translit($art_cat['title']). '/' . ($page + 1) . '"><div class="paginationRight">Следующая страница &raquo;</div></a>';
            }
        }
        ?>

    </div>
</div>
<?php
/*            $totalCountQuery=0; $category=0; $totalCount=0;
if (isset($_GET['page'])&&isset($_GET['category'])) {
$page = (int)$_GET['page'];
$id = (int)$_GET['category'];
$totalCountQuery = mysqli_query($connection, "SELECT COUNT(id) AS total_count FROM articles WHERE id=" . (int)$_GET['id']);
$totalCount = mysqli_fetch_assoc($totalCountQuery);
$totalCount = $totalCount['total_count'];//количество записей(статей)
}
else if(isset($_GET['page'])){
$page = (int)$_GET['page'];
$totalCountQuery = mysqli_query($connection, "SELECT COUNT(id) AS total_count FROM articles");
$totalCount = mysqli_fetch_assoc($totalCountQuery);
$totalCount = $totalCount['total_count'];//количество записей(статей)
}


                        $totalCountQuery = mysqli_query($connection, "SELECT COUNT(id) AS total_count FROM articles");
            $articles = mysqli_query($connection, sprintf("SELECT * FROM articles WHERE id=%d ORDER BY id DESC LIMIT $offset,$countOfArticlesPerPage"), (int)$_GET['id']);*/
?>