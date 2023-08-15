<?php
include "jdf.php";

// JUST EDIT THIS PART
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'lib';
$site_URL = "http://localhost/lib";
// JUST EDIT THIS PART

$conn = mysqli_connect($host, $user, $pass, $db);
session_start();
const IMG_PATH = "../assets/img/books/";
function siteurl()
{
    global $site_URL;
    return $site_URL;
}

function get_books()
{
    global $conn, $books;
    $query = "SELECT * FROM `books` ORDER BY `date` DESC ";
    $result = mysqli_query($conn, $query);
    $books = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function get_available_books()
{
    global $conn, $books;
    $query = "SELECT * FROM `books` where `count` > 0";
    $result = mysqli_query($conn, $query);
    $books = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function is_admin($userid)
{
    global $conn;
    $query = "SELECT * FROM `members` WHERE mid='$userid'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($user['role'] == 2) {
        return true;
    }
    return false;
}

function logout()
{
    session_unset();
    session_destroy();
    header("Location:/lib");
}

function is_logged_in()
{
    if (isset($_SESSION['userid']) && is_admin($_SESSION['userid'])) {
        return true;
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

function add_book()
{
    global $conn;
    if (isset($_POST['add_book'])) {
        $target_dir = "../assets/img/books/";
        $rand = rand(1, 99999) . '-';
        $target_file = $target_dir . $rand . basename($_FILES["BookImage"]["name"]);
        move_uploaded_file($_FILES["BookImage"]["tmp_name"], $target_file);
        $book_image = $rand . $_FILES["BookImage"]["name"];
        $book_id = $_POST['BookISBN'];
        $book_name = $_POST['BookName'];
        $book_cat = $_POST['BookCategory'];
        $book_author = $_POST['Author'];
        $book_publish_year = $_POST['PublishYear'];
        $book_count = $_POST['BookCount'];
        $book_desc = $_POST['Description'];
        $publisher = $_POST['Publisher'];
        $date = date('Y-m-d H:i:s');
        if (!empty($book_id) && !empty($book_name) && !empty($book_author) && !empty($book_publish_year) && !empty($book_count) && !empty($book_desc) && !empty($publisher)) {
            $query = "INSERT INTO `books`(`bid`, `book_name`, `publish_year`, `publisher`, `category_id`, `author`, `description`, `count`, `image`,`date`) VALUES ('$book_id','$book_name','$book_publish_year','$publisher','$book_cat','$book_author','$book_desc','$book_count','$book_image','$date')";
            mysqli_query($conn, $query);
            $result = mysqli_affected_rows($conn);
            if ($result == 1) {
                return true;
            }
        } else {
            header("Location:add_book.php?blank_inputs");
        }
    }
    return false;
}

function get_book_data($book_id)
{
    global $conn, $book;
    $query = "SELECT * FROM `books` WHERE bid='$book_id'";
    $result = mysqli_query($conn, $query);
    return $book = mysqli_fetch_array($result, MYSQLI_ASSOC);
}

function edit_book()
{
    global $conn;
    if (isset($_POST['edit_book'])) {
        if (isset($_FILES['BookImage']) && !empty($_FILES['BookImage']["name"])) {
            $target_dir = "../assets/img/books/";
            $rand = rand(1, 99999) . '-';
            $target_file = $target_dir . $rand . basename($_FILES["BookImage"]["name"]);
            move_uploaded_file($_FILES["BookImage"]["tmp_name"], $target_file);
            $book_image = $rand . $_FILES["BookImage"]["name"];
        } else {
            $book_image = $_POST['book_image'];
        }
        $book_id = $_POST['BookISBN'];
        $book_name = $_POST['BookName'];
        $book_cat = $_POST['BookCategory'];
        $book_author = $_POST['Author'];
        $book_publish_year = $_POST['PublishYear'];
        $book_count = $_POST['BookCount'];
        $book_desc = $_POST['Description'];
        $publisher = $_POST['Publisher'];
        $query = "UPDATE `books` SET `book_name`='$book_name',`publish_year`='$book_publish_year',`publisher`='$publisher',`category_id`='$book_cat',`author`='$book_author',`description`='$book_desc',`count`='$book_count',`image`='$book_image' WHERE bid ='$book_id'";
        mysqli_query($conn, $query);
        $result = mysqli_affected_rows($conn);
        if ($result == 1) {
            return true;
        }
    }
    return false;
}

function delete_book($book_id)
{
    global $conn;
    $query = "DELETE FROM `books` WHERE `bid` = '$book_id'";
    mysqli_query($conn, $query);
    if (mysqli_affected_rows($conn)) {
        return true;
    }
    return false;
}

function add_category()
{
    global $conn;
    if (isset($_POST['add_category'])) {
        $cat_id = $_POST['CatId'];
        $cat_name = $_POST['CatName'];
        $date = date('Y-m-d H:i:s');
        $query = "INSERT INTO `categories`(`cat_id`, `cat_name`,`date`) VALUES ('$cat_id','$cat_name','$date')";
        mysqli_query($conn, $query);
        $result = mysqli_affected_rows($conn);
        if ($result == 1) {
            return true;
        }
    }
    return false;
}

function update_category()
{
    global $conn;
    if (isset($_POST['edit_category'])) {
        $cat_name = $_POST['CatName'];
        $cat_id = $_POST['CatId'];
        $query = "UPDATE `categories` SET `cat_name`='$cat_name' WHERE cat_id = '$cat_id'";
        mysqli_query($conn, $query);
        $result = mysqli_affected_rows($conn);
        if ($result == 1) {
            return true;
        }
    }
    return false;
}

function delete_category($cat_id)
{
    global $conn;
    $query = "DELETE FROM `categories` WHERE `cat_id` = '$cat_id'";
    mysqli_query($conn, $query);
    if (mysqli_affected_rows($conn)) {
        return true;
    }
    return false;
}

function get_tickets()
{
    global $conn, $tickets;
    $query = "SELECT * FROM `tickets` ORDER BY date DESC";
    $result = mysqli_query($conn, $query);
    $tickets = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if ($tickets) {
        return $tickets;
    }
    return false;
}

function get_user_name($user_id)
{
    global $conn, $user;

    $query = "SELECT * FROM `members` WHERE mid= '$user_id'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
//    var_dump($user);

    if ($user) {
        return $user['name'] . " " . $user['surname'];
    }
    return false;
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
        $type = 'admin';
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

function delete_ticket($ticket_id)
{
    global $conn;
    $query = "DELETE FROM `tickets` WHERE ticket_id='$ticket_id';DELETE FROM `ticket_replies` WHERE ticket_id='$ticket_id'";
    mysqli_multi_query($conn, $query);
    if (mysqli_affected_rows($conn) == 1) {
        return true;
    }

    return false;
}

function get_all_users()
{
    global $conn, $members;
    $query = "SELECT * FROM `members`";
    $result = mysqli_query($conn, $query);
    $members = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if ($members) {
        return $members;
    }
    return false;
}

function get_user_info($user_id)
{
    global $conn, $user;
    $query = "SELECT * FROM `members` WHERE mid= '$user_id'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($user) {
        return $user;
    }
    return false;
}

function edit_user()
{
    global $conn;
    if (isset($_POST['edit_user'])) {
        $mid = $_POST['mid'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $username = $_POST['username'];
        $role = $_POST['role'];
        $query = "UPDATE `members` SET `name`='$name',`surname`='$surname',`username`='$username',`role`='$role' WHERE mid='$mid'";
        mysqli_query($conn, $query);
        $result = mysqli_affected_rows($conn);
        if ($result == 1) {
            return true;
        }
    }
    return false;
}

function delete_user($user_id)
{
    global $conn;
    $query = "DELETE FROM `members` where mid='$user_id'";
    mysqli_query($conn, $query);
    $result = mysqli_affected_rows($conn);
    if ($result == 1) {
        return true;
    }
    return false;
}

function get_reservations()
{
    global $conn, $reservations;
    $query = "SELECT * FROM `reservations` ORDER BY date DESC";
    $result = mysqli_query($conn, $query);
    $reservations = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if ($reservations) {
        return $reservations;
    }
    return false;
}

function get_reservations_by_user()
{
    global $conn, $reservations, $userid;
    if (isset($_GET["uid"])) {
        $userid = $_GET['uid'];
        $query = "SELECT * FROM `reservations` WHERE user_id= '$userid' ORDER BY date DESC";
        $result = mysqli_query($conn, $query);
        $reservations = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if ($reservations) {
            return $reservations;
        }
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


function confirm_reservation()
{
    global $conn;
    if (isset($_POST['confirm-res'])) {
        $rid = $_POST['rid'];
        $book_id = $_POST['bid'];
        $date = date('Y-m-d H:i:s');
        $query = "UPDATE `reservations` SET `status`='2',`date`='$date' WHERE rid='$rid'; UPDATE `books` SET count = count - 1 WHERE bid = '$book_id'";
        mysqli_multi_query($conn, $query);
        if (mysqli_affected_rows($conn) == 1) {
            return true;
        }
    }
    return false;
}

function return_book()
{
    global $conn;
    if (isset($_POST['return-book'])) {
        $rid = $_POST['rid'];
        $book_id = $_POST['bid'];
        $query = "UPDATE `reservations` SET `status`='3',`fine`= 0 WHERE rid='$rid'; UPDATE `books` SET count = count + 1 WHERE bid = '$book_id'";
        mysqli_multi_query($conn, $query);
        if (mysqli_affected_rows($conn) == 1) {
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
        $mid = $_POST['user'];
        $book_id = $_POST['book'];
        $duration = $_POST['duration'];
        $status = 2; // Vetified
        $date = date('Y-m-d H:i:s');
        $fine = 0;
        $query = "INSERT INTO `reservations`(`rid`, `user_id`, `book_id`, `duration`, `status`, `date` ,`fine`) VALUES ('$rid','$mid','$book_id','$duration','$status','$date','$fine'); UPDATE `books` SET count = count - 1 WHERE bid = '$book_id'";
        mysqli_multi_query($conn, $query);
        if (mysqli_affected_rows($conn) == 1) {
            return true;
        }
    }
    return false;

}

function get_options()
{
    global $conn;
    $query = "SELECT * FROM `options`";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function update_options()
{
    global $conn;
    if (isset($_POST['UpdateOptions'])) {
        $fine = $_POST['fine'];
        $durations = $_POST['durations'];
        $query = "UPDATE `options` SET `option_value`='$fine' WHERE `option_name` = 'fine';UPDATE `options` SET `option_value`='$durations' WHERE `option_name` = 'durations'";
        mysqli_multi_query($conn, $query);
        if (mysqli_affected_rows($conn) == 1) {
            return true;
        }
    }
    return false;
}