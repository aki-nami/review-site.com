<?php
$id = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>投稿完了ページ</title>
    </head>
    <body>
        <h3>投稿が完了しました。</h3>
        <a href="./post.php?id=<?php echo $id; ?>">戻る</a>
    </body>
</html>




