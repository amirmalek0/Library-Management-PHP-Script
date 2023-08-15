<?php if (add_category()) {
    header("Location:categories.php?add=ok");
} ?>
<div class="main">
    <div class="page-title">
        افزودن دسته بندی
    </div>
    <a href="categories.php">
        <div class="back-button">
            بازگشت به لیست دسته بندی ها
        </div>
    </a>
    <form action="#" method="POST">
        <label for="CatId">شناسه دسته بندی</label>
        <input type="text" name="CatId" id="CatId" value="<?= rand(1, 999) ?>" readonly>
        <label for="CatName">نام دسته بندی:</label>
        <input type="text" name="CatName" id="CatName" required>
        <button class="submit" type="submit" name="add_category">افزودن دسته بندی</button>
    </form>
</div>
