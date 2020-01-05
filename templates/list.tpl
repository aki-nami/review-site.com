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
            {foreach from=$contents item=content}
                <tr>
                    <td>{$content.content_id}</td>
                    <td><a href="post.php?id={$content.content_id}">{$content.content_title}</a></td>
                    <td><img src="/upload_image/{$content.content_file_name}"></td>
                </tr>
            {/foreach}
        </table>
        {for $i=1 to $total_pages}
            <a href="?page={$i}">{$i}</a>
        {/for}
    </body>
</html>
