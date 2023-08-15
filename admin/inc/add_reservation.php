<?php if(submit_borrow_request()){
    header('Location:reservations.php?borrow=ok');
} ?>
<div class="main">
    <div class="page-title">
        امانت دادن دستی کتاب
    </div>
    <a href="reservations.php">
        <div class="back-button">
            بازگشت به لیست رزرو ها
        </div>
    </a>
    <form action="#" method="POST">
        <label for="user">انتخاب کاربر : </label>
        <select name="user" id="user">
            <?php get_all_users();
            foreach ($members as $user) { ?>
                <option
                    value="<?= $user['mid'] ?>"><?= $user['name'] . " " . $user['surname'] . " -- " . $user['username'] ?></option>
            <?php } ?>
        </select>
        <label for="book">انتخاب کتاب : </label>

        <select name="book" id="book">
            <?php get_available_books();
            foreach ($books as $book) {
                ?>
                <option value="<?= $book['bid'] ?>"><?= $book['book_name'] ?></option>
            <?php } ?>
        </select>
        <label for="book">مدت رزرو : </label>

        <select name="duration" id="duration">
            <option value="15">15 روز</option>
            <option value="30">30 روز</option>

        </select>
        <button class="submit" type="submit" name="request_borrow">امانت دادن</button>
    </form>
</div>
