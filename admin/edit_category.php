<?php
$title = 'ویرایش دسته بندی';
include "inc/header.php";

if (isset($_POST['edit_cat'])) {
    $cat_id = $_POST['cat_id'];
    get_category_name($cat_id);

    ?>

    <div class="main">
        <div class="page-title">
            افزودن دسته بندی
        </div>
        <a href="categories.php">
            <div class="back-button">
                بازگشت به لیست دسته بندی ها
            </div>
        </a>
        <form action="" method="POST">
            <label for="CatId">شناسه دسته بندی</label>
            <input type="text" name="CatId" id="CatId" value="<?= $cat_id ?>" readonly>
            <label for="CatName">نام دسته بندی:</label>
            <input type="text" name="CatName" id="CatName" value="<?= get_category_name($cat_id) ?>">
            <button class="submit" type="submit" name="edit_category">ویرایش دسته بندی</button>
        </form>
    </div>

<?php } elseif (update_category()) {
    header("Location:categories.php?edit=ok");
} else {
    header("Location:categories.php");
} ?>