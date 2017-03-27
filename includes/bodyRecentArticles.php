<div class="block">
    <a href="articles">Все записи</a>
    <h3>Свежее</h3>
    <div class="block__content">
        <div class="articles articles__horizontal">
            <?php
            $articles = mysqli_query($connection, "SELECT * FROM articles ORDER BY id DESC LIMIT 10");
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
                                    href="/<?php echo $art_cat['id']."-".translit($art_cat['title']); ?>"><?php echo $art_cat['title']; ?></a>
                            </small>
                        </div>
                        <div
                            class="article__info__preview"><?php introArticle($art['text'], $word_limit = 10);  ?>
                        </div>
                    </div>
                </article>
                <?php
            }
            ?>
        </div>
    </div>
</div>