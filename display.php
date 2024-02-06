<?php
    require_once "db_connect.php";
    $result = mysqli_query($conn,"SELECT name, message, created_at FROM messages ORDER BY created_at DESC");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div id='message'><div id='name'>昵称：<strong>" . $row['name'] . "</strong></div><div id='time'>发布时间：" . $row['created_at'] . "</div><br>";
            echo $row['message'] . "<br><br></div><br>";
        }
    } else {
        echo "已经到底了<br>";
    }

?>
