<?php
if (!empty($_POST['user_name']) && !empty($_POST['user_mail']) && !empty($_POST['user_pass'])) {
    $name = $_POST['user_name'];
    $mail = $_POST['user_mail'];
    $pass = $_POST['user_pass'];
    if (!preg_match("/^[a-zA-Z0-9]+$/", $pass)) {
        $msg = 'パスワードは半角英数字で入力して下さい';
    } else {
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        try {
            $pdo = new PDO('mysql:dbname=mydb;host=localhost', 'root', 'root');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            $msg =  'データベースの接続に失敗しました';
            echo $e->getMessages;
        }
        $sql = 'select * from users where user_mail = :user_mail limit 1';
        $data = $pdo->prepare($sql);
        $params = array(':user_mail' => $mail);
        $data->execute($params);
        $user = $data->fetch(PDO::FETCH_ASSOC);
        if (empty($user)) {
            $sql = 'insert into users(user_name, user_mail, user_pass) values(:user_name, :user_mail, :user_pass)';
            $data = $pdo->prepare($sql);
            $params = array(':user_name' => $name, ':user_mail' => $mail, ':user_pass' => $pass);
            $member = $data->execute($params);
            $msg = '登録が完了しました。';
        } else {
            $msg =  'このメールアドレスは既に使用されています';
        }
    }
} else {
    $msg = '送信内容に誤りがあります';
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>新規会員登録</title>
    </head>
    <body>
        <h1>新規会員登録フォーム</h1>
        <div><font color="#ff0000"><?php echo $msg; ?></font></div>
        <form id="loginForm" name="loginForm" method="post">
            <fieldset>
                <legend>新規登録フォーム</legend>
                <label for"userName">ユーザー名</label>
                <input type="text" id="userName" name="user_name" placeholder="ユーザー名を入力">
                <br>
                <label for"mail">メールアドレス</label>
                <input type="text" id="mail" name="user_mail" placeholder="メールアドレスを入力">
                <br>
                <label for="password">パスワード</label>
                <input type="text" id="password" name="user_pass" placeholder="パスワードを入力">
                <br>
            </fieldset>
            <input type="submit" name="signup" value="送信">
            <a href="./login.php">ログイン画面へ</a>
        </form>
    </body>
</html>

