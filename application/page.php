<?php
    /*
        本文件为Page 基类
    */
    abstract class Page
    {
        public $title = "";
        public $data = array();
        public $hitokoto = "";
        Public $time = "";
        public function __construct($title = "")
        {
            $this->title = $title;
        }
        public function displayHeader()
        {
        $html = <<<HTML
<header class="head">
<h1 class="title">倾诉所想 留下你的足迹</h1>
</header>
<body onLoad="Autofresh()">
HTML;
            echo $html;
        }
        public function getHitokoto()
        {
            $ch = curl_init();
            $url = "https://international.v1.hitokoto.cn/";
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 获取数据返回    
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, true); // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回    
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $res = curl_exec($ch);
            curl_close($ch);
            $result = json_decode($res, true);
            return $result;
        }
        public function displayBoard($hitokoto = "")
        {
            $html = <<<HTML
<div class="parent">
<div class="connect">
<h1>连接心灵，交流美好</h1>
<h4>每日一言：$hitokoto</h4>
<form action='./application/message.php' method='post' id='messageForm' onsubmit="return validataForm();">
<div class="dashed-border">
<div class="dashed-border-name">
<textarea placeholder="昵称" name='username' id='username'></textarea><span id="username-error" style="color: red;"></span><br />
</div>
<div class="dashed-border-say">
<textarea placeholder="说点什么…" name='message' id='text' rows='1' cols='30'></textarea>
<span id="text-error" style="color: red;"></span>
</div>
<input id='btn' type='submit' value='发表留言' />
</div>
</form>
<div id='box'>
</div>
</div>
</div>
HTML;
            echo $html;
        }
        public function displayFooter()
        {
            date_default_timezone_set("Asia/Shanghai");
            $time = date("Y - m - d:i:s:a",time());
            $html = <<<HTML
</body>
<footer class="foot">
<p>$time</p>
</footer>
HTML;
            echo $html;
        }
        public function display()
        {
        $html = <<<HTML
<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>$this->title</title>
<link rel="stylesheet" href="../public/style.css">
<script type="text/javascript" src="../public/ajax.js">
</script>
</head>
HTML;
            echo $html;
            $this -> displayHeader();
            $this -> hitokoto = $this->getHitokoto();
            $this -> displayBoard($this -> hitokoto["hitokoto"]);
            // $this -> displayFooter();
            $html = <<<HTML
</html>
HTML;
            echo $html;
        }
}
