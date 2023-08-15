<div class="ticket-header">
    <h1 class="reserved-books-title"> پشتیبانی و تیکت</h1>
    <div class="new-ticket"><a href="new_ticket.php">
            ثبت تیکت جدید
        </a></div>
</div>
<?php
if (is_logged_in()) {
     if (isset($_GET['reply']) && $_GET['reply'] == 'ok') { ?>

        <div class="success-notification" id="closeReplyOk">
            پاسخ تیکت با موفقیت ثبت شد.
            <span onclick="closeReplyOk()">&times;</span>
        </div>
    <?php }
    get_user_info();
    $userid = $user['mid'];
    if (get_tickets($userid)) {
        if (isset($_GET['add']) && $_GET['add'] == 'ok') { ?>
            <div class="success-notification" id="closeAddTicket">
                تیکت با موفقیت ثبت شد.
                <span onclick="closeAddTicket()">&times;</span>
            </div>
        <?php }
        ?>

        <div class="reserved-books">
            <table>
                <tr>
                    <th>شناسه تیکت</th>
                    <th>موضوع تیکت</th>
                    <th>متن تیکت</th>
                    <th style="text-align: center">مشاهده و پاسخ</th>
                </tr>
                <?php foreach ($tickets as $ticket) { ?>
                    <tr>
                        <td><?= $ticket['ticket_id'] ?></td>
                        <td><?= $ticket['ticket_title'] ?></td>
                        <td><?= $ticket['ticket_description'] ?></td>
                        <td style="text-align: center"><a href="show_ticket.php?id=<?= $ticket['ticket_id'] ?>"><img
                                    class="open-ticket"
                                    src="assets/img/open_ticket.svg"
                                    alt="باز کردن تیکت"></a></td>
                    </tr>
                <?php } ?>
            </table>
            <a href="my-account.php" class="back-button">بازگشت به حساب کاربری</a>
        </div>
    <?php } else { ?>
        <div class="reserved-books">
            <p class="warning-notification">تیکتی جهت نمایش وجود ندارد</p>
            <a href="my-account.php"
               class="back-button">بازگشت
                به حساب کاربری</a>
        </div>
    <?php }
} else {
    header('Location:my-account.php');
} ?>