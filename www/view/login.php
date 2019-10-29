<?php
session_start();


if(!empty($_SESSION['user_id'])){
    header('Location: /index.php');
    exit;
}
else
{
    ?>
    <link rel="stylesheet" href="/css/form.css">
    <form action="/handler/login.php" method="post">
        <p class="title">LOGIN</p>
        <div class="form-group">
            <input type="text" name="name" placeholder="Enter name">
            <p class="error"><?=$_SESSION['unvalid_data']?></p>
        </div>
        <div class="form-group">
            <input type="password" name="pass" placeholder="Enter pass">
            <p class="error"></p>
        </div>
        <p style="margin-bottom: 20px;">Dont have an acc <a href="/view/registration.php">Registr</a></p>
        <input type="submit" value="Login">
    </form>
    <?php
}
?>


