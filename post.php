<?php
include('../lib/db.php');
include('../lib/session.php');
Session::loginCheck();
define('COMMENTS_PER_PAGE', 5);

include('MySmarty.php');
$smarty = MySmarty::getSmarty();
function h($s) {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

$id = $_GET['id'];
if (!empty($_GET['page'])) {
    $page = (int)$_GET['page'];
} else {
    $page = 1;
}

$db = new DB();
$offset = COMMENTS_PER_PAGE * ($page - 1);
$sql = "select post_id, post_comment, post_user_id, post_content_id, delete_flg, updated_at, user_id, user_name from posts inner join users on posts.post_user_id = users.user_id and posts.delete_flg = 0 where post_content_id = :id limit {$offset}, 5";
$params = array(':id' => $id);
$posts = $db->fetchAll($sql, $params);

$page_sql = 'select count(*) from posts where post_content_id = :post_content_id and delete_flg = 0';
$page_params = array(':post_content_id' => $id);
//条件に一致するカラムを件数で取得
$total = $db->fetchColumn($page_sql, $page_params);
$total_pages = ceil($total / COMMENTS_PER_PAGE);

$content_sql = 'select content_id, content_title, content_file_name from contents where content_id = :id';
$content_params = array(':id' => $id);
$contents = $db->fetch($content_sql, $content_params);

$smarty->assign('posts', $posts)
    ->assign('total_pages', $total_pages)
    ->assign('contents', $contents)
    ->assign('id', $id)
    ->display('templates/post.tpl');
?>

