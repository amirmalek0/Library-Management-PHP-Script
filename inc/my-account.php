<?php get_user_info()?>
<h1 class="my-account-welcome">خوش اومدی <?= $user['name']; ?>!</h1>

<!--<div class="borrow-notification" id="borrow-notification">-->
<!--    موعد تحویل کتاب های رزرو شده شما نزدیک است. کتب های رزرو شده را بررسی نمایید!-->
<!--    <span onclick="closeBorrowNotification()">&times;</span>-->
<!--</div>-->

<div class="my-account-boxes">
    <a href="account-info.php">
        <div>
            <img src="assets/img/user-info.svg" alt="اطلاعات حساب کاربری" width="228" height="228">
            <p>اطلاعات حساب کاربری</p></div>
    </a>
    <a href="reservations.php">
        <div>
            <img src="assets/img/reserved-books.svg" alt="کتب رزرو شده" width="228" height="228">
            <p>اطلاعات کتب رزرو شده</p></div>
    </a>
    <a href="tickets.php">
        <div>
            <img src="assets/img/ticket.svg" alt="تیکت ها" width="228" height="228">
            <p>ثبت تیکت پشتیبانی</p></div>
    </a>
</div>