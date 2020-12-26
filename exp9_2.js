$(document).ready(function () {
    var flowerid = 0;
    //var times = 86400;

    $.ajax({
        url: 'exp9_2.php',
        type: "GET",
        dataType: "json",
        success: changeVote
    });

    $('#btn1').click(function () {
        flowerid = 0;
        getvote();
    });
    $('#btn2').click(function () {
        flowerid = 1;
        getvote();
    });
    $('#btn3').click(function () {
        flowerid = 2;
        getvote();
    });

    function getvote() {
        // if ($('#clear').prop("checked") == true) {
        //     times = 0;
        // }
        $.ajax({
            url: 'exp9_2.php',
            type: "GET",
            //data: { id: flowerid, time: times },
            data: { id: flowerid },
            dataType: "json",
            success: changeVote
        });
    }

    function changeVote(data) {
        $('#p1').html(data[0] + "票");
        $('#p2').html(data[1] + "票");
        $('#p3').html(data[2] + "票");
    }
})