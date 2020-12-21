$(document).ready(function () {
    var first = $('#first');
    var second = $('#second');
    var third = $('#third');
    var chk1 = $('#chk1');
    var chk2 = $('#chk2');
    var span1 = $('#span1');
    var span2 = $('#span2');
    //bind() 方法向被选元素添加一个或多个事件处理程序，以及当事件发生时运行的函数。
    //$(selector).bind(event,data,function,map)
    second.bind("focus", function () {
        second.val(first.val());
    });

    chk1.click(function () {
        if (chk1.prop("checked") == true) {
            span1.html("显示第三个文本框");
            third.css('display',"none");
        } else {
            span1.html("隐藏第三个文本框");
            third.css('display',"block");
        }
    });

    chk2.click(function () {
        if (chk2.prop("checked") == true) {
            span2.html("变短第一个文本框");
            first.css('width',"300px");
        } else {
            span2.html("变长第一个文本框");
            first.css('width',"200px");
        }
    });
});