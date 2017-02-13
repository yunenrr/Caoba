<?php
include './header.php';
session_start();
if (!isset($_SESSION['id'])) {
    header("location: ./Home.php");
}

?>

<dv>

    <h1>SERVICE HOURS</h1>

    <SELECT id="comboService" NAME="comboService" SIZE=1 onchange="loadSchedule();">
    </SELECT>
    <br>
    <br>

    <table border="1">
        <tr>
            <th>Schedule</th>
            <th>Monday</th>
            <th>Tuesday</th>
            <th>Wednesday</th>
            <th>Thursday</th>
            <th>Friday</th>
        </tr>
        <tr>
            <th>5am</th>
            <td id="50"> </td>
            <td id="51"> </td>
            <td id="52"> </td>
            <td id="53"> </td>
            <td id="54"> </td>
        </tr>
        <tr>
            <th>6am</th>
            <td id="60"> </td>
            <td id="61"> </td>
            <td id="62"> </td>
            <td id="63"> </td>
            <td id="64"> </td>
        </tr>
        <tr>
            <th>7am</th>
            <td id="70"> </td>
            <td id="71"> </td>
            <td id="72"> </td>
            <td id="73"> </td>
            <td id="74"> </td>
        </tr>
        <tr>
            <th>8am</th>
            <td id="80"> </td>
            <td id="81"> </td>
            <td id="82"> </td>
            <td id="83"> </td>
            <td id="84"> </td>
        </tr>
        <tr>
            <th>9am</th>
            <td id="90"> </td>
            <td id="91"> </td>
            <td id="92"> </td>
            <td id="93"> </td>
            <td id="94"> </td>
        </tr>
        <tr>
            <th>10am</th>
            <td id="100"> </td>
            <td id="101"> </td>
            <td id="102"> </td>
            <td id="103"> </td>
            <td id="104"> </td>
        </tr>
        <tr>
            <th>11am</th>
            <td id="110"> </td>
            <td id="111"> </td>
            <td id="112"> </td>
            <td id="113"> </td>
            <td id="114"> </td>
        </tr>
        <tr>
            <th>12md</th>
            <td id="120"> </td>
            <td id="121"> </td>
            <td id="122"> </td>
            <td id="123"> </td>
            <td id="124"> </td>
        </tr>
        <tr>
            <th>1pm</th>
            <td id="130"> </td>
            <td id="131"> </td>
            <td id="132"> </td>
            <td id="133"> </td>
            <td id="134"> </td>
        </tr>
        <tr>
            <th>2pm</th>
            <td id="140"> </td>
            <td id="141"> </td>
            <td id="142"> </td>
            <td id="143"> </td>
            <td id="144"> </td>
        </tr>
        <tr>
            <th>3pm</th>
            <td id="150"> </td>
            <td id="151"> </td>
            <td id="152"> </td>
            <td id="153"> </td>
            <td id="154"> </td>
        </tr>
        <tr>
            <th>4pm</th>
            <td id="160"> </td>
            <td id="161"> </td>
            <td id="162"> </td>
            <td id="163"> </td>
            <td id="164"> </td>
        </tr>
        <tr>
            <th>5pm</th>
            <td id="170"> </td>
            <td id="171"> </td>
            <td id="172"> </td>
            <td id="173"> </td>
            <td id="174"> </td>
        </tr>
        <tr>
            <th>6pm</th>
            <td id="180"> </td>
            <td id="181"> </td>
            <td id="182"> </td>
            <td id="183"> </td>
            <td id="184"> </td>
        </tr>
        <tr>
            <th>7pm</th>
            <td id="190"> </td>
            <td id="191"> </td>
            <td id="192"> </td>
            <td id="193"> </td>
            <td id="194"> </td>
        </tr>
        <tr>
            <th>8pm</th>
            <td id="200"> </td>
            <td id="201"> </td>
            <td id="202"> </td>
            <td id="203"> </td>
            <td id="204"> </td>
        </tr>
        <tr>
            <th>9pm</th>
            <td id="210"> </td>
            <td id="211"> </td>
            <td id="212"> </td>
            <td id="213"> </td>
            <td id="214"> </td>
        </tr>
        <tr>
            <th>10pm</th>
            <td id="220"> </td>
            <td id="221"> </td>
            <td id="222"> </td>
            <td id="223"> </td>
            <td id="224"> </td>
        </tr>
    </table>

</dv>

<script type="text/javascript">

    $(function () {
        loadService();
    });

    function loadService() {

        $.ajax({
            type: 'GET',
            url: "../business/GetService.php",
            success: function (data)
            {
                var services = JSON.parse(data);
                var htmlCombo = '<OPTION VALUE="-2">SELECT</OPTION>';
                $.each(services, function (i, item) {
                    htmlCombo += '<OPTION VALUE="' + item.idservice + '">' + item.nameservice + '</OPTION>';
                });
                htmlCombo += '<OPTION VALUE="-1">ALL</OPTION>';
                $("#comboService").html(htmlCombo);
            },
            error: function ()
            {
                alert("Error show services!");
            }
        });
    }

    function loadSchedule() {
        clearShedule();
        var idclient = <?php echo $_SESSION['id']; ?>;
        var idService = $('#comboService').val();

        $.ajax({
            type: 'GET',
            url: "../business/GetSchedule.php",
            data: {
                "idClient": idclient,
                "idService": idService
            },
            success: function (data)
            {
                var schedule = JSON.parse(data);
                $.each(schedule, function (i, item) {
                    $("#" + item.hourclientschedule + item.dayclientschedule).html(item.nameservice);
                });
            },
            error: function ()
            {
                alert("Error show services!");
            }
        });

    }

    function clearShedule() {
        $('#50').html(" ");
        $('#51').html(" ");
        $('#52').html(" ");
        $('#53').html(" ");
        $('#54').html(" ");

        $('#60').html(" ");
        $('#61').html(" ");
        $('#62').html(" ");
        $('#63').html(" ");
        $('#64').html(" ");

        $('#70').html(" ");
        $('#71').html(" ");
        $('#72').html(" ");
        $('#73').html(" ");
        $('#74').html(" ");

        $('#80').html(" ");
        $('#81').html(" ");
        $('#82').html(" ");
        $('#83').html(" ");
        $('#84').html(" ");

        $('#90').html(" ");
        $('#91').html(" ");
        $('#92').html(" ");
        $('#93').html(" ");
        $('#94').html(" ");

        $('#100').html(" ");
        $('#101').html(" ");
        $('#102').html(" ");
        $('#103').html(" ");
        $('#104').html(" ");

        $('#110').html(" ");
        $('#111').html(" ");
        $('#112').html(" ");
        $('#113').html(" ");
        $('#114').html(" ");

        $('#120').html(" ");
        $('#121').html(" ");
        $('#122').html(" ");
        $('#123').html(" ");
        $('#124').html(" ");

        $('#130').html(" ");
        $('#131').html(" ");
        $('#132').html(" ");
        $('#133').html(" ");
        $('#134').html(" ");

        $('#140').html(" ");
        $('#141').html(" ");
        $('#142').html(" ");
        $('#143').html(" ");
        $('#144').html(" ");

        $('#150').html(" ");
        $('#151').html(" ");
        $('#152').html(" ");
        $('#153').html(" ");
        $('#154').html(" ");

        $('#160').html(" ");
        $('#161').html(" ");
        $('#162').html(" ");
        $('#163').html(" ");
        $('#164').html(" ");

        $('#170').html(" ");
        $('#171').html(" ");
        $('#172').html(" ");
        $('#173').html(" ");
        $('#174').html(" ");

        $('#180').html(" ");
        $('#181').html(" ");
        $('#182').html(" ");
        $('#183').html(" ");
        $('#184').html(" ");

        $('#190').html(" ");
        $('#191').html(" ");
        $('#192').html(" ");
        $('#193').html(" ");
        $('#194').html(" ");

        $('#200').html(" ");
        $('#201').html(" ");
        $('#202').html(" ");
        $('#203').html(" ");
        $('#204').html(" ");

        $('#210').html(" ");
        $('#211').html(" ");
        $('#212').html(" ");
        $('#213').html(" ");
        $('#214').html(" ");

        $('#220').html(" ");
        $('#221').html(" ");
        $('#222').html(" ");
        $('#223').html(" ");
        $('#224').html(" ");
    }

</script>
