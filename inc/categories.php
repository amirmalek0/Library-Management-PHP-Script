<?php get_categories() ?>
<h1 class="library-categories">دسته بندی کتب:</h1>
<div class="categories-container">
    <?php foreach ($cats as $cat){ ?>
    <a class="category-box" href="category.php?cat_id=<?= $cat['cat_id']?>"><?= $cat['cat_name'] ?></a>
    <?php } ?>
</div>