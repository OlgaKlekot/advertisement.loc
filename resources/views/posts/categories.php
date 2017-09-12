<div class="sidebar">
        <ul>
            <?php foreach ($categories as $category): ?>
                <?php if($app['route']['name'] == 'user_cabinet'): ?>
                    <a href="<?= \app\core\createUrl('user_cabinet') ?>?category=<?= $category['category'] ?>">
                        <li class="button" id="categoryBtn">
                            <?= $category['category'] ?>
                        </li>
                    </a>
                 <?php else: ?>
                    <a href="<?= \app\core\createUrl('main_page') ?>?category=<?= $category['category'] ?>">
                         <li class="button" id="categoryBtn">
                             <?= $category['category'] ?>
                         </li>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
</div>