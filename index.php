<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP留言板</title>
</head>
<script>
    var xmlobj;
    var count=0;
    function createXMLHttpRequest(){
      if(window.ActiveXObject){
        xmlobj=new ActiveXObject("Microsoft.XMLHTTP");
      }
      else if(window.XMLHttpRequest){
        xmlobj=new XMLHttpRequest();
      }
    }
    function Autofresh(){
      createXMLHttpRequest();    
       count=count+1;    
      xmlobj.open("POST","display.php",true);
      xmlobj.onreadystatechange=doAjax;
      xmlobj.send("r="+Math.random());//使用随机数处理缓存
    }
    function doAjax(){
      if(xmlobj.readyState==4 && xmlobj.status==200){
        var display=document.getElementById('box');
        display.innerHTML=xmlobj.responseText;
        setTimeout("Autofresh()",1000);
      }
    }
    </script>
<body onLoad="Autofresh()">
    <?php
        $res = curl_file_get_contents("https://v1.hitokoto.cn/");
        $result = json_decode($res, true);
        function curl_file_get_contents($durl){  
        $ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL, $durl);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回    
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回    
        $r = curl_exec($ch);  
        curl_close($ch);  
        return $r;  
        } 
        ?>
        <link rel='stylesheet' type='text/css' href='style.css'>
        <div id='parent'>
            <h1>连接心灵，交流美好</h1>
            <h4>每日一言：<?php echo $result['hitokoto'];?> </h4>
            <form action='message.php' method='post' id='messageForm'>
            昵称：<input type='text' name='username'><br />
            留言内容：<textarea name='message' id='text' rows='1' cols='30'></textarea>
            <input id='btn' type='submit' value='发表留言' />
            </form>
            <div id='box'>
                <!--<em>-->
                <!--</em>-->
            </div>
        </div>
            <br />
</body>
</html>