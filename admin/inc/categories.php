<div class="main">
    <?php if (isset($_GET['add']) && $_GET['add'] == 'ok') {
        ?>
        <div class="success-notification" id="closeAddCat">
            دسته بندی با موفقیت اضافه شد.
            <span onclick="closeAddCat()">&times;</span>
        </div>
    <?php }
    if (isset($_GET['edit']) && $_GET['edit'] == 'ok') { ?>
        <div class="success-notification" id="closeAddCat">
            دسته بندی با موفقیت ویرایش شد.
            <span onclick="closeAddCat()">&times;</span>
        </div>
    <?php }
    if (isset($_POST['delete_cat'])) {
        $cat_id = $_POST['cat_id'];
        if (delete_category($cat_id)) { ?>
            <div class="success-notification" id="closeDelCat">
                دسته بندی با موفقیت حذف شد.
                <span onclick="closeDelCat()">&times;</span>
            </div>
        <?php }
    } ?>
    <div class="page-title">
        مدیریت دسته بندی ها
    </div>
    <a href="add_category.php">
        <div class="add-book-btn">
            افزودن دسته بندی ها
        </div>
    </a>

    <div class="books-list">
        <table>
            <tr>
                <th>شناسه دسته بندی</th>
                <th>نام دسته بندی</th>

                <th>عملیات</th>
            </tr>
            <?php get_categories();
            foreach ($cats as $cat) { ?>
                <tr>
                    <td><?= $cat['cat_id'] ?></td>
                    <td><?= $cat['cat_name'] ?></td>
                    <td>
                        <form action="edit_category.php" method="POST">
                            <input type="hidden" value="<?= $cat['cat_id'] ?>" name="cat_id">
                            <button class="edit_delete_btn" name="edit_cat"><img src="assets/img/edit.svg" alt="ویرایش">
                            </button>
                        </form>

                        <form action="#" method="POST" id="delete_cat_form" onsubmit="return confirm(`از حذف این دسته بندی اطمینان دارید؟`)">
                            <input type="hidden" value="<?= $cat['cat_id'] ?>" name="cat_id">
                            <button class="edit_delete_btn" name="delete_cat"><img src="assets/img/delete.svg"
                                                                                   alt="حذف">
                            </button>
                        </form>

                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>