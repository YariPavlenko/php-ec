<?php
session_start();
if(!empty($_SESSION['user_id']))
{
    header('Location: /index.php');
}
else{
    $msg_name = !empty($_SESSION['name_error']) ? $_SESSION['name_error'] : '';
    $name_val = !empty($_SESSION['name']) ? $_SESSION['name'] : '';

    $msg_email = !empty($_SESSION['email_error']) ? $_SESSION['email_error'] : '';
    $email_val = !empty($_SESSION['email']) ? $_SESSION['email'] : '';

    $msg_telef = !empty($_SESSION['telef_error']) ? $_SESSION['telef_error'] : '';
    $telef_val = !empty($_SESSION['tel']) ? $_SESSION['tel'] : '';

    $msg_pass = !empty($_SESSION['password_error']) ? $_SESSION['password_error'] : '';
    $pass_val = !empty($_SESSION['password']) ? $_SESSION['password'] : '';

    $msg_conf_pass = !empty($_SESSION['conf_password_error']) ? $_SESSION['conf_password_error'] : '';
    $conf_pass_val = !empty($_SESSION['conf_password']) ? $_SESSION['conf_password'] : '';

    ?>

    <link rel="stylesheet" href="/css/form.css">
    <form action="/handler/registration.php" method="post">
        <p class="title">Registration</p>

        <p style="margin-bottom: 20px;"><?=$_SESSION['valid_login']?></p>
        <div class="form-group">
            <input type="text" value="<?=$name_val?>" name="first_name" placeholder="Enter name">
            <p class="error"><?=$msg_name?></p>
        </div>
        <div class="form-group">
            <input type="password" value="<?=$pass_val?>" name="password" placeholder="Enter password">
            <p class="error"><?=$msg_pass?></p>
        </div>
        <div class="form-group">
            <input type="password" value="<?=$conf_pass_val?>" name="confirm_password" placeholder="Confirm password">
            <p class="error"><?=$msg_conf_pass?></p>
        </div>
        <div class="form-group">
            <input type="email" value="<?=$email_val?>" name="email" placeholder="Enter email">
            <p class="error"><?=$msg_email?></p>
        </div>
        <div class="form-group">
            <input type="text" value="<?=$telef_val?>" name="tel" placeholder="Enter tel">
            <p class="error"><?=$msg_telef?></p>
        </div>
        <p style="margin-bottom: 20px;">U have acc? <a href="/view/login.php">Login</a></p>
        <input type="submit" value="Registration">
    </form>

    <?php
}
?>