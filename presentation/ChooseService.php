<?php
include './header.php';
?>

<div>
    <form name="formInsert" action="../business/.php" method="POST">

        <h1>Choose Service</h1>
        <table border="1">
            <tr>
                <th>Service</th>
                <th>Instructor</th>
                <th>Campus</th>
                <th>Day</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Start Day</th>
                <th>Payment Module</th>
            </tr>

            <tr id="tr0">

            <input id="idClient" name="idClient" type="number">

            <!--SERVICE-->
            <td>
                <SELECT id="comboService" NAME="comboService" SIZE=1 onchange="loadSelectDay();">
                    <OPTION VALUE="-1">SELECT</OPTION>
                </SELECT>
            </td>

            <!--INSTRUCTOR-->
            <td>
                <input id="instructor" name="instructor" type="text" readonly="readonly"/>
            </td>

            <!--CAMPUS-->
            <td>
                <input id="campus" name="campus" type="text" readonly="readonly"/>
            </td>

            <!--DAY-->
            <td>
                <SELECT id="comboDay" NAME="comboDay" SIZE=1 onchange="loadSelectHourStart();">
                    <OPTION VALUE="-1">SELECT</OPTION>
                </SELECT>
            </td>

            <!--HOUR-START-->
            <td>
                <SELECT id="comboHourStart" NAME="comboHourStart" SIZE=1 onchange="loadHourEnd();">
                    <OPTION VALUE="-1">SELECT</OPTION>
                </SELECT>
            </td>

            <!--HOUR-END-->
            <td>
                <input id="comboHourEnd" name="comboHourStart" type="text" readonly="readonly"/>
            </td>

            <!--Start Day-->
            <td>
                <input id="startDay" name="startDay" type="date"/>
            </td>

            <!--HOUR-START-->
            <td>
                <SELECT id="comboPaymentModule" NAME="comboPaymentModule" SIZE=1">
                    <OPTION VALUE="-1">SELECT</OPTION>
                </SELECT>
            </td>

            </tr>
        </table>

        <!--REGISTRE-->
        <div>
            <input type="submit" name="submit" value="Register">
        </div>

    </form>

</div>

<?php
include './footer.php';
?>

<script type="text/javascript">

    function init() {

        $('#idClient').hide();
        $('#idClient').val($.get("id"));

        $.ajax({
            type: 'GET',
            url: "../business/GetService.php",
            success: function (data)
            {
                var services = JSON.parse(data);
                var htmlCombo = '<OPTION VALUE="-1">SELECT</OPTION>';
                $.each(services, function (i, item) {
                    htmlCombo += '<OPTION VALUE="' + item.idService + '">' + item.nameService + '</OPTION>';
                });
                $("#comboService").html(htmlCombo);
            },
            error: function ()
            {
                alert("Error show services!");
            }
        });
    }

    (function ($) {
        $.get = function (key) {
            key = key.replace(/[\[]/, '\\[');
            key = key.replace(/[\]]/, '\\]');
            var pattern = "[\\?&]" + key + "=([^&#]*)";
            var regex = new RegExp(pattern);
            var url = unescape(window.location.href);
            var results = regex.exec(url);
            if (results === null) {
                return null;
            } else {
                return results[1];
            }
        }
    })(jQuery);

    $(function () {
        init();
    });

    function loadInstructor() {
        $.ajax({
            type: 'GET',
            url: "../business/GetInstructorService.php",
            data: {"id": $("#comboService").val()},
            success: function (data)
            {
                var instructor = JSON.parse(data);
                $.each(instructor, function (i, item) {
                    $("#instructor").val(item.namePerson);
                });
            },
            error: function ()
            {
                alert("Error show instructor!");
            }
        });
    }

    function loadCampus() {
        $.ajax({
            type: 'GET',
            url: "../business/GetCampus.php",
            data: {"id": $("#comboService").val()},
            success: function (data)
            {
                var campus = JSON.parse(data);
                $.each(campus, function (i, item) {
                    $("#campus").val(item.nameCampus);
                });
            },
            error: function ()
            {
                alert("Error show campus!");
            }
        });
    }

    function loadSelectDay() {
        loadInstructor();
        loadCampus();
        loadPaymentModule();
        $.ajax({
            type: 'GET',
            url: "../business/GetDayService.php",
            data: {"id": $("#comboService").val()},
            success: function (data)
            {
                var day = JSON.parse(data);
                var htmlCombo = '<OPTION VALUE="-1">SELECT</OPTION>';
                $.each(day, function (i, item) {
                    htmlCombo += '<OPTION VALUE="' + item.idDay + '">' + item.nameDay + '</OPTION>';
                });
                $("#comboDay").html(htmlCombo);
            },
            error: function ()
            {
                alert("Error show day!");
            }
        });
    }

    function loadSelectHourStart() {
        $.ajax({
            type: 'GET',
            url: "../business/GetHourService.php",
            data: {"id": $("#comboService").val(),
                "idDay": $("#comboDay").val(),
                "condiction": "0"},
            success: function (data)
            {
                var hour = JSON.parse(data);
                var htmlCombo = '<OPTION VALUE="-1">SELECT</OPTION>';
                $.each(hour, function (i, item) {
                    htmlCombo += '<OPTION VALUE="' + item.idDayHourService + '">' + item.idHour + '</OPTION>';
                });
                $("#comboHourStart").html(htmlCombo);
            },
            error: function ()
            {
                alert("Error show day!");
            }
        });
    }

    function loadHourEnd() {
        $.ajax({
            type: 'GET',
            url: "../business/GetHourService.php",
            data: {"id": $("#comboService").val(),
                "idDay": $("#comboHourStart").val(),
                "condiction": "1"},
            success: function (data)
            {
                var hourEnd = JSON.parse(data);
                $.each(hourEnd, function (i, item) {
                    $("#comboHourEnd").val(item.HourEnd);
                });
            }
            ,
            error: function ()
            {
                alert("Error show hour End!");
            }
        }
        );
    }

    function loadPaymentModule() {
        $.ajax({
            type: 'GET',
            url: "../business/GetPaymentModule.php",
            data: {"id": $("#comboService").val()},
            success: function (data)
            {
                var module = JSON.parse(data);
                var htmlCombo = '<OPTION VALUE="-1">SELECT</OPTION>';
                $.each(module, function (i, item) {
                    htmlCombo += '<OPTION VALUE="' + item.idPaymentModule + '">' + item.namePaymentModule + '</OPTION>';
                });
                $("#comboPaymentModule").html(htmlCombo);
            },
            error: function ()
            {
                alert("Error show campus!");
            }
        });
    }

    function clear() {

    }


</script>

