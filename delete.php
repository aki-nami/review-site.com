<?php
include('lib/db.php');
session_start();
$id = $_GET['delete_id'];
try {
    $pdo = new PDO('mysql:dbname=mydb;host=localhost', 'root', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo 'データベースの接続に失敗しました';
    echo $e->getMessages;
}
$sql = 'update posts set delete_flg = 1 where post_id = :post_id';
$data = $pdo->prepare($sql);
$params = array(':post_id' => $id);
$user = $data->execute($params);
if (!empty($user)) {
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
        <a href="./index.php">TOPへ戻る</a>
    </body>
</html>
