<?php
$title = 'ویرایش کاربر';
include "inc/header.php";

if (isset($_POST['edit_member'])) {
    $member_id = $_POST['member-id'];
    get_user_info($member_id);
    ?>

    <div class="main">
        <div class="page-title">
            ویرایش کاربر :  <?= $user['name'] . " " . $user['surname'] ?>
        </div>
        <a href="members.php">
            <div class="back-button">
                بازگشت به لیست کاربران
            </div>
        </a>
        <form action="" method="POST">
            <label for="mid">شناسه کاربر:</label>
            <input type="text" name="mid" id="mid" value="<?= $user['mid'] ?>" readonly>
            <label for="name">نام:</label>
            <input type="text" name="name" id="name" value="<?= $user['name'] ?>">
            <label for="surname">نام خانوادگی:</label>
            <input type="text" name="surname" id="surname" value="<?= $user['surname'] ?>">
            <label for="username">نام کاربری:</label>
            <input type="text" name="username" id="username" value="<?= $user['username'] ?>">
            <label for="role">نقش کاربر:</label>
            <select name="role" id="role">

                <option value="1" <?php if($user['role'] == 1) echo 'selected'?>>یوزر معمولی کتابخانه</option>
                <option value="2" <?php if($user['role'] == 2) echo 'selected'?>>مدیر کتابخانه</option>

            </select>
            <button class="submit" type="submit" name="edit_user">ویرایش کاربر</button>
        </form>
    </div>

<?php } elseif (edit_user()) {
    header("Location:members.php?edit=ok");
} else {
    header("Location:members.php");
} ?>