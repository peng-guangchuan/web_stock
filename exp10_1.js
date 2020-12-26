$(document).ready(function () {
    var provinceVal;

    $('#province').change(function () {
        provinceVal = $('#province').val();
        $.ajax({
            type: "POST",
            url: "exp10_1.php",
            data: { provinceid: provinceVal },
            dataType: "json",
            success: ShowCity
        });
    });

    $('#city').change(function () {
        var city = $("#city option:selected").text();
        $.ajax({
            type: "POST",
            url: "exp10_1.php",
            data: { provinceid: provinceVal, city: city },
            dataType: "json",
            success: Show
        });
    });

    function ShowCity(data) {
        var city = $('#city');
        city.empty();
        city.prepend("<option value='0'>-请选择-</option>");
        if (data == "0") {
            $('#area').html("0");
            $('#pop').html("0");
        } else {
            for (var d of data) {
                $('<option></option>').appendTo(city).html(d);
            }
        }
    }

    function Show(data) {
        if (data.area == false) {
            data.area = 0;
            data.population = 0;
        }
        $('#area').html(data.area);
        $('#pop').html(data.population);
    }
});