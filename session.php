<?php
session_start();
if (!empty($_POST['mail']) && !empty($_POST['pass'])) {
    $mail = $_POST['mail'];
    $pass = $_POST['pass'];
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=mydb', 'root', 'root');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die('接続エラー :' . $e->getMessages());
    }
    $sql = 'select * from users where user_mail = :user_mail';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_mail', $mail, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!empty($user) && password_verify($pass, $user['user_pass'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_name'] = $user['user_name'];
        $msg = 'ログインしました';
    } else {
        $msg = 'メンバーが存在しません。メールアドレスとパスワードを確認して下さい。';
    }
} else {
    $msg =  '項目を全て入力して下さい';
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>ログイン結果</title>
    </head>
    <body>
        <h1>ログイン結果</h1>
        <?php
        if (isset($msg)) {
            echo $msg;
        }
        if (isset($_SESSION['user_id'])) : ?>
        <P><a href="./index.php">TOPページへ</a></p>
        <?php else : ?>
        <p><a href="./login.php">ログイン画面へ戻る</a></P>
        <?php endif; ?>
    </body>
</html>

