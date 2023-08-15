<?php
if (is_logged_in()) {
    get_user_info();
    $userid = $user['mid'];
        submit_ticket($userid);
        ?>
        <div class="ticket-header">
            <h1 class="tickets-title">ثبت تیکت جدید</h1>
        </div>

        <div class="tickets">
            <form action="" method="POST">
                <label for="ticket-title">موضوع تیکت:</label>
                <input type="text" name="ticket-title" id="ticket-title">
                <label for="ticket-desc">متن تیکت</label>
                <textarea name="ticket-desc" id="ticket-desc" cols="30" rows="10"></textarea>
                <div class="ticket-submits">
                    <button type="submit" class="submit-ticket-btn" name="submit_ticket">ثبت تیکت</button>
                    <a href="tickets.php" class="back-button">بازگشت به لیست تیکت ها</a>
                </div>
            </form>

        </div>
    <?php
} else {
    header('Location:my-account.php');
} ?>