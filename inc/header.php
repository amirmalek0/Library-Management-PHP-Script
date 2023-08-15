<?php include "functions.php" ?>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
          name="viewport">
    <meta content="ie=edge" http-equiv="X-UA-Compatible">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/font.css" rel="stylesheet">
    <title><?= $title ?></title>
</head>
<body>

<div class="header">


    <div class="header-elements">
        <img alt="کتابخانه ی مجازی" src="assets/img/logo.png">
        <?php if (is_logged_in()) { ?>
            <div class="logout-btn"><a href="logout.php">
                    خروج از حساب کاربری
                </a></div>
        <?php } else { ?>
            <div class="login-signup"><a onclick="openForm()">
                    ورود / ثبت نام
                </a></div>
        <?php } ?>
    </div>


    <div class="menu">
        <ul>
            <li>
                <a href="<?= site_url() ?>">صفحه اصلی</a>
            </li>
            <li>
                <a href="library.php">کتابخانه</a>
            </li>
            <li>
                <a href="my-account.php">حساب کاربری</a>
            </li>
            <li>
                <a href="tickets.php">ثبت تیکت</a>
            </li>

        </ul>
    </div>
</div>