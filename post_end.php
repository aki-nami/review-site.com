<?php
session_start();
if (!empty($_POST['btn_submit'])) {
    $review = $_POST['review'];
}
try {
    $pdo = new PDO('mysql:dbname=mydb;host=localhost', 'root', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo 'データベースの接続に失敗しました';
    echo $e->getMessages;
}
$sql = 'insert into posts(post_comment, post_user_id, post_content_id, created_at, updated_at) values(:post_comment, :post_user_id, :post_content_id, now(), now())';
$data = $pdo->prepare($sql);
$params = array(':post_comment' => $review, ':post_user_id' => $_SESSION['user_id'], ':post_content_id' => $_SESSION['content_id']);
$box = $data->execute($params);
if ($box) {
    header('Location: ./post_end2.php');
} else {
    echo 'エラーが発生しました。投稿し直して下さい。';
}

?>
