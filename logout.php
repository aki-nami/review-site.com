<?php
session_start();
session_destroy();
$msg = 'ログアウトしました';
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <?php
        echo $msg;
        ?>
        <a href="./index.php">TOPページへ</a>
    </body>
</html>
