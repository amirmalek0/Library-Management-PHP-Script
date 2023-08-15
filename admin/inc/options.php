<?php if (update_options()) {
    header("Location:options.php?options=ok");
} ?>
<div class="main">
    <?php if (isset($_GET['options']) && $_GET['options'] == 'ok') {
        ?>
        <div class="success-notification" id="closeAddCat">
            تنظیمات با موفقیت به روز شدند.
            <span onclick="closeAddCat()">&times;</span>
        </div>
    <?php } ?>
    <div class="page-title">
        تنظیمات
    </div>


    <div class="books-list">
        <form action="" method="POST">
            <?php foreach (get_options() as $opt) { ?>
                <label for="<?= $opt['option_name'] ?>"><?= $opt['option_desc'] ?></label>
                <input type="text" name="<?= $opt['option_name'] ?>" id="<?= $opt['option_name'] ?>"
                       value="<?= $opt['option_value'] ?>">
            <?php } ?>
            <button class="submit" type="submit" name="UpdateOptions"> ویرایش تنظیمات</button>
        </form>
    </div>
</div>
