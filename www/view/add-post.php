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

if(!empty($_SESSION['admin'])){
    $msg_title = !empty($_SESSION['post_title_error']) ? $_SESSION['post_title_error'] : '';
    $title_val = !empty($_SESSION['post_title']) ? $_SESSION['post_title'] : '';

    $msg_desc = !empty($_SESSION['post_descr_error']) ? $_SESSION['post_descr_error'] : '';
    $desc_val = !empty($_SESSION['post_descr']) ? $_SESSION['post_descr'] : '';
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="/css/form.css">
    <a href="/index.php">main</a>
    <a href="/view/cabinet.php">cabinet</a>
    <a href="/handler/logout.php">logout</a>
    <form action="/handler/addPost.php?addPost" method="post">
        <p class="title">ADD POST</p>
        <div class="form-group">
            <input type="text" value="<?=$title_val?>" placeholder="Enter title" name="post_title">
            <p class="error"><?=$msg_title?></p>
        </div>
        <div class="form-group">
            <input type="text" value="<?=$desc_val?>" placeholder="Enter description" name="post_descr">
            <p class="error"><?=$msg_desc?></p>
        </div>
        <input type="submit" value="Add post">
    </form>


    <form action="/handler/addPost.php?changePost" method="post">
        <p style="margin-bottom: 10px; font-size: 14px; color: red;"><?=$_SESSION['unvalid_change']?></p>
        <?php
        foreach ($posts as $post){
            ?>
            <div class="form-group" style="margin-bottom: 20px;">
                <p class="hideBlock"><?=$post['post_title']?></p>
                <p class="hideBlock"><?=$post['post_desc']?></p>
                <input type="text" class="showBlock" name="post[<?=$post['post_id']?>][title]" placeholder="<?=$post['post_title']?>">
                <input type="text" class="showBlock" name="post[<?=$post['post_id']?>][desc]" placeholder="<?=$post['post_desc']?>">
                <p style="display: flex;flex-wrap: wrap"><input type="checkbox" name="delete_post[]" value="<?=$post['post_id']?>" style="width: auto"> DELETE</p>
            </div>
            <?php
        }
        ?>
        <input type="submit" value="Chenge posts">
    </form>
    <?php
}
else
{
    header('Location: /index.php');
    exit;
}
?>
<style>
   .showBlock{
       display: none;
   }
</style>
<script>
    $('.hideBlock').click( e => {
        const $this = $(e.currentTarget);
        $this.closest('.form-group').find('.hideBlock').hide();
        $this.closest('.form-group').find('.showBlock').show();
    })
</script>

