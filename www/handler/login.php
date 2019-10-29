<?php
session_start();


define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DATABASE', 'mybd');

$connect = mysqli_connect(HOST,USER,PASSWORD,DATABASE);

$first_name = !empty($_POST['name']) ? trim($_POST['name']) : '';
$reg_name =  '/^([а-яё\s]+|[a-z\s]+)$/iu';

$pass = !empty($_POST['pass']) ? $_POST['pass'] : '';


if(!empty($_POST['name']) && !empty($_POST['pass']) && strlen($_POST['pass']) > 3 && strlen($_POST['pass']) < 15 && !strpos($first_name, " ") && preg_match($reg_name, $first_name) && mb_strlen($first_name, 'utf-8') >= 4 && mb_strlen($first_name, 'utf-8') <= 15){

    $sql = "SELECT `user_name`, `user_id`, `status`, `pass` FROM `users` WHERE `user_name` = '{$first_name}'";
    $query = mysqli_query($connect, $sql);
    $data_user = mysqli_fetch_assoc($query);
    if($data_user == null || $data_user == false){
        $_SESSION['unvalid_data'] = 'Unvalid data';
        header('Location: /view/login.php');
        exit;
    }
    unset($_SESSION['valid_login']);

    if($data_user['user_name'] == $first_name && $data_user['pass'] == $pass){
        unset($_SESSION['unvalid_data']);
        $_SESSION['user_id'] = $data_user['user_id'];
        $_SESSION['admin'] = $data_user['status'];
        header('Location: /index.php');
        exit;
    }else{
        $_SESSION['unvalid_data'] = 'Unvalid data';
        header('Location: /view/login.php');
        exit;
    }



}else{
    unset($_SESSION['valid_login']);
    $_SESSION['unvalid_data'] = 'Unvalid data';
    header('Location: /view/login.php');
    exit;
}
?>


