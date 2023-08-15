<?php if (isset($_GET['bid']) && get_book_info($_GET['bid'])) { ?>
    <div class="book-info">
        <img alt="کتاب برنامه نویسی وب" src="assets/img/books/<?= $book['image'] ?>">
        <div class="info">
            <div class="book-title"><?= $book['book_name'] ?></div>
            <div class="book-category mr-1rem">دسته بندی کتاب : <?= get_category_name($book['category_id']) ?></div>
            <div class="author mr-1rem">نویسنده : <?= $book['author'] ?></div>
            <div class="publish-year mr-1rem">سال چاپ : <?= $book['publish_year'] ?></div>
            <div class="publisher mr-1rem"> ناشر : <?= $book['publisher'] ?></div>
            <div class="isbn mr-1rem">شناسه کتاب : <?= $book['bid'] ?></div>
            <div class="info-buttons">
                <a class="book-count"> موجودی کتابخانه : <?php if ($book['count'] > 0) {
                        echo $book['count'] . ' عدد';
                    } else {
                        echo "ناموجود";
                    } ?> </a>

                <?php if (is_logged_in()) {
                    submit_borrow_request();

                    if (reservation_exists($_SESSION['userid'], $_GET['bid'])) {
                        $status = $reservation['status'];
                        switch ($status) {
                            case 1:
                                $book_status = "درخواست رزرو برای این کتاب ثبت شده و منتظر تایید کتابدار می باشد.";
                                echo "<a class='reservation-status'>$book_status</a>";
                                break;
                            case 2:
                                return_date();
                                if ($return_date > 0) {
                                    $book_status = " درخواست رزرو برای این کتاب تایید شده - موعد تحویل کتاب : $return_date روز دیگر ";
                                    echo "<a class='reservation-status'>$book_status</a>";
                                } elseif ($return_date < 0) {
                                    $passed_days = abs($return_date);
                                    $fine = $passed_days * 2000;
                                    $fine_formatted = number_format($fine);
                                    update_fine($reservation['rid'], $fine);
                                    $book_status = " از موعد تحویل کتاب شما $passed_days روز است که میگذرد. جریمه کتاب تاکنون : $fine_formatted تومان ";
                                    echo "<a class='reservation-status'>$book_status</a>";

                                } elseif ($return_date == 0) {
                                    $book_status = "مهلت تحویل کتاب تا پایان امروز می باشد. لطفا هرچه سریع تر به کتابخانه مراجعه کنید.";
                                    echo "<a class='reservation-status'>$book_status</a>";
                                }
                                break;

                        }

                    } else {
                        if (have_fine($_SESSION['userid'])) {
                            echo "<div class= 'reservation-prohibited'>  به دلیل وجود بدهی قادر به رزرو کتاب جدید نیستید!</div>";
                        } else {
                            if (book_exists($_GET['bid'])) {
                                include "reservation_form.php";
                            }
                        }
                    } ?>


                <?php } else { ?>
                    <a onclick="openForm()" class="request-borrow">برای ثبت درخواست رزرو باید وارد حساب کاربری خود
                        شوید</a>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="book-description">
        <h1>خلاصه کتاب:</h1>
        <p><?= $book['description'] ?> </p>
    </div>
<?php } else {
    header('Location: index.php');
} ?>

