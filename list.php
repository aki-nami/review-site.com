<?php
include('lib/session.php');
Session::loginCheck();

try {
    $pdo = new PDO('mysql:dbname=mydb;host=localhost', 'root', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo 'データベースの接続に失敗しました';
    echo $e->getMessages;
}
$sql = 'select * from contents';
$res = $pdo->query($sql);
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>一覧画面</title>
    </head>
    <body>
    <a href="./index.php">TOPページはこちら</a>
        <table border="3">
            <thead>
                <tr>
                    <th>id</th>
                    <th>タイトル</th>
                    <th>画像</th>
                    <th>投稿日</th>
                    <th>更新日</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($res as $value) : ?>
                <tr>
                    <td><?php echo $value['content_id']; ?></td>
                    <td><a href="post.php?id=<?php echo $value['content_id']; ?>"><?php echo $value['content_title']; ?></td>
                    <td><img src="<?php echo '/upload_image/' . $value['content_fileName']; ?>"></td>
                    <td><?php echo $value['created_at']; ?></td>
                    <td><?php echo $value['updated_at']; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </body>
</html>
