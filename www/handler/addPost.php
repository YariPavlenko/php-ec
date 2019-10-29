<?php
session_start();

define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DATABASE', 'mybd');

$connect = mysqli_connect(HOST, USER, PASSWORD, DATABASE);

if (isset($_GET['addPost'])) {
    $title = !empty($_POST['post_title']) ? trim($_POST['post_title']) : '';
    $descript = !empty($_POST['post_descr']) ? trim($_POST['post_descr']) : '';

    if (!empty($_POST['post_title']) && strlen($title) > 4 && strlen($title) < 30) {
        $_SESSION['post_title'] = $title;
        unset($_SESSION['post_title_error']);
    } else {
        $_SESSION['post_title_error'] = "Title have be > 4 and < 30";
        unset($_SESSION['post_title']);
    }

    if (!empty($_POST['post_descr']) && strlen($descript) > 10 && strlen($descript) < 50) {
        $_SESSION['post_descr'] = $title;
        unset($_SESSION['post_descr_error']);
    } else {
        $_SESSION['post_descr_error'] = "Description have be > 10 and < 50";
        unset($_SESSION['post_descr']);
    }


    if (!empty($_SESSION['post_title']) && !empty($_SESSION['post_descr'])) {
        $addPost = "INSERT INTO `posts` (`post_title`, `post_desc`) VALUES ('{$title}', '{$descript}')";
        $query = mysqli_query($connect, $addPost);
        unset($_SESSION['post_title']);
        unset($_SESSION['post_descr']);

        header('Location: /index.php');
        exit;
    } else {
        header('Location: /view/add-post.php');
        exit;

    }
} else if (isset($_GET['changePost'])) {
    if(!empty($_POST['delete_post'])){
        foreach ($_POST['delete_post'] as $post_id){
            $delete_post = "DELETE FROM `posts` WHERE `post_id`='{$post_id}'";
            $query_delete = mysqli_query($connect, $delete_post);
            unset($_POST['post'][$post_id]);
        }
    }

    $change_post = array();

    foreach ($_POST['post'] as $k => $post) {
        if (!empty($post['title']) || !empty($post['desc'])) {
            if (!empty($post['title']) && strlen($post['title']) <= 4 || strlen($post['title']) >= 30) {
                $_SESSION['unvalid_change'] = "Unvalid data";
                header('Location: /view/add-post.php');
                exit;
            }
            if (!empty($post['desc']) && strlen($post['desc']) <= 10 || strlen($post['desc']) >= 50) {
                $_SESSION['unvalid_change'] = "Unvalid data";
                header('Location: /view/add-post.php');
                exit;
            }

            array_push($change_post, $k);
        }
    }
    $sortArray = array_diff($change_post, $_POST['delete_post']);
    if (!empty($sortArray)) {
        foreach ($sortArray as $post_id){
            if(!empty($_POST['post'][$post_id]['title']) && !empty($_POST['post'][$post_id]['desc'])){
                $sql = "UPDATE `posts` SET post_title='{$_POST['post'][$post_id]['title']}', post_desc='{$_POST['post'][$post_id]['desc']}' WHERE post_id='{$post_id}'";
            }
            else if (!empty($_POST['post'][$post_id]['title']))
            {
                $sql = "UPDATE `posts` SET post_title='{$_POST['post'][$post_id]['title']}' WHERE post_id='{$post_id}'";
            }
            else
            {
                $sql = "UPDATE `posts` SET post_desc='{$_POST['post'][$post_id]['desc']}' WHERE post_id='{$post_id}'";
            }
            $query = mysqli_query($connect, $sql);
            unset($_SESSION['unvalid_change']);
        }
        header('Location: /view/add-post.php');
        exit;
    } else {
        header('Location: /view/add-post.php');
        exit;
    }
}
?>