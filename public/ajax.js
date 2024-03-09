var xmlobj;
var count = 0;
function createXMLHttpRequest() {
    if (window.ActiveXObject) {
        xmlobj = new ActiveXObject("Microsoft.XMLHTTP");
    } else if (window.XMLHttpRequest) {
        xmlobj = new XMLHttpRequest();
    }
}

function Autofresh() {
    createXMLHttpRequest();
    count = count + 1;
    xmlobj.open("POST", "./application/display.php", true);
    xmlobj.onreadystatechange = doAjax;
    xmlobj.send("r=" + Math.random()); //使用随机数处理缓存
}

function doAjax() {
    if (xmlobj.readyState == 4 && xmlobj.status == 200) {
        var display = document.getElementById('box');
        display.innerHTML = xmlobj.responseText;
        setTimeout("Autofresh()", 5000);
    }
}
var askButton = document.getElementById('askButton');
askButton.addEventListener('click', function() {
    window.location.href = 'ask.php';
});

function validataForm() {
    var username = document.getElementById("username").value;
    var text = document.getElementById("text").value;
    var errorSpan_username = document.getElementById("username-error");
    var errorSpan_text = document.getElementById("text-error");
    errorSpan_username.textContent = "";
    errorSpan_text.textContent = "";
    if (username == "") {
        errorSpan_username.textContent = " 请填写昵称！";
        return false;
    } else if (text == "") {
        errorSpan_text.textContent = "请填写留言内容！";
        return false;
    }
    return true;
}