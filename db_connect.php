<?php
$servername = "localhost";
$username = "yourname";
$password = "yourpasswd";
$database = "yourdbname";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("连接数据库失败: " . $conn->connect_error);
} 
// 使用 sql 创建数据表
$sql = 
"
CREATE TABLE IF NOT EXISTS messages (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);";
if ($conn->query($sql) == 0) 
{
    die("创建数据表错误: " . $conn->error);
}
?>