<?php
$title = "حساب کاربری";
include "inc/header.php" ?>
    <div class="main">

        <?php
        if (is_logged_in()) {
            include "inc/my-account.php";
        }else{
            include 'inc/not-logged-in.php';
        }
        ?>
    </div>

<?php include "inc/footer.php"; ?>