<?php if (isset($_POST['ticket-id'])) {
    $ticket_id = $_POST['ticket-id'];
    if(submit_reply()){
     header("Location:tickets.php?reply=ok");
    }
    if (get_ticket_detail($ticket_id)) {

        ?>


        <div class="main">
            <div class="page-title">
                پاسخ به تیکت
            </div>
            <div class="ticket-info">
                <h3>موضوع تیکت : <?= $ticket['ticket_title'] ?></h3>
                <div class="ticket-details">
                    <h6> ارسال کننده: <?= get_user_name($ticket['user_id']) ?></h6>
                    <h6> تاریخ: <?= $ticket['date'] ?></h6>
                </div>
                <p class="ticket-description"><?= $ticket['ticket_description'] ?></p>

                <?php get_replies($ticket_id);
                foreach ($replies as $reply) {
                    if ($reply['type'] == "user") {
                        ?>
                        <div class="user-reply">
                            <h4>پاسخ یوزر: </h4>
                            <p><?= $reply['reply_description'] ?></p>
                        </div>
                    <?php } elseif ($reply['type'] == "admin") { ?>

                        <div class="admin-reply">
                            <h4>پاسخ شما (مدیر): </h4>
                            <p><?= $reply['reply_description'] ?></p>
                        </div>
                    <?php }
                } ?>

                <form action="" method="POST">

                    <label class="ticket-reply-label" for="ticket-reply-desc"> پاسخ: </label>
                    <textarea name="ticket-reply" id="ticket-reply-desc" cols="30" rows="10"></textarea>
                    <input type="hidden" name="ticket-id" value="<?= $ticket_id ?>">
                        <button type="submit" class="submit-ticket-btn" name="submit_reply">ثبت پاسخ</button>
                    <a href="tickets.php" class="back-button">بازگشت به لیست تیکت ها</a>

                </form>

            </div>
        </div>

    <?php } else {
        header('Location:tickets.php');
    }
} else {
    header("Location:tickets.php");
} ?>