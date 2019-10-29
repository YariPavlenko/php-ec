<?php
session_start();
header('Content-Type: text/html; charset=utf-8');

define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DATABASE', 'mybd');

$connect = mysqli_connect(HOST,USER,PASSWORD,DATABASE);


//name
$first_name = !empty($_POST['first_name']) ? trim($_POST['first_name']) : '';
$reg_name =  '/^([а-яё\s]+|[a-z\s]+)$/iu';
//email
$email = !empty($_POST['email']) ? strtolower(trim($_POST['email'])) : '';
$reg_email = '/[0-9a-z]+@[a-z]+\.[0-9a-z\-.]+$/';
//tel
$telef = !empty($_POST['tel']) ? trim($_POST['tel']) : '';
$reg_telef = "/[^0-9]/";
//pass
$pass = !empty($_POST['password']) ? $_POST['password'] : '';
$conf_pass = !empty($_POST['password']) ? $_POST['password'] : '';


if(!empty($_POST['first_name']) && !strpos($first_name, " ") && preg_match($reg_name, $first_name) && mb_strlen($first_name, 'utf-8') >= 4 && mb_strlen($first_name, 'utf-8') <= 15) {
    $_SESSION['name'] = $first_name;
    unset($_SESSION['name_error']);
}
else {
    $_SESSION['name_error'] = "Name not valid";
    unset($_SESSION['name']);
}

if(!empty($_POST['password']) && strlen($_POST['password']) > 3 && strlen($_POST['password']) < 15){
    $_SESSION['password'] = $pass;
    unset($_SESSION['password_error']);
}
else {
    $_SESSION['password_error'] = "Password not valid";
    unset($_SESSION['password']);
}

if(!empty($_POST['confirm_password']) && $_POST['confirm_password'] == $_POST['password']){
    $_SESSION['conf_password'] = $pass;
    unset($_SESSION['conf_password_error']);
}
else {
    $_SESSION['conf_password_error'] = "Password have to the same";
    unset($_SESSION['conf_password']);
}

if(!empty($_POST['email']) && preg_match($reg_email, $email) ) {
    $_SESSION['email'] = $email;
    unset($_SESSION['email_error']);
}
else {
    $_SESSION['email_error'] = "Email not valid";
    unset($_SESSION['email']);
}

if(!empty($_POST['tel']) && preg_replace($reg_telef, '', $telef) && strlen($telef) > 3 && strlen($telef) < 12){
    $_SESSION['tel'] = $telef;
    unset($_SESSION['telef_error']);
}
else {
    $_SESSION['telef_error'] = "Telef have to be > 3 and < 12";
    unset($_SESSION['tel']);
}



if(!empty($_SESSION['name']) && !empty($_SESSION['email']) && (!empty($_SESSION['password']) && !empty($_SESSION['conf_password'])) && !empty($_SESSION['tel']) ){
    $sql = "UPDATE `users` SET `user_name` = '{$first_name}', `pass` = '{$pass}',  `tel` = '{$telef}', `email` = '{$email}' WHERE user_id = '{$_SESSION['user_id']}'";
    $query = mysqli_query($connect, $sql);
    unset($_SESSION['name']);
    unset($_SESSION['password']);
    unset($_SESSION['conf_password']);
    unset($_SESSION['email']);
    unset($_SESSION['tel']);

    header('Location: /index.php');
    exit;
}else{
    header('Location: /view/cabinet.php');
    exit;
}





?>




























<?php






$sql2 = "INSERT INTO users SET user_name='user3', password='password3'";
//mysqli_query($connect, $sql2);


$sql3 = "UPDATE users SET password='xxxx', WHERE user_name='user3'";
//mysqli_query($connect, $sql3);


for ($i = 3; $i <= 50; $i++){
    $ins="INSERT INTO users SET user_name='user".$i."',password='pass".$i."'";
//    mysqli_query($connect, $ins);
}
?>
