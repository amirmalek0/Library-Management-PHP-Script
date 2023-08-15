<div class="main">
    <?php if (isset($_GET['borrow']) && $_GET['borrow'] == 'ok') {
        ?>
        <div class="success-notification" id="closeAddBook">
            کتاب با موفقیت امانت داده شد
            <span onclick="closeAddBook()">&times;</span>
        </div>
    <?php } ?>
    <div class="page-title">
        مدیریت درخواست های رزرو
    </div>
    <a href="add_reservation.php">
        <div class="add-book-btn">
            امانت دادن دستی کتاب
        </div>
    </a>

    <div class="books-list">
        <table style="border-collapse: collapse">
            <tr>
                <th>شناسه رزرو</th>
                <th>تصویر کتاب</th>
                <th>نام کتاب</th>
                <th>کاربر</th>
                <th>تاریخ دریافت کتاب</th>
                <th>مدت رزرو</th>
                <th>موعد تحویل</th>
                <th>جریمه دیرکرد</th>
                <th>وضعیت کتاب</th>
            </tr>
            <?php
            if (get_reservations_by_user()) {
                echo "<div class='user-res'>
                رزرو های کاربر :" . get_user_name($userid) . "</div>";
            } else {
                get_reservations();

            }
            foreach ($reservations as $reservation) {
                return_date();
                ?>
                <?php if ($reservation['status'] == 3) {
                    echo "<tr style='background-color: #cccccc91'>";
                } else {
                    echo "<tr>";
                } ?>
                <td><?= $reservation['rid'] ?></td>
                <td><img src='../assets/img/books/<?= book_img($reservation['book_id']) ?>' width="100px"></td>
                <td><a href="<?= siteurl() ?>/book.php?bid=<?= $reservation['book_id'] ?>"
                       target="_blank"> <?= book_name($reservation['book_id']) ?></a></td>
                <td>
                    <a href="reservations.php?uid=<?= $reservation['user_id'] ?>"> <?= get_user_name($reservation['user_id']) ?></a>
                </td>
                <td><?php if ($reservation['status'] == '2' || $reservation['status'] == '3') {
                        echo jdate("l, j F Y", strtotime($reservation['date']));
                    } else echo "-"; ?></td>

                <td><?= $reservation['duration'] ?> روز</td>

                <?php
                if ($reservation['status'] == '2') {
                    if ($return_date > 0) { ?>
                        <td><?= $return_date ?> روز باقی مانده</td>
                    <?php } elseif ($return_date == 0) { ?>
                        <td>تا پایان امروز</td>
                    <?php } elseif ($return_date < 0) { ?>
                        <td><?= abs($return_date) ?> روز از موعد تحویل گذشته است</td>
                    <?php }
                } else { ?>
                    <td>-</td>

                <?php } ?>

                <?php if ($reservation['fine'] == 0) { ?>
                    <td>ندارد</td>
                <?php } elseif ($reservation['fine'] > 0) { ?>
                    <th><?= number_format($reservation['fine']) ?> تومان</th>
                <?php } ?>

                <?php
                if (confirm_reservation()) {
                    header("Location:reservations.php?confirm=ok");
                }
                if (return_book()) {
                    header("Location:reservations.php?return=ok");
                }
                $status = $reservation['status'];
                if ($status == 1) {

                    ?>
                    <td>
                        <div class="status">
                            وضعیت : منتظر تایید
                        </div>
                        <form action="" method="POST">
                            <input type="hidden" value="<?= $reservation['rid'] ?>" name="rid">
                            <input type="hidden" value="<?= $reservation['book_id'] ?>" name="bid">
                            <button type="submit" class="action-verify" name="confirm-res">
                                تایید کردن
                            </button>
                        </form>
                    </td>
                <?php } elseif ($status == 2) { ?>
                    <td>
                        <div class="status">
                            وضعیت : تایید شده
                        </div>
                        <form action="" method="POST">
                            <input type="hidden" value="<?= $reservation['rid'] ?>" name="rid">
                            <input type="hidden" value="<?= $reservation['book_id'] ?>" name="bid">
                            <button type="submit" class="action-return" name="return-book">
                                تحویل گرفتن
                            </button>
                        </form>

                    </td>
                <?php } elseif ($status == 3) { ?>
                    <td>
                        <div class="status returned">تحویل کتابخانه شده</div>
                    </td>
                <?php } ?>

                </tr>
            <?php } ?>
        </table>
    </div>
</div>