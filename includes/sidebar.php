<div class="block">
    <h3>Приветствую тебя, дорогой друг!</h3>
    <div class="block__content">
        <script type="text/javascript"
                src="//rf.revolvermaps.com/0/0/6.js?i=5knsrjy0031&amp;m=7&amp;s=330&amp;c=ff0000&amp;cr1=00ff6c&amp;f=arial&amp;l=1&amp;bv=0&amp;v0=-10&amp;z=11&amp;rx=40&amp;lx=120&amp;ly=280&amp;rs=0"
                async="async"></script>
    </div>
</div>
<div class="block" id="comment-add-form">
    <h3>Поиск статьи по отрывку</h3>

    <div class="block__content">
        <form class="form" action="/articles">
            <div class="form__group">
                <input type="text" class="form__control" name="search" placeholder="Введите запрос"
                       value="" required>
            </div>
            <input type="submit" class="form__control"
                   value="Найти">
        </form>
    </div>


</div>
<div class="block">
    <h3>Топ читаемых статей</h3>
    <div class="block__content">
        <div class="articles articles__vertical">
            <?php
            $articles = mysqli_query($connection, "SELECT * FROM articles ORDER BY views DESC LIMIT 5");
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
                            <small>Категория: <a
                                    href="/<?php echo $art_cat['id'] . "-" . translit($art_cat['title']);; ?>">
                                    <?php echo $art_cat['title']; ?></a>
                            </small>
                        </div>
                        <div class="article__info__preview"><?php introArticle($art['text'], 70); ?>
                        </div>
                    </div>
                </article>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<div class="block">
    <h3>Последние комментарии</h3>
    <div class="block__content">
        <div class="articles articles__vertical">
            <?php
            $comments = mysqli_query($connection, "SELECT * FROM comments ORDER BY id DESC LIMIT 5");
            while ($comment = mysqli_fetch_assoc($comments)) {
                ?>
                <article class="article">
                    <div class="article__image"
                         style="background-image:
                             url(https://www.gravatar.com/avatar/<?php echo md5($comment['email']); ?>?s=125);">
                    </div>
                    <div class="article__info">
                        <a href="/article/<?php echo $comment['articles_id']; ?>">
                            <?php echo $comment['author']; ?>
                        </a>
                        <div class="article__info__meta"></div>
                        <div class="article__info__preview"><?php introArticle($comment['text'], 70); ?>
                        </div>
                    </div>
                </article>
                <?php
            }
            ?>

        </div>
    </div>
</div>
