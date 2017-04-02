<?php
while ($art = mysqli_fetch_assoc($articles)) {
    ?>
    <article class="article">
        <a href="/article/<?php echo $art['id'] . "-" . translit($art['title']); ?>">
            <div class="article__image"
                 style="background-image: url(/static/imagesPreview/<?php echo $art['image']; ?>);">
            </div>
        </a>
        <div class="article__info">
            <a href="/article/<?php echo $art['id'] . "-" . translit($art['title']); ?>">
                <?php introArticle($art['title'], 50) ?>
            </a>
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
                <small>Категория:
                    <a href="/<?php echo $art_cat['id'] . "-" . translit($art_cat['title']); ?>">
                        <?php echo $art_cat['title']; ?>
                    </a>
                </small>
            </div>
            <div
                class="article__info__preview"><?php introArticle($art['text'], 70); ?>
            </div>
        </div>
    </article>
    <?php
}
?>
