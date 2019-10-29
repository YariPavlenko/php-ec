<?php
session_start();
define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DATABASE', 'mybd');

$connect = mysqli_connect(HOST,USER,PASSWORD,DATABASE);
$sql = "SELECT * FROM `posts`";
$query = mysqli_query($connect, $sql);
while($res[] = mysqli_fetch_assoc($query)){
    $posts = $res;
}
if(!empty($_SESSION['user_id'])){
    ?>
    <a href="/view/cabinet.php">Cabinet</a>
    <a href="/handler/logout.php">Logout</a>
    <?php
    if(!empty($_SESSION['admin'])){
        ?>
        <a href="/view/add-post.php">Add post</a>
        <?php
    }
    ?>
    <div class="posts-wrapper" style="max-width: 1170px; margin: auto">
        <p class="title" style="text-align: center; font-size: 30px;">POSTS</p>
        <div class="posts-connect" style="display: flex; flex-wrap: wrap">
            <?php
            foreach ($posts as $post){
                ?>
                <div class="posts" style="flex: calc(100% / 5) 0 1; margin-bottom: 20px">
                    <div class="title"><?=$post['post_title']?></div>
                    <div class="descript"><?=$post['post_desc']?></div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
}else{
    ?>
    <a href="/view/login.php">Login</a>
    <a href="/view/registration.php">Registration</a>
    <?php
}
?>






