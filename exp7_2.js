function calc() {
    var answer = prompt("请输入计算式", "1+2");
    var res;
    //方法一
    //indexOf()方法可返回某个指定的字符串在字符串中首次出现的位置，未找到则返回-1
    if ((index = answer.indexOf("+")) != -1) {
        var num1 = (Number)(answer.substring(0, index));//注意字符串需要转换成数字类型
        var num2 = (Number)(answer.substring(index + 1));
        res = num1 + num2;
    } else if ((index = answer.indexOf("*")) != -1) {
        var num1 = (Number)(answer.substring(0, index));
        var num2 = (Number)(answer.substring(index + 1));
        res = num1 * num2;
    } else if ((index = answer.indexOf("/")) != -1) {
        var num1 = (Number)(answer.substring(0, index));
        var num2 = (Number)(answer.substring(index + 1));
        res = num1 / num2;
    } else if ((index = answer.indexOf("-")) != -1) {
        var num1 = (Number)(answer.substring(0, index));
        var num2 = (Number)(answer.substring(index + 1));
        res = num1 - num2;
    }

    //方法二
    // var oper = answer.match(/[\+\-\*\/]/);
    // var nums = answer.split(oper[0]);
    // var num1 = (Number)(nums[0]);
    // var num2 = (Number)(nums[1]);

    // switch (oper[0]) {
    //     case "+": {
    //         res = num1 + num2;
    //         break;
    //     }
    //     case "-": {
    //         res = num1 - num2;
    //         break;
    //     }
    //     case "*": {
    //         res = num1 * num2;
    //         break;
    //     }
    //     case "/": {
    //         res = num1 / num2;
    //         break;
    //     }
    //     default: {
    //         res = "Error in expression!";
    //     }
    // }

    var r = document.getElementById('res');
    //innerhtml在js是双向功能：获取对象的内容 或 向对象插入内容
    r.innerHTML = "结果是：" + answer + "=" + res;
    return;



}