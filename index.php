<?php
    require_once './application/page.php'; 
    require_once './application/db_table.php';
    class MyPage extends Page {
    }
    $page = new MyPage('默念心中的问题 追寻心中的答案');
    $page->display();
?>