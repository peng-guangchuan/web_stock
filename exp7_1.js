var str = new Array("web", "javascript", "css", "html", "php", "jquery", "xhtml", "ajax", "dom");
str.sort();
var temp = "";
for (var i = 0; i < str.length; i++) {
    temp += str[i] + ",";
    if ( i % 3 == 2 ) {
        temp += "<br />";
    }
}
//传入参数函数，降序
//str.sort(function (a, b) { b.localeCompare(a) });
str.reverse();//反转
for (var i of str) {
    temp += i.toUpperCase() + ",";
}
document.write(temp);
