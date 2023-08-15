<?php
$title = 'ویرایش کتاب';

include "inc/header.php";
if (isset($_POST['bid'])) {
    get_book_data($_POST['bid']);
} else {
    header("Location:books.php");
}
if (edit_book()) {
    header("Location:books.php?edit=ok");
}

?>
<div class="main">
    <?php if (isset($_GET['blank_inputs'])) { ?>
        <div class="fail-notification" id="closeBlankInputs">
            لطفا تمامی مقادیر اجباری را پر کنید!
            <span onclick="closeBlankInputs()">&times;</span>
        </div>
    <?php } ?>
    <div class="page-title">
        ویرایش کتاب: <?= $book['book_name'] ?>
    </div>
    <a href="books.php">
        <div class="back-button">
            بازگشت به لیست کتاب ها
        </div>
    </a>
    <form action="#" method="POST" enctype="multipart/form-data">
        <label for="BookISBN">شناسه کتاب :</label>
        <input id="BookISBN" name="BookISBN" placeholder="شناسه کتاب را وارد کنید ..." type="text"
               value="<?= $book['bid'] ?>" readonly>
        <label for="BookName">نام کتاب * :</label>
        <input id="BookName" name="BookName" placeholder="نام کتاب را وارد کنید ..." type="text"
               value="<?= $book['book_name'] ?>" required>
        <label for="BookCategory"> دسته بندی:</label>
        <select id="BookCategory" name="BookCategory">
            <?php get_categories();
            foreach ($cats as $cat) { ?>
                <option <?php if ($book['category_id'] == $cat['cat_id']) {
                    echo 'selected';
                } ?> value="<?= $cat['cat_id'] ?>"><?= $cat['cat_name'] ?></option>
            <?php } ?>
        </select>
        <label for="Author">نویسنده * :</label>
        <input id="Author" name="Author" placeholder="نام نویسنده را وارد کنید ..." type="text"
               value="<?= $book['author'] ?>" required>
        <label for="Publisher">ناشر * :</label>
        <input id="Publisher" name="Publisher" placeholder="نام ناشر را وارد کنید ..." type="text"
               value="<?= $book['publisher'] ?>" required>

        <label for="PublishYear">سال چاپ * :</label>
        <input id="PublishYear" name="PublishYear" placeholder="سال چاپ را با فرمت شمسی وارد کنید ..." type="text"
               value="<?= $book['publish_year'] ?>" required>
        <label for="BookCount">موجودی کتاب * :</label>
        <input id="BookCount" name="BookCount" placeholder="تعداد موجود در کتابخانه را وارد کنید ..." type="number"
               value="<?= $book['count'] ?>" required>
        <label for="BookImage">تصویر جلد کتاب * :</label>
        <input type="file" name="BookImage" id="BookImage">
        <div>تصویر فعلی :</div>
        <a href="<?= IMG_PATH . $book['image'] ?>" target="_blank"><img width="100px" src="<?= IMG_PATH . $book['image'] ?>" alt="<?= $book['book_name'] ?>"></a>
        <input type="hidden" name="book_image" value="<?=$book['image'] ?>">
        <label for="Description">توضیحات یا خلاصه کتاب:</label>
        <textarea cols="30" id="Description" name="Description" rows="10"
                  required><?= $book['description'] ?></textarea>
        <button class="submit" type="submit" name="edit_book">ویرایش کتاب</button>
    </form>

</div>


<?php include "inc/footer.php" ?>