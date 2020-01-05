<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>投稿画面一覧画面</title>
    </head>
    <body>
        <h1>レビュー投稿</h1>
        <h3>{$contents.content_title}</h3>
        <img src="/upload_image/{$contents.content_file_name}">
        {foreach from=$posts item=post}
        <h4>
            名前：{$post.user_name}さん
            更新日：{$post.updated_at}
        </h4>
        <p>
            コメント：{$post.post_comment|escape:'htmlall'}
            {if $post.post_user_id == $smarty.session.user_id}
            <a href="./delete.php?delete_id={$post.post_id}&content_id={$contents.content_id}">削除</a>
            {/if}
        </p>
        {/foreach}
        <h3>レビューを投稿する</h3>
        <form action="./post_execute.php" method="post">
            <input type="hidden" name="content_id" value="{$id}">
            <textarea name="review" placeholder="レビューを記入して下さい"></textarea>
            <input type="submit" value="投稿する" name="btn_submit">
        </form>
        {for $i=1 to $total_pages}
            <a href="?id={$contents.content_id}&page={$i}">{$i}</a>
        {/for}
        <a href="./list.php">一覧へ</a>
    </body>
</html>
