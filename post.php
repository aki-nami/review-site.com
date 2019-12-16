<?php
include('lib/db.php');
include('lib/session.php');
Session::loginCheck();
function h($s) {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}
$id = $_GET['id'];
$_SESSION['content_id'] = $id;
$db = new DB();
$sql = 'select post_id, post_comment, post_user_id, post_content_id, delete_flg, updated_at, user_id, user_name from posts inner join users on posts.post_user_id = users.user_id and posts.delete_flg = 0 where post_content_id = :id';
$params = array(':id' => $id);
$box1 = $db->fetchAll($sql, $params);
$content_sql = 'select content_title, content_fileName from contents where content_id = :id';
$content_params = array(':id' => $id);
$box = $db->fetch($content_sql, $content_params);
?>


<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>レビュー投稿画面</title>
    </head>
    <body>
        <h1>レビュー投稿</h1>
        <h3><?php echo $box['content_title']; ?></h3>
        <img src="<?php echo '/upload_image/' . $box['content_fileName']; ?>">
        <?php foreach($box1 as $value) : ?>
        <h4>
            名前：<?php echo $value['user_name']; ?>さん
            更新日：<?php echo $value['updated_at']; ?>
        </h4>
        <p>
            コメント：<?php echo h($value['post_comment']); ?>
        <?php if ($value['post_user_id'] == $_SESSION['user_id']) : ?>
        <a href="./delete.php?delete_id=<?php echo$value['post_id']; ?>">削除</a>
        <?php endif; ?>
        </p>
        <?php endforeach; ?>
        <h3>レビューを投稿する</h3>
        <form action="./post_end.php" method="post">
            <textarea name="review" placeholder="レビューを記入して下さい"></textarea>
            <input type="submit" value="投稿する" name="btn_submit">
        </form>
    </body>
</html>


