<form action="" method="POST" style="display: inline-block">
    <input type="hidden" name="uid"
           value="<?php if (isset($_SESSION['userid'])) echo $_SESSION['userid']; ?>">
    <input type="hidden" name="bid"
           value="<?= $_GET['bid'] ?>">
    <button type="submit" class="request-borrow" name="request_borrow"
            onclick="return confirm('از ثبت درخواست رزرو برای این کتاب مطمئن هستید؟')">ثبت
        درخواست
        امانت
        گرفتن این
        کتاب
    </button>
    برای
    <select class="days" name="days" id="days">
        <?php $all_days = get_option("durations");
        $days = explode("," ,$all_days);
        foreach ($days as $day) { ?>
            <option value="<?=$day?>"><?=$day?>  روز</option>
        <?php }
        ?>
    </select>
</form>