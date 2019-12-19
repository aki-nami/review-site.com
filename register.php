<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>新規会員登録</title>
    </head>
    <body>
        <h1>新規会員登録フォーム</h1>
        <font color="#ff0000"><?php if (!empty($_GET['msg'])) {
        echo $_GET['msg']; } ?>
        </font>
        <form id="loginForm" name="loginForm" method="post" action="register_end.php">
            <fieldset>
                <legend>新規登録フォーム</legend>
                <label for"userName">ユーザー名</label>
                <input type="text" id="userName" name="user_name" placeholder="ユーザー名を入力" value="<?php if (!empty($_GET['name'])) {
                echo $_GET['name']; } ?>">
                <br>
                <label for"mail">メールアドレス</label>
                <input type="text" id="mail" name="user_mail" placeholder="メールアドレスを入力" value ="<?php if (!empty($_GET['mail'])) {
                echo $_GET['mail']; } ?>">
                <br>
                <label for="password">パスワード</label>
                <input type="password" id="password" name="user_pass" placeholder="パスワードを入力">
                <input type="password" id="password" name="user_pass2" placeholder="もう一入度力">
                <br>
            </fieldset>
            <input type="submit" name="submit" value="送信">
            <a href="./login.php">ログインページへ</a>
        </form>
    </body>
</html>
