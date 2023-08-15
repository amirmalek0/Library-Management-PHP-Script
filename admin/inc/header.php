<?php
include "functions.php";
if(is_logged_in()){
?>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
          name="viewport">
    <meta content="ie=edge" http-equiv="X-UA-Compatible">
    <title><?= $title ?></title>
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/font.css" rel="stylesheet">

</head>

<body>
<div class="sidenav">
    <a <?php if($title == 'داشبورد مدیریتی'){ echo'class="selected"';}?> href="index.php">پنل مدیریت</a>
    <a <?php if($title == 'کتاب ها' || $title == 'افزودن کتاب'){ echo'class="selected"';}?> href="books.php">کتاب ها</a>
    <a <?php if($title == 'دسته بندی کتب' || $title == 'افزودن دسته بندی'){ echo'class="selected"';}?> href="categories.php">دسته بندی کتب</a>
    <a <?php if($title == 'درخواست های رزرو کتاب' || $title == 'امانت دادن دستی کتاب'){ echo'class="selected"';}?> href="reservations.php">اطلاعات رزرو</a>
    <a <?php if($title == 'تیکت ها' || $title == 'پاسخ به تیکت'){ echo'class="selected"';}?> href="tickets.php">تیکت ها</a>
    <a <?php if($title == 'کاربران'){ echo'class="selected"';}?> href="members.php">کاربران</a>
    <a <?php if($title == 'تنظیمات'){ echo'class="selected"';}?> href="options.php">تنظیمات</a>

    <a href="logout.php">خروج</a>
</div>
<?php }else{
    header('Location:'. siteurl());
} ?>