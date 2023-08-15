<?php
if (is_logged_in()) {
//    get_user_info();
//    $userid = $user['mid'];
    if (isset($_GET['id'])) {
        $ticket_id = $_GET['id'];
        if(submit_reply()){
            header("Location:tickets.php?reply=ok");
        }        if (get_ticket_detail($ticket_id)) {
            ?>
            <div class="ticket-header">
                <h1 class="tickets-title">پاسخ به تیکت</h1>
            </div>

            <div class="tickets">
                <div class="ticket-detail">
                    <div class="ticket-title"> موضوع تیکت: <?= $ticket['ticket_title'] ?></div>
                    <div class="ticket-description"><?= $ticket['ticket_description'] ?></div>
                    <?php get_replies($ticket_id);
                    foreach ($replies as $reply) {
                        if ($reply['type'] == "user") {
                            ?>
                            <div class="user-reply">
                                <h4>پاسخ شما: </h4>
                                <p><?= $reply['reply_description']?></p>
                            </div>
                        <?php }elseif($reply['type'] == "admin"){ ?>
                        <div class="admin-reply">
                            <h4>پاسخ مدیر: </h4>
                            <p><?= $reply['reply_description']?></p>
                        </div>

                    <?php }} ?>
                    <form action="" method="POST">

                        <label class="ticket-reply-label" for="ticket-reply-desc"> پاسخ: </label>
                        <textarea name="ticket-reply" id="ticket-reply-desc" cols="30" rows="10"></textarea>
                        <input type="hidden" name="ticket-id" value="<?= $ticket_id ?>">
                        <div class="ticket-submits">
                            <button type="submit" class="submit-ticket-btn" name="submit_reply">ثبت پاسخ</button>
                            <a href="tickets.php" class="back-button">بازگشت به لیست تیکت ها</a>
                        </div>
                    </form>
                </div>




            </div>
        <?php }
    } else {
        header('Location:tickets.php');
    }
} else {
    header('Location:my-account.php');
} ?>