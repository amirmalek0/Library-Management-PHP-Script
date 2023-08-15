
<div class="main">
    <?php if (isset($_GET['del']) && $_GET['del'] == 'ok') {
        ?>
        <div class="success-notification" id="closeAddBook">
            تیکت با موفقیت حذف شد.
            <span onclick="closeAddBook()">&times;</span>
        </div>
    <?php } ?>
    <?php
    if (isset($_POST['delete_ticket'])) {
        if (delete_ticket($_POST['ticket-id'])) {
            header('Location:tickets.php?del=ok');
        }
    }
    if (isset($_GET['reply']) && $_GET['reply'] == 'ok') { ?>

        <div class="success-notification" id="closeEditOk">
            پاسخ تیکت با موفقیت ثبت شد.
            <span onclick="closeEditOk()">&times;</span>
        </div>
    <?php } ?>
    <div class="page-title">
        تیکت ها
    </div>


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
            foreach ($tickets as $ticket) { ?>
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

                        <form action="#" method="POST" id="delete_ticket_form" onsubmit="return confirm(`از حذف این تیکت اطمینان دارید؟`)">
                            <input type="hidden" value="<?= $ticket['ticket_id'] ?>" name="ticket-id">
                            <button class="edit_delete_btn" name="delete_ticket"><img src="assets/img/delete.svg"
                                                                                      alt="حذف">
                            </button>
                        </form>

                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>