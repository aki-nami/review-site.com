<?php
session_start();
$title = $_POST['title'];
try {
    $pdo = new PDO('mysql:host=localhost;dbname=mydb', 'root', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'データベースの接続に失敗しました';
    echo $e->getMessages();
}

$name = $_FILES['filename']['name'];
$type = $_FILES['filename']['type'];
$size = $_FILES['filename']['size'];
sys_get_temp_dir()."/".$name;
//一時的に保存されたファイル名を指定してサイズを取得
list($width, $hight) = getimagesize($_FILES['filename']['tmp_name']);
//一時的に保存された画像から新しい画像を作成する準備
$baseImage = imagecreatefromjpeg($_FILES['filename']['tmp_name']);
//サイズを指定しキャンパスを作成
$image = imagecreatetruecolor(200, 200);
imagecopyresampled($image, $baseImage, 0, 0, 0, 0, 200, 200, $width, $hight);

$dir = '/home/www/html/review-site.com/upload_image/';
//コピーした画像を出力
imagejpeg($image, $dir . 'thumbnail' . $name);
$path = $dir . 'thumbnail'. $name;
$newName = 'thumbnail' . $name;
if (!empty($name)) {
    $sql = 'insert into contents(content_title, content_file_name, content_image, content_type, content_size, content_user_id, created_at, updated_at) values(:content_title, :content_file_name, :content_image, :content_type, :content_size, :content_user_id, now(), now())';
    $data = $pdo->prepare($sql);
    $params = array(':content_title' => $title, 'content_file_name' => $newName, ':content_image' => $path, ':content_type' => $type, ':content_size' => $size, ':content_user_id' =>  $_SESSION['user_id']);
    $data->execute($params);
    $msg =  'アップロード完了';
} else {
    $msg =  'アップロード失敗';
}
?>

<!DOCTYPE html>
<html lang='ja'>
    <head>
        <meta charset='UTF-8'>
        <title>画像アップロードページ</title>
    </head>
    <body>
        <?php echo $msg; ?>
        <a href='./index.php'>一覧ページへ</a>
    </body>
</html>
