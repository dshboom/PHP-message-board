<?php
    require_once "db_connect.php";
    $db = new datebaseConnection();
    $sql = "
    SELECT name, message, created_at FROM messages ORDER BY created_at DESC";
    $result = $db -> operateConnection($sql);
    if ($result-> num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $HTML = <<<HTML
<div id='message'>
<div id='name'>
昵称：<strong>{$row['name']}</strong>
</div>
<div id='time'>发布时间：{$row['created_at']}"
</div><br>{$row['message']}<br><br></div><br>
HTML;
            echo $HTML;
        }
    } else {
        echo "已经到底了<br>";
    }
?>