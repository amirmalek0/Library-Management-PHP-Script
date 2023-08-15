<?php
// JUST EDIT THIS PART
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'lib';
$site_URL = "http://localhost/lib";
// JUST EDIT THIS PART

$conn = mysqli_connect($host, $user, $pass, $db);
ob_start();
session_start();

function site_url()
{
    global $site_URL;
    return $site_URL;
}

function get_books_list($page)
{
    global $conn, $books, $books_per_page;
    $books_per_page = 3;
    $offset = ($page - 1) * $books_per_page;
    $query = "SELECT * FROM `books` ORDER BY date DESC LIMIT $books_per_page OFFSET $offset";
    $result = mysqli_query($conn, $query);
    $books = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if ($books) {
        return $books;
    }
    return false;
}

function book_pages()
{
    global $conn, $books_per_page;
    $query = "SELECT * FROM `books`";
    $result = mysqli_query($conn, $query);
    $books = mysqli_num_rows($result);
    return ceil($books / $books_per_page);
}

function get_book_info($bid)
{
    global $conn, $book;
    $query = "SELECT * FROM `books` WHERE bid='$bid'";
    $result = mysqli_query($conn, $query);
    $book = mysqli_fetch_assoc($result);
    if ($book) {
        return true;
    }
    return false;
}

function get_category_name($cat_id)
{
    global $conn;
    $query = "SELECT * FROM `categories` WHERE cat_id='$cat_id'";
    $result = mysqli_query($conn, $query);
    $category = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($category) {
        return $category['cat_name'];
    }
    return false;
}

function get_categories()
{
    global $conn, $cats;
    $query = "SELECT * FROM `categories` ORDER BY date DESC";
    $result = mysqli_query($conn, $query);
    $cats = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function get_category_books($cat_id)
{
    global $conn, $books;
    $query = "SELECT * FROM `books` where category_id ='$cat_id'";
    $result = mysqli_query($conn, $query);
    $books = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if ($books) {
        return $books;
    }
    return false;
}

function search($search)
{
    global $conn, $books;
    $query = "SELECT * FROM `books` WHERE `book_name` LIKE '%$search%'";
    $result = mysqli_query($conn, $query);
    $books = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if ($books) {
        return $books;
    }
    return false;
}

function get_uid_by_username($username)
{
    global $conn;
    $query = "SELECT * FROM `members` where username = '$username'";
    $result = mysqli_query($conn, $query);
    $uid = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($uid) {
        return $uid['mid'];
    }
    return false;
}

function login()
{
    if (isset($_POST['Login'])) {
        global $conn;
        $user = $_POST['username'];
        $pass = md5($_POST['password']);
        $query = "SELECT * FROM `members` where username = '$user' AND password = '$pass'";
        $result = mysqli_query($conn, $query);
        $userx = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $rowcount = mysqli_num_rows($result);
        if ($rowcount == 1) {
            if (isset($_POST['remember-me'])) {
                setcookie("x", str_rot13(base64_encode($user)), strtotime('+30 days'));
                setcookie("y", str_rot13(base64_encode($_POST['password'])), strtotime('+30 days'));
            }
            $_SESSION['userid'] = get_uid_by_username($user);
            if ($userx['role'] == 1) {
                header("Location:my-account.php");
            } elseif ($userx['role'] == 2) {
                header("Location:/lib/admin");
            }
        } else {
            echo '<script>alert("no")</script>';
        }
    }
}

function is_logged_in()
{
    if (isset($_SESSION['userid'])) {
        return true;
    }
    return false;
}

function logout()
{
    session_unset();
    session_destroy();
    header("Location:index.php");
}

function get_user_info()
{
    global $conn, $user;
    if (isset($_SESSION['userid'])) {
        $mid = $_SESSION['userid'];
        $query = "SELECT * FROM `members` WHERE mid= $mid";
        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if ($user) {
            return $user;
        }
    }
    return false;
}

function signup()
{
    global $conn;
    if (isset($_POST['Signup'])) {
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $mid = rand(1, 9999);
        $role = 1; // simple user
        $fine = 0;
        $query = "INSERT INTO `members`(`mid`, `name`, `surname`, `username`, `password`, `fine`, `role`) VALUES ('$mid','$name','$surname','$username','$password','$fine','$role')";
        mysqli_query($conn, $query);
        $result = mysqli_affected_rows($conn);
        if ($result == 1) {
            $_SESSION['userid'] = $mid;
            header("Location:my-account.php");
        }
    }
    return false;
}

function edit_account_info()
{
    global $conn;
}

if (isset($_POST['edit-account-info'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $mid = $_POST['mid'];
    if (!empty($_POST['new-password'])) {
        $new_pass = md5($_POST['new-password']);
        $query = "UPDATE `members` SET `name`='$name',`surname`='$surname',`password` = '$new_pass' WHERE mid ='$mid'";
        mysqli_query($conn, $query);
        $result = mysqli_affected_rows($conn);
        if ($result == 1) {
            header("Location:account-info.php?edit=ok");
        }
    } else {
        $query = "UPDATE `members` SET `name`='$name',`surname`='$surname' WHERE mid ='$mid'";
        mysqli_query($conn, $query);
        $result = mysqli_affected_rows($conn);
        if ($result == 1) {
            header("Location:account-info.php?edit=ok");
        }
    }
    return false;
}

function get_tickets($userid)
{
    global $conn, $tickets;
    $query = "SELECT * FROM `tickets` WHERE user_id='$userid' ORDER BY date DESC";
    $result = mysqli_query($conn, $query);
    $tickets = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if ($tickets) {
        return $tickets;
    }
    return false;
}

function submit_ticket($userid)
{
    global $conn;
    if (isset($_POST['submit_ticket'])) {
        $ticket_id = rand(1, 99999);
        $ticket_title = $_POST['ticket-title'];
        $ticket_desc = $_POST['ticket-desc'];
        $date = date('Y-m-d H:i:s');
        $query = "INSERT INTO `tickets`(`ticket_id`, `ticket_title`, `ticket_description`, `user_id`, `date`) VALUES ('$ticket_id','$ticket_title','$ticket_desc','$userid','$date')";
        mysqli_query($conn, $query);
        $result = mysqli_affected_rows($conn);
        if ($result == 1) {
            header('Location:tickets.php?add=ok');
        }

    }
}

function get_ticket_detail($ticket_id)
{
    global $conn, $ticket;
    $query = "SELECT * FROM `tickets` WHERE ticket_id = '$ticket_id'";
    $result = mysqli_query($conn, $query);
    $ticket = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($ticket) {
        return $ticket;
    }
    return false;
}

function get_replies($ticket_id)
{
    global $conn, $replies;
    $query = "SELECT * FROM `ticket_replies` WHERE ticket_id='$ticket_id' ORDER BY date ASC ";
    $result = mysqli_query($conn, $query);
    $replies = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if ($replies) {
        return $replies;
    }
    return false;
}

function submit_reply()
{
    global $conn;
    if (isset($_POST['submit_reply'])) {
        $reply = $_POST['ticket-reply'];
        $reply_id = rand(1, 9999);
        $ticket_id = $_POST['ticket-id'];
        $type = 'user';
        $date = date('Y-m-d H:i:s');
        $query = "INSERT INTO `ticket_replies`(`reply_id`, `reply_description`, `ticket_id`, `type`, `date`) VALUES ('$reply_id','$reply','$ticket_id','$type','$date')";
        mysqli_query($conn, $query);
        $result = mysqli_affected_rows($conn);
        if ($result == 1) {
            return true;
        }
    }
    return false;
}

function submit_borrow_request()
{
    global $conn;
    if (isset($_POST['request_borrow'])) {
        $rid = rand(1, 9999);
        $mid = $_POST['uid'];
        $book_id = $_POST['bid'];
        $duration = $_POST['days'];
        $status = 1; // pending verification
        $date = date('Y-m-d H:i:s');
        $fine = 0;
        $query = "INSERT INTO `reservations`(`rid`, `user_id`, `book_id`, `duration`, `status`, `date` ,`fine`) VALUES ('$rid','$mid','$book_id','$duration','$status','$date','$fine')";
        mysqli_query($conn, $query);
        $result = mysqli_affected_rows($conn);
        if ($result == 1) {
            return true;
        }
    }
    return false;

}

function reservation_exists($user_id, $book_id)
{
    global $conn, $reservation;
    $query = "SELECT * FROM `reservations` WHERE user_id = '$user_id' AND book_id='$book_id' AND status !=3";
    $result = mysqli_query($conn, $query);
    $reservation = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($reservation) {
        return $reservation;
    }
    return false;
}

function update_fine($reservation_id, $fine)
{
    global $conn;
    $query = "UPDATE `reservations` SET `fine`='$fine' WHERE rid='$reservation_id'";
    mysqli_query($conn, $query);
    $result = mysqli_affected_rows($conn);
    if ($result == 1) {
        return true;
    }
    return false;
}

function calculate_user_fine($user_id)
{
    global $conn, $fine;
    $query = "SELECT sum(fine) FROM `reservations` WHERE user_id='$user_id'";
    $result = mysqli_query($conn, $query);
    $total_fine = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $fine = $total_fine['sum(fine)'];
    return $fine;
}

function insert_user_fines($user_id)
{
    global $conn, $fine;
    $query = "UPDATE `members` SET `fine`='$fine' WHERE mid='$user_id'";
    mysqli_query($conn, $query);
    $result = mysqli_affected_rows($conn);
    if ($result) {
        return true;
    }
    return false;
}

if (isset($_SESSION['userid'])) {
    calculate_user_fine($_SESSION['userid']);
    insert_user_fines($_SESSION['userid']);
}
function have_fine($user_id)
{
    global $conn;
    $query = "SELECT `fine` FROM `members` WHERE mid='$user_id'";
    $result = mysqli_query($conn, $query);
    $fine = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $user_fine = $fine['fine'];
    if ($user_fine > 0) {
        return true;
    }
    return false;
}

function book_name($book_id)
{
    global $conn, $book;
    $query = "SELECT * FROM `books` WHERE bid='$book_id'";
    $result = mysqli_query($conn, $query);
    $book = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($book) {
        return $book['book_name'];
    }
    return false;
}

function book_img($book_id)
{
    global $conn, $book;
    $query = "SELECT * FROM `books` WHERE bid='$book_id'";
    $result = mysqli_query($conn, $query);
    $book = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($book) {
        return $book['image'];
    }
    return false;
}

function get_reserved_books($user_id)
{
    global $conn, $reservations;
    $query = "SELECT * FROM `reservations` WHERE user_id='$user_id' ORDER BY date desc";
    $result = mysqli_query($conn, $query);
    $reservations = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if ($reservations) {
        return $reservations;
    }
    return false;
}

function return_date()
{
    global $return_date, $reservation;
    $days = $reservation['duration'];
    $reservation_date = $reservation['date'];
    $return_days = strtotime("+$days days", strtotime($reservation_date));
    $now = strtotime("now");
    $return_date = ceil(($return_days - $now) / (60 * 60 * 24));
    return $return_date;
}

function book_exists($book_id)
{
    global $conn;
    $query = "SELECT * FROM `books` WHERE bid='$book_id'";
    $result = mysqli_query($conn, $query);
    $book = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($book['count'] > 0) {
        return true;
    }
    return false;
}

function get_option($name)
{
    global $conn, $option;
    $query = "SELECT * FROM `options` where option_name='$name'";
    $result = mysqli_query($conn, $query);
    $option = mysqli_fetch_array($result, MYSQLI_ASSOC);
    return $option['option_value'];
}
