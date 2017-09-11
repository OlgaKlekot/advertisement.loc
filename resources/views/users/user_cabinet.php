<div class="posts">
    <?php if (isset($_GET['category'])): ?>
        <h1><?= strtoupper($_GET['category']) ?></h1>
    <?php endif; ?>
    <?php foreach ($posts as $post): ?>
    <div class="post">
        <span class="date"><?= $post['created_at'] ?></span>
        <a href="<?= \app\core\createUrl('definite_post', ['postN' => $post['title']]) ?>"><h3 class="title"><?= $post['title'] ?></h3></a>
        <p>
            category: <span><?= $post['type']['category'] ?></span>
            authored by <span class="author"><?= $post['author']['username'] ?></span>
        </p>
        <?php if (isset($post['price']) && $post['price'] != 0): ?>
            price: <span><?= sprintf ("$%01.2f", $post['price']) ?></span>
        <?php endif; ?>
        <div class="image"></div>
        <?php if (strlen($post['main']) > 150) {
            $post['main'] = substr($post['main'],0,150) . "...";
        } ?>
        <p class="post_text"><?= $post['main'] ?></p>
        <div class="changes">
            <a href="<?= \app\core\createUrl('edit_post') ?>?edit=<?= $post['id'] ?>"><input type="button" class="button" value="Edit"></a>
            <a href="<?= \app\core\createUrl('delete_post') ?>?delete=<?= $post['title'] ?>"><input type="button" class="button" value="Delete"></a>
        </div>
    </div>
<?php endforeach; ?>
</div>
<aside>
    <?= app\core\renderFile('../src/controllers/categoriesList.php',
        'app\\src\\controllers\\categoriesList\\categoriesList') ?>
</aside>