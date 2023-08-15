<?php if (isset($_GET['cat_id'])) {
    $cat_id = $_GET['cat_id'];
    get_category_books($cat_id);
    ?>


    <h1 class="category_title"> دسته بندی : <?= get_category_name($cat_id) ?></h1>
    <div class="books-container">
        <?php
        foreach ($books as $book) { ?>
            <div class="book">
                <img alt="PHP book" src="assets/img/books/<?= $book['image'] ?>">
                <div class="book-title"><?= $book['book_name'] ?></div>
                <div class="book-category">دسته بندی:
                    <a class="cat-link" href="category.php?cat_id=<?= $book['category_id'] ?>">
                        <?= get_category_name($book['category_id']) ?>
                    </a>
                </div>
                <div class="book-count">موجودی کتابخانه: <?php if ($book['count'] > 0) {
                        echo $book['count'] . ' عدد ';
                    } else {
                        echo 'ناموجود';
                    } ?>
                </div>
                <div class="book-buttons">
                    <a class="more-info" href="book.php?bid=<?= $book['bid'] ?>">توضیحات بیشتر </a>
                    <!--            <a class="borrow">درخواست امانت گرفتن</a>-->
                </div>
            </div>
        <?php } ?>
    </div>

    <div class="more-books">
        <a class="library-button" href="library.php">برو به کتابخانه</a>
    </div>
<?php } else {
    header('Location:index.php');
} ?>