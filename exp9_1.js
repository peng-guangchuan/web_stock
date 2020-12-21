window.onload = function () {//在网页加载完毕后立刻执行的操作
    document.getElementById("user").onblur = ValidateUser;
}
function ValidateUser() {
    var user = document.getElementById("user").value;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        receiveMsg(xhr);
    };
    xhr.open("GET", "exp9_1.php?user=" + user, true);
    xhr.send();
}
function receiveMsg(xhr) {
    var tip = document.getElementById("user_tips");
    if (xhr.readyState == 4 && xhr.status == 200) {
        if (xhr.responseText == "1") {
            tip.innerHTML = "用户名可以使用!";
            tip.style.color = "green";
        }
        else {
            tip.innerHTML = "用户名已注册!";
            tip.style.color = "red";
        }
    }
}
function sendForm() {
    var form = document.getElementById("myForm");
    var data = new FormData(form);
    data.append('myData', '测试');

    var xhr = new XMLHttpRequest();
    xhr.open("POST", form.action, true);
    xhr.onload = function(e){//onload只有状态码为4时才能回调一次函数
        if(xhr.status == 200){
            var res = document.getElementById("res");
            res.innerHTML = this.responseText;
            res.style.border = "solid 2px";
        }
    };
    xhr.send(data);
} 