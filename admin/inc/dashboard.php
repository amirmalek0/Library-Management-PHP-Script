<div class="main">
    <div class="page-title">
        داشبورد مدیریتی
    </div>
    <div class="dashboard">

        <div class="col-1">
            <h2 class="dashboard-title">
                تیکت های کاربران
            </h2>
            <div class="books-list">
                <table>
                    <tr>
                        <th>شناسه تیکت</th>
                        <th>ارسال کننده</th>
                        <th>موضوع تیکت</th>
                        <th>پیام تیکت</th>

                        <th>عملیات</th>
                    </tr>
                    <?php get_tickets();
                    foreach (array_slice($tickets, 0, 3) as $ticket) { ?>
                        <tr>
                            <td><?= $ticket['ticket_id'] ?></td>
                            <td><?= get_user_name($ticket['user_id']) ?></td>
                            <td><?= $ticket['ticket_title'] ?></td>
                            <td><?= $ticket['ticket_description'] ?></td>

                            <td>
                                <form action="reply_ticket.php" method="POST">
                                    <input type="hidden" value="<?= $ticket['ticket_id'] ?>" name="ticket-id">
                                    <button class="edit_delete_btn" name="reply_ticket"><img src="assets/img/reply.svg"
                                                                                             alt="پاسخ">
                                    </button>
                                </form>

                                <form action="#" method="POST" id="delete_ticket_form"
                                      onsubmit="return confirm(`از حذف این تیکت اطمینان دارید؟`)">
                                    <input type="hidden" value="<?= $ticket['ticket_id'] ?>" name="ticket-id">

                                </form>

                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <a class="see-more" href="tickets.php">مشاهده تمام تیکت ها</a>

        </div>
        <div class="col-2">
            <h2 class="dashboard-title">
                درخواست های رزرو
            </h2>
            <div class="books-list">
                <table>
                    <tr>
                        <th>تصویر کتاب</th>
                        <th>نام کتاب</th>
                        <th>کاربر</th>
                        <th>مدت رزرو</th>
                        <th>موعد تحویل</th>
                        <th>جریمه دیرکرد</th>


                    </tr>
                    <?php
                    get_reservations();

                    foreach (array_slice($reservations, 0, 2) as $reservation) {
                        return_date();
                        ?>
                        <tr>
                            <td><img src='../assets/img/books/<?= book_img($reservation['book_id']) ?>' width="100px">
                            </td>
                            <td><a href="<?= siteurl() ?>/book.php?bid=<?= $reservation['book_id'] ?>"
                                   target="_blank"> <?= book_name($reservation['book_id']) ?></a></td>
                            <td><?= get_user_name($reservation['user_id']) ?></td>

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



                        </tr>
                    <?php } ?>
                </table>
            </div>
            <a class="see-more" href="reservations.php">مشاهده تمام درخواست ها</a>

        </div>
    </div>

</div>