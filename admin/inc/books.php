<div class="main">
    <?php if (isset($_GET['add']) && $_GET['add'] == 'ok') {
        ?>
        <div class="success-notification" id="closeAddBook">
            کتاب با موفقیت به کتابخانه افزوده شد.
            <span onclick="closeAddBook()">&times;</span>
        </div>
    <?php }
    if (isset($_GET['edit']) && $_GET['edit'] == 'ok') { ?>
        <div class="success-notification" id="closeEditOk">
            کتاب با موفقیت ویرایش شد.
            <span onclick="closeEditOk()">&times;</span>
        </div>
    <?php }
    if (isset($_POST['delete'])) {
        $book_id = $_POST['bid'];
        if (delete_book($book_id)) { ?>
            <div class="success-notification" id="closeAddBook">
                کتاب با موفقیت از کتابخانه حذف شد.
                <span onclick="closeAddBook()">&times;</span>
            </div>
        <?php }
    } ?>

    <div class="page-title">
        مدیریت کتاب ها
    </div>
    <a href="add_book.php">
        <div class="add-book-btn">
            افزودن کتاب
        </div>
    </a>
    <div class="books-list">
        <table>
            <tr>
                <th>تصویر کتاب</th>
                <th>شناسه کتاب</th>
                <th>نام کتاب</th>
                <th>دسته بندی</th>
                <th>نویسنده</th>
                <th>سال چاپ</th>
                <th>تعداد موجودی</th>
                <th>عملیات</th>
            </tr>
            <?php get_books();
            foreach ($books as $book) { ?>
                <tr>
                    <td><img width="100px" src="<?= IMG_PATH . $book['image'] ?>" alt="<?= $book['book_name'] ?>"></td>
                    <td><?= $book['bid'] ?></td>
                    <td><a href="<?=siteurl()?>/book.php?bid=<?= $book['bid'] ?>" target="_blank"><?= $book['book_name'] ?></a></td>
                    <td><a href="<?=siteurl()?>/category.php?cat_id=<?=$book['category_id']?>" target="_blank"> <?= get_category_name($book['category_id']) ?></a></td>
                    <td><?= $book['author'] ?></td>
                    <td><?= $book['publish_year'] ?></td>
                    <td><?= $book['count'] ?> عدد</td>
                    <td>
                        <form action="edit_book.php" method="POST">
                            <input type="hidden" value="<?= $book['bid'] ?>" name="bid">
                            <button class="edit_delete_btn"><img src="assets/img/edit.svg" alt="ویرایش"></button>
                        </form>

                        <form action="" method="POST" id="delete_book_form" onsubmit="return confirm(`از حذف این کتاب اطمینان دارید؟`)">
                            <input type="hidden" value="<?= $book['bid'] ?>" name="bid">
                            <button class="edit_delete_btn" name="delete"><img src="assets/img/delete.svg" alt="حذف">
                            </button>
                        </form>

                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>

