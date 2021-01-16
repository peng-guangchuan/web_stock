$(function () {
    $('#submit').click(function () {
        if ($('#sno').val().length != 12) {
            alert('请输入你的(12位)学号。');
            return;
        }
        if ($('#name').val().length == 0) {
            alert('请输入你的姓名。');
            return;
        }
        if ($('#psw').val().length < 6) {
            alert('请输入你的(6位)密码。');
            return;
        }
        if ($('#title').val().length == 0) {
            alert('请输入你的题目。');
            return;
        }
        $.ajax({
            url: "exp10_3.php",
            dataType: "json",
            type: "POST",
            data: $('#form2').serialize(),
            success: function (data) {
                if (data.rescode != 0) {
                    alert(data.msg);
                } else {
                    alert(data.msg);
                    showdata(data.data);
                }
            }
        });
    });
    $('#show').click(function () {
        $.ajax({
            url: "exp10_3.php",
            dataType: "json",
            success: function (data) {
                showdata(data);
            }
        });

    });
    function showdata(data) {
        $('#container2').css('display', 'block');
        var table = $('#mtable');
        $("table tr:not(:first)").remove();
        var no = 0;
        for (var row of data) {
            ++no;
            var tr = $("<tr></tr>").appendTo(table);
            $("<td></td>").appendTo(tr).html(no);
            $("<td></td>").appendTo(tr).html(row.sno);
            $("<td></td>").appendTo(tr).html(row.name);
            $("<td></td>").appendTo(tr).html(row.title);
            $("<td></td>").appendTo(tr).html(row.state);
            $("<td></td>").appendTo(tr).html(row.last_time);
            $("<td></td>").appendTo(tr).html(row.partner);
        }
    }
});

