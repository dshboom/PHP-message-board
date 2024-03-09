<?php

class Message
{
    public $username;
    public $message;
    public $db;

    public function __construct(){}

    public function push($username, $message)
    {
        require_once "db_connect.php";
        $db = new datebaseConnection();
        $sql = "
        INSERT INTO messages (name,message) VALUES ('$username','$message');
        ";
        $result = $db -> operateConnection($sql);
        if (!$result) {
            echo "error:数据写入失败！";
            exit;
        }
        $db -> closeConnection();
    }
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $username = $_POST['username'];
    $message = $_POST['message'];
    if($username != "" && $message != "")
    {
        $push = new Message();
        $push -> push($username, $message);
        header("location:../index.php");
    }
    else
    {
        header("location:../index.php");
    }
}
else 
{
    header("location:../index.php");
}
?>
