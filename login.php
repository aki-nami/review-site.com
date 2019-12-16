<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <?php
    if (!isset($_SESSION['user_id']) && !isset($_SESSION['user_name'])) :
    ?>
    <title>ログイン</title>
</head>
<body>
    <h1>ログイン画面</h1>
    <form action="session.php" method="post">
        <p>メールアドレス</p>
        <input type="email" name="mail" placeholder="メールアドレスを入力">
        <p>パスワード</p>
        <input type="password" name="pass" placeholder="パスワードを入力">
        <p><button type="submit">ログイン</button></p>
    </form>
    <?php
    else :
    ?>
    <title>ログイン情報</title>
</head>
<body>
    <h1>ログイン状況</h1>
    <?php
    echo $_SESSION['user_name'] . 'さんはログイン中です';
    ?>
    <p><a href="logout.php">ログアウトする</a></p>
    <p><a href="index.php">TOPへ</a></p>
    <?php
    endif;
    ?>
</body>
</html>
