<?php get_user_info();
    if (isset($_GET['edit']) && $_GET['edit'] == 'ok') {
        ?>
        <div class="success-notification" id="closeEditProfile">
            اطلاعات حساب با موفقیت ویرایش شد.
            <span onclick="closeEditProfile()">&times;</span>
        </div>
    <?php } ?>


<h1 class="my-account-welcome">اطلاعات حساب کاربری</h1>
<div class="account-info-content">

    <form action="" class="account-info-inputs" method="POST">
        <label for="name">نام:</label>
        <input id="name" name="name" type="text" value="<?= $user['name']; ?>">
        <label for="surname">نام خانوادگی:</label>
        <input id="surname" name="surname" type="text" value="<?= $user['surname']; ?>">
        <label for="username">نام کاربری:</label>
        <input type="hidden" value="<?= $user['mid'] ?>" name="mid">
        <input id="username" name="username" type="text" value="<?= $user['username']; ?>" disabled>
        <label id="new-password-label" for="new-password">پسورد جدید:</label>
        <input id="new-password" name="new-password" type="password" disabled>
        <div id="change-password" onclick="newPassword()"> تغییر گذرواژه</div>
        <div id="cancel-change-password" class="cancel-change-password" onclick="CancelNewPassword()">انصراف از تغییر گذرواژه</div>


        <button class="submit-login" type="submit" name="edit-account-info">ویرایش اطلاعات</button>
        <a href="my-account.php" class="back-button">بازگشت به حساب کاربری</a>
    </form>

</div>