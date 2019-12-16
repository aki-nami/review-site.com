<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>新規会員登録</title>
    </head>
    <body>
        <h1>新規会員登録フォーム</h1>
        <form id="loginForm" name="loginForm" method="post" action="form_end.php">
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
            <input type="submit" name="submit" value="送信">
        </form>
    </body>
</html>
