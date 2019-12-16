<?php
include('lib/session.php');
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>作品投稿画面</title>
    </head>
    <body>
        <form action="content_up.php" method="post" enctype="multipart/form-data">
            <label for="name">投稿者</label><br>
            <?php
            if (isset($_SESSION['id'])) {
                echo $_SESSION['name']; 
            }
            ?>
            <label for="title">作品タイトル</label><br>
            <input type "text" id="title" name="title"><br>
            <label for="image">画像を選択</label><br>
            <input type="file" name="filename"><br>
            <input type="submit" value="アップロード">
        </form>
    </body>
</html>
