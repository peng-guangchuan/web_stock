function PopMenu(event) {
    if (event.button == 2) {
        var x = event.clientX;
        var y = event.clientY;
        $('#float').css({ 'left': x - 3, 'top': y - 3, 'display': "block" });
    }
}
function AddItem() {
    var tips = prompt("脚本提示:\n请输入城市", "");
    if (tips != "" && tips != null) {
        var ul = $('#main ul');
        $('<li></li>').appendTo(ul).html(tips);
        $('#float').css('display', "none");
    }
}
// mouseleave() 方法触发 mouseleave 事件，或添加当发生 mouseleave 事件时运行的函数。
// 注意：与 mouseout 事件不同，mouseleave 事件只有在鼠标指针离开被选元素时被触发，
// mouseout 事件在鼠标指针离开任意子元素时也会被触发。
$(function () {
    $('#float').mouseleave(function () {
        $('#float').css('display', "none");
    });
})