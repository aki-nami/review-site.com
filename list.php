<?php
include('../lib/db.php');
include('../lib/session.php');
Session::loginCheck();
define('COMMENTS_PER_PAGE', 5);

include('MySmarty.php');
$smarty = MySmarty::getSmarty();

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

$db = new DB();
$offset = COMMENTS_PER_PAGE * ($page - 1);
$sql = "select * from contents limit {$offset}, 5";
$contents = $db->fetchAll($sql);

$sql2 = ('select count(*) from contents');
$contents_count = $db->fetchColumn($sql2);
$total_pages = ceil($contents_count / COMMENTS_PER_PAGE);

$smarty->assign('contents', $contents)
    ->assign('total_pages', $total_pages)
    ->display('templates/list.tpl');

?>


