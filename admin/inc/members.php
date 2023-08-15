<div class="main">
    <?php
    if (isset($_POST['delete_member'])) {
        if (delete_user($_POST['member-id'])) {
            header("Location:members.php?del=ok");
        };
    }
    if (isset($_GET['edit']) && $_GET['edit'] == 'ok') { ?>
        <div class="success-notification" id="closeUserEdit">
            کاربر با موفقیت ویرایش شد.
            <span onclick="closeUserEdit();">&times;</span>
        </div>
    <?php } elseif (isset($_GET['del']) && $_GET['del'] == 'ok') { ?>
        <div class="success-notification" id="closeUserDel">
            کاربر با موفقیت حذف شد.
            <span onclick="closeUserDel();">&times;</span>
        </div>
    <?php } ?>

    <div class="page-title">
        مدیریت کاربران
    </div>

    <!--    <a href="add_member.php">-->
    <!--        <div class="add-book-btn">-->
    <!--            افزودن کاربر-->
    <!--        </div>-->
    <!--    </a>-->

    <div class="books-list">
        <table>
            <tr>
                <th>شناسه</th>
                <th>نام</th>
                <th>نام خانوادگی</th>
                <th>نام کاربری</th>
                <th>مبلغ جریمه</th>


                <th>عملیات</th>
            </tr>
            <?php get_all_users();
            foreach ($members as $member) { ?>
                <tr>
                    <td><?= $member['mid'] ?></td>
                    <td><?= $member['name'] ?></td>
                    <td><?= $member['surname'] ?></td>
                    <td><?= $member['username'] ?></td>
                    <td><?php if ($member['fine'] > 0) {
                            echo number_format($member['fine']) . ' تومان ';
                        } else {
                            echo "ندارد";
                        } ?></td>


                    <td>
                        <form action="edit_member.php" method="POST">
                            <input type="hidden" value="<?= $member['mid'] ?>" name="member-id">
                            <button class="edit_delete_btn" name="edit_member"><img src="assets/img/edit.svg"
                                                                                    alt="ویرایش">
                            </button>
                        </form>
                        <?php if ($member['role'] == 1) { ?>

                            <form action="#" method="POST" id="delete_member_form"
                                  onsubmit="return confirm(`از حذف این کاربر اطمینان دارید؟`)">
                                <input type="hidden" value="<?= $member['mid'] ?>" name="member-id">
                                <button class="edit_delete_btn" name="delete_member"><img src="assets/img/delete.svg"
                                                                                          alt="حذف">
                                </button>
                            </form>
                        <?php } elseif ($member['role'] == 2) {
                            echo "[ یوزر ادمین ]";
                        } ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>