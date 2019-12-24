<?php
include('../lib/db.php');
include('../lib/session.php');
Session::loginCheck();
define('COMMENTS_PER_PAGE', 5);
function h($s) {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

$id = $_GET['id'];
if (!empty($_GET['page'])) {
    $page = (int)$_GET['page'];
} else {
    $page = 1;
}

$db = new DB();
$offset = COMMENTS_PER_PAGE * ($page - 1);
$sql = "select post_id, post_comment, post_user_id, post_content_id, delete_flg, updated_at, user_id, user_name from posts inner join users on posts.post_user_id = users.user_id and posts.delete_flg = 0 where post_content_id = :id limit {$offset}, 5";
$params = array(':id' => $id);
$box1 = $db->fetchAll($sql, $params);

$page_sql = 'select count(*) from posts where post_content_id = :post_content_id and delete_flg = 0';
$page_params = array(':post_content_id' => $id);
//条件に一致するカラムを件数で取得
$total = $db->fetchColumn($page_sql, $page_params);
$total_pages = ceil($total / COMMENTS_PER_PAGE);

$content_sql = 'select content_id, content_title, content_file_name from contents where content_id = :id';
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
        <img src="<?php echo '/upload_image/' . $box['content_file_name']; ?>">
        <?php foreach($box1 as $value) : ?>
        <h4>
            名前：<?php echo $value['user_name']; ?>さん
            更新日：<?php echo $value['updated_at']; ?>
        </h4>
        <p>
            コメント：<?php echo h($value['post_comment']); ?>
        <?php if ($value['post_user_id'] == $_SESSION['user_id']) : ?>
        <a href="./delete.php?delete_id=<?php echo $value['post_id']; ?>&content_id=<?php echo $box['content_id']; ?>">削除</a>
        <?php endif; ?>
        </p>
        <?php endforeach; ?>
        <h3>レビューを投稿する</h3>
        <form action="./post_end.php" method="post">
            <input type="hidden" name="content_id" value="<?php echo $id; ?>">
            <textarea name="review" placeholder="レビューを記入して下さい"></textarea>
            <input type="submit" value="投稿する" name="btn_submit">
        </form>
        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
        <a href="?page=<?php echo $i; ?>&id=<?php echo $box['content_id']; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
        <a href="./list.php">一覧へ</a>
    </body>
</html>


