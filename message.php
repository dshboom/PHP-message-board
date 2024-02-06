<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    require_once "db_connect.php";
    $username = $_POST['username'];
    $message = $_POST['message'];
    if ($username == "") {
        header("location:index.php");
    } else if ($message == "") {
        header("location:index.php");
    } else {
        $result = mysqli_query($conn, "INSERT INTO messages (name,message) VALUES ('$username','$message')");
        if ($result != 1) {
            echo "error:数据写入失败！";
            exit;
        }
        header("location:index.php");
    }
} else {
    header("location:index.php");
}
