<?php
include('../lib/session.php');
Session::loginCheck();
define('COMMENTS_PER_PAGE', 5);

try {
    $pdo = new PDO('mysql:dbname=mydb;host=localhost', 'root', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo 'データベースの接続に失敗しました';
    echo $e->getMessages;
}

if (!empty($_GET['page'])) {
    $page = (int)$_GET['page'];
} else {
    $page = 1;
}

//select * from contents limit offset, count;
//page offset count
//1    0      5
//2    5      5
//3    10     5

$offset = COMMENTS_PER_PAGE * ($page - 1);
$sql = "select * from contents limit {$offset}, 5";
$contents = array();
foreach ($pdo->query($sql) as $row) {
    array_push($contents, $row);
}
$total = $pdo->query('select count(*) from contents')->fetchColumn();
$total_pages = ceil($total / COMMENTS_PER_PAGE);
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
                </tr>
            </thead>
            <tbody>
            <?php foreach ($contents as $value) : ?>
                <tr>
                    <td><?php echo $value['content_id']; ?></td>
                    <td><a href="post.php?id=<?php echo $value['content_id']; ?>"><?php echo $value['content_title']; ?></td>
                    <td><img src="<?php echo '/upload_image/' . $value['content_file_name']; ?>"></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
        <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
    </body>
</html>
