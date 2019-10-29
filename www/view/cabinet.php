<?php
session_start();

define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DATABASE', 'mybd');
$connect = mysqli_connect(HOST,USER,PASSWORD,DATABASE);



$msg_name = !empty($_SESSION['name_error']) ? $_SESSION['name_error'] : '';

$msg_email = !empty($_SESSION['email_error']) ? $_SESSION['email_error'] : '';

$msg_telef = !empty($_SESSION['telef_error']) ? $_SESSION['telef_error'] : '';

$msg_pass = !empty($_SESSION['password_error']) ? $_SESSION['password_error'] : '';

$msg_conf_pass = !empty($_SESSION['conf_password_error']) ? $_SESSION['conf_password_error'] : '';



if(!empty($_SESSION['user_id']))
{
    $sql = "SELECT * FROM `users` WHERE `user_id` =" . $_SESSION['user_id'];
    $query = mysqli_query($connect, $sql);
    while($res[] = mysqli_fetch_assoc($query)){
        $user_data = $res;
    }
    ?>
    <link rel="stylesheet" href="/css/form.css">
    <a href="/index.php">Main</a>
    <?php
    if(!empty($_SESSION['admin'])){
        ?>
        <a href="/view/add-post.php">Add post</a>
        <?php
    }
    ?>
    <a href="/handler/logout.php">Logout</a>
    <form action="/handler/changeData.php" method="post">
        <p class="title">CABINET</p>
        <div class="form-group">
            <input type="text" value="<?=$user_data[0]['user_name']?>" name="first_name" placeholder="Enter name">
            <p class="error"><?=$msg_name?></p>
        </div>
        <div class="form-group">
            <input type="password" value="<?=$user_data[0]['pass']?>" name="password" placeholder="Enter password">
            <p class="error"><?=$msg_pass?></p>
        </div>
        <div class="form-group">
            <input type="password" name="confirm_password" placeholder="Confirm pass">
            <p class="error"><?=$msg_conf_pass?></p>
        </div>
        <div class="form-group">
            <input type="email" value="<?=$user_data[0]['email']?>" name="email" placeholder="Enter email">
            <p class="error"><?=$msg_email?></p>
        </div>
        <div class="form-group">
            <input type="text" value="<?=$user_data[0]['tel']?>" name="tel" placeholder="Enter tel">
            <p class="error"><?=$msg_telef?></p>
        </div>
        <input type="submit" value="Change Data">
    </form>
    <?php

}
else
{
    header('Location: /view/login.php');
    exit;
}
?>


