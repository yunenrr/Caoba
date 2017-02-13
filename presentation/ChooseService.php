<?php
include './header.php';
session_start();
if (!isset($_SESSION['id'])) {
    header("location: ./Home.php");
}
?>

<div>
    <form name="formInsert" action="../business/CreateClientRecordAction.php" method="POST">

        <h1>Choose Service</h1>
        <table border="1">
            <tr>
                <th>Service</th>
                <th>Campus</th>
                <th>Day</th>
                <th>Hour</th>
                <th>Start Day</th>
                <th>Payment Module</th>
            </tr>

            <tr id="tr0">

                <!--SERVICE-->
                <td>
                    <SELECT id="comboService" NAME="comboService" SIZE=1 onchange="loadSelectDay();">
                        <OPTION VALUE="-1">SELECT</OPTION>
                    </SELECT>
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

                <!--Start Day-->
                <td>
                    <input id="startDay" name="startDay" type="date"/>
                </td>

                <!--PAYMENT MODULE-->
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

    $(function () {
        $.ajax({
            type: 'GET',
            url: "../business/GetService.php",
            success: function (data)
            {
                var services = JSON.parse(data);
                var htmlCombo = '<OPTION VALUE="-1">SELECT</OPTION>';
                $.each(services, function (i, item) {
                    htmlCombo += '<OPTION VALUE="' + item.idservice + '">' + item.nameservice + '</OPTION>';
                });
                $("#comboService").html(htmlCombo);
            },
            error: function ()
            {
                alert("Error show services!");
            }
        });
    });

    function loadCampus() {
        $.ajax({
            type: 'GET',
            url: "../business/GetCampus.php",
            data: {"id": $("#comboService").val()},
            success: function (data)
            {
                var campus = JSON.parse(data);
                $.each(campus, function (i, item) {
                    $("#campus").val(item.namecampus);
                });
            },
            error: function ()
            {
                alert("Error show campus!");
            }
        });
    }

    function loadSelectDay() {
        loadCampus();
        loadPaymentModule();
        $.ajax({
            type: 'GET',
            url: "../business/GetDayService.php",
            data: {"id": $("#comboService").val()},
            success: function (data)
            {
                var days = JSON.parse(data);
                var htmlCombo = '<OPTION VALUE="-1">SELECT</OPTION>';
                var day = "";
                $.each(days, function (i, item) {
                    switch (item.dayscheduleservice) {
                        case '0':
                            day = "Monday";
                            break;
                        case '1':
                            day = "Tuesday";
                            break;
                        case '2':
                            day = "Wednesday";
                            break;
                        case '3':
                            day = "Thursday";
                            break;
                        case '4':
                            day = "Friday";
                            break;
                        default:
                            day = "error";
                            break;
                    }
                    htmlCombo += '<OPTION VALUE="' + item.dayscheduleservice + '">' + day + '</OPTION>';
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
                "idDay": $("#comboDay").val()},
            success: function (data)
            {
                var hours = JSON.parse(data);
                var htmlCombo = '<OPTION VALUE="-1">SELECT</OPTION>';
                var hour = "";
                $.each(hours, function (i, item) {
                    switch (item.hourscheduleservice) {
                        case '5':
                            hour = "5am";
                            break;
                        case '6':
                            hour = "6am";
                            break;
                        case '7':
                            hour = "7am";
                            break;
                        case '8':
                            hour = "8am";
                            break;
                        case '9':
                            hour = "9am";
                            break;
                        case '10':
                            hour = "10am";
                            break;
                        case '11':
                            hour = "11am";
                            break;
                        case '12':
                            hour = "12md";
                            break;
                        case '13':
                            hour = "1pm";
                            break;
                        case '14':
                            hour = "2pm";
                            break;
                        case '15':
                            hour = "3pm";
                            break;
                        case '16':
                            hour = "4pm";
                            break;
                        case '17':
                            hour = "5pm";
                            break;
                        case '18':
                            hour = "6pm";
                            break;
                        case '19':
                            hour = "7pm";
                            break;
                        case '20':
                            hour = "8pm";
                            break;
                        case '21':
                            hour = "9pm";
                            break;
                        case '22':
                            hour = "10pm";
                            break;

                        default:
                            hour = "error";
                            break;
                    }
                    htmlCombo += '<OPTION VALUE="' + item.hourscheduleservice + '">' + hour + '</OPTION>';
                });
                $("#comboHourStart").html(htmlCombo);
            },
            error: function ()
            {
                alert("Error show day!");
            }
        });
    }

    function loadPaymentModule() {
        $.ajax({
            type: 'GET',
            url: "../business/GetPaymentModule.php",
            success: function (data)
            {
                var module = JSON.parse(data);
                var htmlCombo = '<OPTION VALUE="-1">SELECT</OPTION>';
                $.each(module, function (i, item) {
                    htmlCombo += '<OPTION VALUE="' + item.idpaymentmodule + '">' + item.namepaymentmodule + '</OPTION>';
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

