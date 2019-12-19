<?php
include('../lib/db.php');
session_start();
$id = $_GET['delete_id'];
$content_id = $_GET['content_id'];
try {
    $pdo = new PDO('mysql:dbname=mydb;host=localhost', 'root', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo 'データベースの接続に失敗しました';
    echo $e->getMessages;
}
$sql = 'select * from posts where post_id = :post_id';
$data = $pdo->prepare($sql);
$params = array(':post_id' => $id);
$data->execute($params);
$user = $data->fetch(PDO::FETCH_ASSOC);
if (!empty($user) && $_SESSION['user_id'] == $user['post_user_id']) {
    $sql = 'update posts set delete_flg = 1 where post_id = :post_id';
    $data = $pdo->prepare($sql);
    $params = array(':post_id' => $id);
    $data->execute($params);
    $msg = 'コメントを削除しました';
} else {
    $msg = 'コメントを削除できませんでした';
}
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>コメント削除画面</title>
    </head>
    <body>
        <?php echo $msg; ?>
        <a href="./post.php?id=<?php echo $content_id; ?>">戻る</a>
    </body>
</html>
