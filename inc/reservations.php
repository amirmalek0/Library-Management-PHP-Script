<h1 class="reserved-books-title">کتاب های رزرو شده</h1>
<div class="reserved-books">
    <table>
        <tr>
            <th>شناسه رزرو</th>
            <th>تصویر کتاب</th>
            <th>نام کتاب</th>
            <th>مدت رزرو</th>
            <th>وضعیت</th>

        </tr>
        <?php get_reserved_books($_SESSION['userid']);
        foreach ($reservations as $reservation) { ?>
            <tr>
                <td><?= $reservation['rid'] ?></td>
                <td><img src='assets/img/books/<?= book_img($reservation['book_id']) ?>' width="100px"></td>

                <td>
                    <a class="book-title-reservation" href="book.php?bid=<?= $reservation['book_id'] ?>"><?= book_name($reservation['book_id']) ?></a>
                </td>
                <td><?= $reservation['duration'] ?> روز</td>
                <?php
                $status = $reservation['status'];
                if ($status == 1) { ?>
                    <td><h4 class="pending"> منتظر تایید کتابدار</h4></td>
                <?php } elseif ($status == 2) {
                    return_date();
                    if ($return_date > 0) { ?>
                        <td><h4 class="verified">تایید شده - موعد تحویل : <?= $return_date ?> روز دیگر</h4></td>
                    <?php } elseif ($return_date < 0) {
                        $passed_days = abs($return_date);
                        $fine_value = get_option("fine");
                        $fine = $passed_days * $fine_value;
                        $fine_formatted = number_format($fine);
                        update_fine($reservation['rid'], $fine);
                        ?>
                        <td><h4 class="not-returned">
                                از موعد تحویل کتاب شما <?= $passed_days ?> روز است که میگذرد.
                                جریمه کتاب تاکنون
                                : <?= $fine_formatted ?> تومان </h4></td>
                    <?php } elseif ($return_date == 0) { ?>
                        <td><h4 class="verified">تایید شده - موعد تحویل : تا پایان امروز</h4></td>
                    <?php } ?>
                <?php } elseif ($status == 3) { ?>
                    <td><h4 class="returned">کتاب تحویل کتابخانه شده است</h4></td>
                <?php } ?>
            </tr>
        <?php } ?>
    </table>
</div>