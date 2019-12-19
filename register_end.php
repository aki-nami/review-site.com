<?php
$name = $_POST['user_name'];
$mail = $_POST['user_mail'];
$pass = $_POST['user_pass'];
$pass2 = $_POST['user_pass2'];

if (!empty($_POST['user_name']) && !empty($_POST['user_mail']) && !empty($_POST['user_pass']) && !empty($_POST['user_pass2'])) {
    if (!preg_match("/^[a-zA-Z0-9]+$/", $pass)) {
        $msg = 'パスワードは半角英数字で入力して下さい';
        header('Location: ./register.php?msg=' . $msg . '&name=' . $name . '&mail=' . $mail);
        exit();
    } elseif($pass != $pass2) {
        $msg = 'パスワードが一致しません。パスーワードを見直して下さい';
        header('Location: ./register.php?msg=' . $msg . '&name=' . $name . '&mail=' . $mail);
        exit();
    } else {
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        try {
            $pdo = new PDO('mysql:dbname=mydb;host=localhost', 'root', 'root');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo 'データベースの接続に失敗しました';
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
            header('Location: ./register.php?msg=' . $msg);
            exit();
        } else {
            $msg =  'このメールアドレスは既に使用されています';
            header('Location: ./register.php?msg=' . $msg . '&name=' . $name . '&mail=' . $mail);
            exit();
        }
    }
} else {
    $msg = '入力されていない項目があります';
    header('Location: ./register.php?msg=' . $msg . '&name=' . $name . '&mail=' . $mail);
    exit();
}
?>

