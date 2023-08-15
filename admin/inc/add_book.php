<?php if (add_book()) {
    header('Location:books.php?add=ok');
} ?>
<div class="main">
    <?php if (isset($_GET['blank_inputs'])) { ?>
        <div class="fail-notification" id="closeBlankInputs">
            لطفا تمامی مقادیر اجباری را پر کنید!
            <span onclick="closeBlankInputs()">&times;</span>
        </div>
    <?php } ?>
    <div class="page-title">
        افزودن کتاب
    </div>
    <a href="books.php">
        <div class="back-button">
            بازگشت به لیست کتاب ها
        </div>
    </a>
    <form action="#" method="POST" enctype="multipart/form-data">
        <label for="BookName">نام کتاب * :</label>
        <input id="BookName" name="BookName" placeholder="نام کتاب را وارد کنید ..." type="text" required>
        <label for="BookISBN">شناسه کتاب * :</label>
        <input id="BookISBN" name="BookISBN" placeholder="شناسه کتاب را وارد کنید ..." type="text" required>
        <label for="BookCategory"> دسته بندی:</label>
        <select id="BookCategory" name="BookCategory">
            <?php get_categories();
            foreach ($cats as $cat) { ?>
                <option value="<?= $cat['cat_id'] ?>"><?= $cat['cat_name'] ?></option>
            <?php } ?>
        </select>
        <label for="Author">نویسنده * :</label>
        <input id="Author" name="Author" placeholder="نام نویسنده را وارد کنید ..." type="text" required>
        <label for="Publisher">ناشر * :</label>
        <input id="Publisher" name="Publisher" placeholder="نام ناشر را وارد کنید ..." type="text" required>

        <label for="PublishYear">سال چاپ * :</label>
        <input id="PublishYear" name="PublishYear" placeholder="سال چاپ را با فرمت شمسی وارد کنید ..." type="text" required>
        <label for="BookCount">موجودی کتاب * :</label>
        <input id="BookCount" name="BookCount" placeholder="تعداد موجود در کتابخانه را وارد کنید ..." type="number" required>
        <label for="BookImage">تصویر جلد کتاب * :</label>
        <input type="file" name="BookImage" id="BookImage" required>

        <label for="Description">توضیحات یا خلاصه کتاب:</label>
        <textarea cols="30" id="Description" name="Description" rows="10" required></textarea>
        <button class="submit" type="submit" name="add_book">افزودن کتاب</button>
    </form>

</div>