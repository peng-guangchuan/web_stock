var names = ["Tom", "Jack", "Carson", "Nadal", "Federer", "Djokovic", "Murray"];
var areas = [["东城区", "西城区", "朝阳区", "丰台区"], ["黄浦区", "徐汇区", "长宁区", "静安区"], ["白云区", "越秀区", "海珠区", "天河区"]];

//为防止错误：Cannot set property 'innerHTML' of null，提前创建好
var phoneError_ept_tips = document.getElementById('phoneError_ept_tips');//号码验证提示p标签
var phoneCorrect = document.getElementById('phoneCorrect');//号码格式正确显示元素
var phoneError_ept = document.getElementById('phoneError_ept');//号码格式不正确元素
var pswError = document.getElementById('pswError');//密码格式不正确显示元素
var pswError_tips = document.getElementById('pswError_tips');//密码错误类型提示p标签
var pswCorrect = document.getElementById('pswCorrect');//密码格式验证正确元素
var nameError = document.getElementById('nameError');//名字验证错误标签
var nameCorrect = document.getElementById('nameCorrect');//名字验证正确标签
var nameError_tips = document.getElementById('nameError_tips');//名字验证提示p标签
var codeError = document.getElementById('codeError');
var codeError_tips = document.getElementById('codeError_tips');
var codeCorrect = document.getElementById('codeCorrect');

function checkPhone() {//
    var phoneIpt = document.getElementById('phone');
    var phoneVle = phoneIpt.value.trim();

    if (phoneVle.length == 0) {
        phoneError_ept_tips.innerHTML = "请输入手机号";
        phoneCorrect.style.display = 'none';
        phoneError_ept.style.display = 'inline-block';
        return;
    }

    var regular = /^13\d{9}$/;
    //test() 方法用于检测一个字符串是否匹配某个模式.如果字符串中有匹配的值返回 true ，否则返回 false。
    var res = regular.test(phoneVle);
    if (res) {
        phoneError_ept.style.display = 'none';
        phoneCorrect.style.display = 'inline-block';
    } else {
        phoneError_ept_tips.innerHTML = "手机号码格式不正确";
        phoneCorrect.style.display = 'none';
        phoneError_ept.style.display = 'inline-block';
    }
}

function checkPws() {
    var psw = document.getElementById('password');
    var pswVle = psw.value.trim();

    if (pswVle.length == 0) {
        pswError_tips.innerHTML = "请输入密码";
        pswCorrect.style.display = 'none';
        pswError.style.display = 'inline-block';
    } else if (pswVle.length < 6) {
        pswCorrect.style.display = 'none';
        pswError_tips.innerHTML = "密码太短了，最少6位";
        pswError.style.display = 'inline-block';
    } else {
        pswError.style.display = 'none';
        pswCorrect.style.display = 'inline-block';
    }
}

function checkName() {
    var name = document.getElementById('name');
    var nameVle = name.value.trim();
    var nameExist = false;

    if (nameVle.length == 0) {
        nameError_tips.innerHTML = "请输入昵称";
        nameCorrect.style.display = 'none';
        nameError.style.display = 'inline-block';
        return;
    }

    for (var n of names) {//检查是否已存在
        if (nameVle == n) {
            nameExist = true;
            break;
        }
    }

    if (nameExist) {
        nameError_tips.innerHTML = "此昵称太受欢迎，已经有人抢了";
        nameCorrect.style.display = 'none';
        nameError.style.display = 'inline-block';
    } else {
        nameError.style.display = 'none';
        nameCorrect.style.display = 'inline-block';
    }
}

function checkCode() {
    var code = document.getElementById('phoneCode');
    var codeVle = code.value.trim();

    if (codeVle.length == 0) {
        codeCorrect.style.display = 'none';
        codeError_tips.innerHTML = "请输入验证码";
        codeError.style.display = 'inline-block';
    } else {
        codeError.style.display = 'none';
        codeCorrect.style.display = 'inline-block';
    }
}

function switchCity() {
    var city = document.getElementById('city');
    var area = document.getElementById('area');

    var cityIdx = city.selectedIndex; //获取下拉框选择元素的下标
    area.length = 1;//初始化第二下拉框，只保留第一项
    if (cityIdx != 0) {
        var area2 = areas[cityIdx - 1]
        for (var a of area2) {
            area.options.add(new Option(a, a));//new Option(text, value)
        }
    }
}

function checkAll() {
    checkPhone();
    checkPws();
    checkName();
    checkCode();
}


