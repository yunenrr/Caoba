<?php
include './header.php';
include '../business/ScheduleClientBusiness.php';
session_start();
if (!isset($_SESSION['id'])) {
    header("location: ./Home.php");
}

$schedule = new ScheduleClientBusiness();
$schedule->deleteRecord();
?>

<dv>
    <h1>Horario del ginmnasio</h1>
    <table border="1">
        <tr>
            <th>Ver por</th>
            <th id="thService">Servicio</th>
            <th id="thCampus">Sala</th>
            <th id="labelStarDate">Fecha de inicio</th>
            <th id="labelModule">Modulo de pago</th>
        </tr>
        <tr>
            <td>
                <SELECT id="chooseview" SIZE=1 onchange="show();">
                    <option  VALUE="0">Seleccionar</option>
                    <option  VALUE="1">Servicio</option>
                    <option  VALUE="2">Sala</option>
                </SELECT>
            </td>
            <td id="showService">
                <SELECT id="comboService" NAME="comboService" SIZE=1 onchange="loadCampusService();">
                </SELECT>
            </td>
            <td id="showCampus">
                <SELECT id="comboCampus" NAME="comboService" SIZE=1 onchange="loadScheduleGym();">
                </SELECT>
            </td>
            <td id="showDate">
                <input id="date" name="date" type="text"/>
            </td>
            <td id="showModule">
                <SELECT id="comboPaymentModule" NAME="comboPaymentModule" SIZE="1">
                </SELECT>
            </td>
        </tr>
    </table>
    <h3 id="msgInsert" style="margin-left: 400px;"></h3>
    <table>
        <tr>
            <!--SCHEDULE GYM-->
            <td>
                <h2>Horario de las lecciones del gimnasio</h2>
                <div id="schedule">
                    <table id="tbgym" border="1">
                        <tr>
                            <th>Horario</th>
                            <th>Lunes</th>
                            <th>Martes</th>
                            <th>Miércoles</th>
                            <th>Jueves</th>
                            <th>Viernes</th>
                        </tr>
                        <tr>
                            <th>5am</th>
                            <td id="g50"></td>
                            <td id="g51"></td>
                            <td id="g52"></td>
                            <td id="g53"></td>
                            <td id="g54"></td>
                        </tr>
                        <tr>
                            <th>6am</th>
                            <td id="g60"></td>
                            <td id="g61"></td>
                            <td id="g62"></td>
                            <td id="g63"></td>
                            <td id="g64"></td>
                        </tr>
                        <tr>
                            <th>7am</th>
                            <td id="g70"></td>
                            <td id="g71"></td>
                            <td id="g72"></td>
                            <td id="g73"></td>
                            <td id="g74"></td>
                        </tr>
                        <tr>
                            <th>8am</th>
                            <td id="g80"></td>
                            <td id="g81"></td>
                            <td id="g82"></td>
                            <td id="g83"></td>
                            <td id="g84"></td>
                        </tr>
                        <tr>
                            <th>9am</th>
                            <td id="g90"></td>
                            <td id="g91"></td>
                            <td id="g92"></td>
                            <td id="g93"></td>
                            <td id="g94"></td>
                        </tr>
                        <tr>
                            <th>10am</th>
                            <td id="g100"></td>
                            <td id="g101"></td>
                            <td id="g102"></td>
                            <td id="g103"></td>
                            <td id="g104"></td>
                        </tr>
                        <tr>
                            <th>11am</th>
                            <td id="g110"></td>
                            <td id="g111"></td>
                            <td id="g112"></td>
                            <td id="g113"></td>
                            <td id="g114"></td>
                        </tr>
                        <tr>
                            <th>12md</th>
                            <td id="g120"></td>
                            <td id="g121"></td>
                            <td id="g122"></td>
                            <td id="g123"></td>
                            <td id="g124"></td>
                        </tr>
                        <tr>
                            <th>1pm</th>
                            <td id="g130"></td>
                            <td id="g131"></td>
                            <td id="g132"></td>
                            <td id="g133"></td>
                            <td id="g134"></td>
                        </tr>
                        <tr>
                            <th>2pm</th>
                            <td id="g140"></td>
                            <td id="g141"></td>
                            <td id="g142"></td>
                            <td id="g143"></td>
                            <td id="g144"></td>
                        </tr>
                        <tr>
                            <th>3pm</th>
                            <td id="g150"></td>
                            <td id="g151"></td>
                            <td id="g152"></td>
                            <td id="g153"></td>
                            <td id="g154"></td>
                        </tr>
                        <tr>
                            <th>4pm</th>
                            <td id="g160"></td>
                            <td id="g161"></td>
                            <td id="g162"></td>
                            <td id="g163"></td>
                            <td id="g164"></td>
                        </tr>
                        <tr>
                            <th>5pm</th>
                            <td id="g170"></td>
                            <td id="g171"></td>
                            <td id="g172"></td>
                            <td id="g173"></td>
                            <td id="g174"></td>
                        </tr>
                        <tr>
                            <th>6pm</th>
                            <td id="g180"></td>
                            <td id="g181"></td>
                            <td id="g182"></td>
                            <td id="g183"></td>
                            <td id="g184"></td>
                        </tr>
                        <tr>
                            <th>7pm</th>
                            <td id="g190"></td>
                            <td id="g191"></td>
                            <td id="g192"></td>
                            <td id="g193"></td>
                            <td id="g194"></td>
                        </tr>
                        <tr>
                            <th>8pm</th>
                            <td id="g200"></td>
                            <td id="g201"></td>
                            <td id="g202"></td>
                            <td id="g203"></td>
                            <td id="g204"></td>
                        </tr>
                        <tr>
                            <th>9pm</th>
                            <td id="g210"></td>
                            <td id="g211"></td>
                            <td id="g212"></td>
                            <td id="g213"></td>
                            <td id="g214"></td>
                        </tr>
                        <tr>
                            <th>10pm</th>
                            <td id="220"></td>
                            <td id="221"></td>
                            <td id="222"></td>
                            <td id="223"></td>
                            <td id="224"></td>
                        </tr>
                    </table>
                </div>
            </td>

        <label style="background-color: #00ff40; text-align: left">[  ]</label> = Añadir nuevo servicio<br>
        <label style="background-color: #ffff33; text-align: left">[  ]</label> = Servicio con cupos agotados<br>
        <label style="background-color: #0066ff; text-align: left">[  ]</label> = Clases en curso<br>
        <label style="background-color: #ff3300; text-align: left">[  ]</label> = Las clases aun no han empezado<br>
        <br>
        <td style="text-align: center">
            <h1> Gym Caoba </h1>
            <button id="btn" onclick="add();">Agregar horario</button>
        </td>

        <!--SCHEDULE CLIENT-->
        <td>
            <div>
                <h2>Horario de las lecciones del cliente</h2>
                <table id="tbclient"border="1">
                    <tr>
                        <th>Horario</th>
                        <th>Lunes</th>
                        <th>Martes</th>
                        <th>Miércoles</th>
                        <th>Jueves</th>
                        <th>Viernes</th>
                    </tr>
                    <tr>
                        <th>5am</th>
                        <td id="c50"></td>
                        <td id="c51"></td>
                        <td id="c52"></td>
                        <td id="c53"></td>
                        <td id="c54"></td>
                    </tr>
                    <tr>
                        <th>6am</th>
                        <td id="c60"></td>
                        <td id="c61"></td>
                        <td id="c62"></td>
                        <td id="c63"></td>
                        <td id="c64"></td>
                    </tr>
                    <tr>
                        <th>7am</th>
                        <td id="c70"></td>
                        <td id="c71"></td>
                        <td id="c72"></td>
                        <td id="c73"></td>
                        <td id="c74"></td>
                    </tr>
                    <tr>
                        <th>8am</th>
                        <td id="c80"></td>
                        <td id="c81"></td>
                        <td id="c82"></td>
                        <td id="c83"></td>
                        <td id="c84"></td>
                    </tr>
                    <tr>
                        <th>9am</th>
                        <td id="c90"></td>
                        <td id="c91"></td>
                        <td id="c92"></td>
                        <td id="c93"></td>
                        <td id="c94"></td>
                    </tr>
                    <tr>
                        <th>10am</th>
                        <td id="c100"></td>
                        <td id="c101"></td>
                        <td id="c102"></td>
                        <td id="c103"></td>
                        <td id="c104"></td>
                    </tr>
                    <tr>
                        <th>11am</th>
                        <td id="c110"></td>
                        <td id="c111"></td>
                        <td id="c112"></td>
                        <td id="c113"></td>
                        <td id="c114"></td>
                    </tr>
                    <tr>
                        <th>12md</th>
                        <td id="c120"></td>
                        <td id="c121"></td>
                        <td id="c122"></td>
                        <td id="c123"></td>
                        <td id="c124"></td>
                    </tr>
                    <tr>
                        <th>1pm</th>
                        <td id="c130"></td>
                        <td id="c131"></td>
                        <td id="c132"></td>
                        <td id="c133"></td>
                        <td id="c134"></td>
                    </tr>
                    <tr>
                        <th>2pm</th>
                        <td id="c140"></td>
                        <td id="c141"></td>
                        <td id="c142"></td>
                        <td id="c143"></td>
                        <td id="c144"></td>
                    </tr>
                    <tr>
                        <th>3pm</th>
                        <td id="c150"></td>
                        <td id="c151"></td>
                        <td id="c152"></td>
                        <td id="c153"></td>
                        <td id="c154"></td>
                    </tr>
                    <tr>
                        <th>4pm</th>
                        <td id="c160"></td>
                        <td id="c161"></td>
                        <td id="c162"></td>
                        <td id="c163"></td>
                        <td id="c164"></td>
                    </tr>
                    <tr>
                        <th>5pm</th>
                        <td id="c170"></td>
                        <td id="c171"></td>
                        <td id="c172"></td>
                        <td id="c173"></td>
                        <td id="c174"></td>
                    </tr>
                    <tr>
                        <th>6pm</th>
                        <td id="c180"></td>
                        <td id="c181"></td>
                        <td id="c182"></td>
                        <td id="c183"></td>
                        <td id="c184"></td>
                    </tr>
                    <tr>
                        <th>7pm</th>
                        <td id="c190"></td>
                        <td id="c191"></td>
                        <td id="c192"></td>
                        <td id="c193"></td>
                        <td id="c194"></td>
                    </tr>
                    <tr>
                        <th>8pm</th>
                        <td id="c200"></td>
                        <td id="c201"></td>
                        <td id="c202"></td>
                        <td id="c203"></td>
                        <td id="c204"></td>
                    </tr>
                    <tr>
                        <th>9pm</th>
                        <td id="c210"></td>
                        <td id="c211"></td>
                        <td id="c212"></td>
                        <td id="c213"></td>
                        <td id="c214"></td>
                    </tr>
                    <tr>
                        <th>10pm</th>
                        <td id="c220"></td>
                        <td id="c221"></td>
                        <td id="c222"></td>
                        <td id="c223"></td>
                        <td id="c224"></td>
                    </tr>
                </table>
            </div>
        </td>
        </tr>
    </table>
</dv>
<script src="../js/jsService.js" type="text/javascript"></script>
<script type="text/javascript">
                var serviseTmp = "";
                var idServiceTmp = "";
                var idsArray = "";
                var idClient = "<?php echo $_SESSION['id'] ?>";

                $(function () {
                    $('#showService').hide();
                    $('#showCampus').hide();
                    $('#thService').hide();
                    $('#thCampus').hide();
                    $('#labelStarDate').hide();
                    $('#labelModule').hide();
                    $('#showDate').hide();
                    $('#showModule').hide();
//        $('#date').mask('00/00/0000', {placeholder: 'dd/mm/yyyy'});
                    $("#date").datepicker({firstDay: 1, dateFormat: 'dd-mm-yy'});
                    loadPaymentModule();
                    loadScheduleClient();
                });

                $(document).ready(function () {
                    $("#schedule table tr td").click(function () {
                        var text = $(this).html();
                        var id = $(this).attr("id");
                        id = id.replace("g", "c");
                        if (text.length > 0) {

                            var color = $(this).css('background-color');

                            if (color === "rgb(255, 255, 51)") {
                                alert("Este servicio esta sin cupo por el momento");
                                return;
                            }

                            if (color === "rgb(0, 255, 64)") {
                                $(this).css("background-color", "#ffffff");
                                deleteScheduleClient(id);
                            } else {
                                if (addScheduleClient(id, text)) {
                                    $(this).css("background-color", "#00ff40");
                                }
                            }
                        }
                    });
                });

                function valiteDate(date) {
                    var RegExPattern = /^\d{1,2}\/\d{1,2}\/\d{2,4}$/;
                    if ((date.match(RegExPattern)) && (date != '')) {
                        return true;
                    } else {
                        return false;
                    }
                }

                function add() {

                    if ($("#comboPaymentModule").val() === "-1") {
                        alert("Seleccione un modulo de pago");
                        return;
                    }

//        if (!valiteDate($("#date").val())) {
//            alert("Verifique su fecha para iniciar el servicio");
//            return;
//        }

                    $("#tbgym tbody tr").each(function ()
                    {
                        $(this).children("td").each(function ()
                        {
                            var color = $(this).css('background-color');
                            if (color === "rgb(0, 255, 64)") {
                                var stop = false;
                                var idTd = $(this).attr("id");

                                var hour = idTd.charAt(1);
                                var day = idTd.charAt(2);

                                if (idTd.length === 4) {
                                    hour = idTd.substr(1, 2);
                                    day = idTd.substr(3, 4);
                                }
                                var idService = $("#comboService").val();
                                var name = $(this).html();

                                if ($("#chooseview").val() === "2") {
                                    $.each(idsArray, function (i, index) {
                                        var nameTmp = index.substr(1, (index.length - 1));
                                        if (nameTmp === $("#" + idTd).html() && !stop) {
                                            idService = index.substr(0, 1);
                                            name = nameTmp;
                                            stop = true;
                                        }
                                    });

                                    stop = false;
                                }
                                var msg = "¿Seguro que desea asistir al siguiente servicio? \nServicio: " + name
                                        + "  \nDía: " + getDay(day)
                                        + " \nHora: " + getHour(hour)
                                        + "  \nFecha de inicio: " + $("#date").val()
                                        + " \nModulo de pago: " + $("#comboPaymentModule option:selected").text();

                                if (confirmInsert(msg)) {
                                    $("#msgInsert").html("Espere....");
                                    insertSchedule(idTd, idService, day, hour, $("#date").val(), $("#comboPaymentModule").val());
                                }
                            }
                        });
                    });
                }

                function getDay(day) {
                    var nameDay = "";
                    switch (day) {
                        case "0":
                            nameDay = "Lunes";
                            break;
                        case "1":
                            nameDay = "Martes";
                            break;
                        case "2":
                            nameDay = "Miercoles";
                            break;
                        case "3":
                            nameDay = "Jueves";
                            break;
                        case "4":
                            nameDay = "Viernes";
                            break;
                        default:
                            nameDay = "";
                            break;
                    }
                    return nameDay;
                }

                function getHour(hour) {
                    var nameHour = "";
                    switch (hour) {
                        case "5":
                            nameHour = "5am";
                            break;
                        case "6":
                            nameHour = "6am";
                            break;
                        case "7":
                            nameHour = "7am";
                            break;
                        case "8":
                            nameHour = "8am";
                            break;
                        case "9":
                            nameHour = "9am";
                            break;
                        case "10":
                            nameHour = "10am";
                            break;
                        case "11":
                            nameHour = "11am";
                            break;
                        case "12":
                            nameHour = "12md";
                            break;
                        case "13":
                            nameHour = "1pm";
                            break;
                        case "14":
                            nameHour = "2pm";
                            break;
                        case "15":
                            nameHour = "3pm";
                            break;
                        case "16":
                            nameHour = "4pm";
                            break;
                        case "17":
                            nameHour = "5pm";
                            break;
                        case "18":
                            nameHour = "6pm";
                            break;
                        case "19":
                            nameHour = "7pm";
                            break;
                        case "20":
                            nameHour = "8pm";
                            break;
                        case "21":
                            nameHour = "9pm";
                            break;
                        case "22":
                            nameHour = "10pm";
                            break;
                        default:
                            nameHour = "";
                            break;
                    }
                    return nameHour;
                }

                function insertSchedule(idTd, idService, day, hour, date, module) {
                    $("#msgInsert").html("Estamos trabajando....");
                    $.ajax({
                        type: 'GET',
                        url: "../business/CreateClientRecordAction.php",
                        data: {
                            "idService": idService,
                            "day": day,
                            "hour": hour,
                            "date": getDateInvert(date),
                            "module": module
                        },
                        success: function (data)
                        {
                            if (data === "1") {
                                $("#" + idTd).css("background-color", "#ffffff");
                                $("#msgInsert").html("Su servicio ha sido insertado correctamente :)");
                                loadScheduleClient();
                            } else {
                                insertSchedule(idTd, idService, day, hour, date, module);
                            }
                        },
                        error: function ()
                        {
                            alert("Error show services!");
                        }
                    });
                }

                function confirmInsert(msg) {
                    if (confirm(msg)) {
                        return true;
                    } else {
                        return false;
                    }
                }

                function loadScheduleClient() {
                    $.ajax({
                        type: 'GET',
                        url: "../business/GetScheduleClient.php",
                        data: {
                            "idClient": idClient
                        },
                        success: function (data)
                        {
                            var services = JSON.parse(data);
                            $.each(services, function (i, item) {
                                $("#c" + item.hourclientschedule + item.dayclientschedule).html(item.nameservice);

                                if (validateDateSuperior(getDateToDay(), item.startdateclientschedule))
                                {
                                    $("#c" + item.hourclientschedule + item.dayclientschedule).prop('title', 'El servicio comienza apartir del ' + item.startdateclientschedule);
                                    $("#c" + item.hourclientschedule + item.dayclientschedule).css("background-color", "#ff3300");
                                } else {
                                    $("#c" + item.hourclientschedule + item.dayclientschedule).css("background-color", "#0066ff");
                                }
                            });
                        },
                        error: function ()
                        {
                            alert("Error show services!");
                        }
                    });
                }

                function validateDateSuperior(starDate, endDate) {
                    var valuesStart = starDate.split("-");
                    var valuesEnd = endDate.split("-");

                    // Verificamos que la fecha no sea posterior a la actual
                    var dateStart = new Date(valuesStart[0], (valuesStart[1] - 1), valuesStart[2]);
                    var dateEnd = new Date(valuesEnd[0], (valuesEnd[1] - 1), valuesEnd[2]);
                    if (dateStart >= dateEnd)
                    {
                        return false;
                    }
                    return true;
                }

                function getDateToDay() {
                    var today = new Date();
                    var dd = today.getDate();
                    var mm = today.getMonth() + 1; //January is 0!

                    var yyyy = today.getFullYear();

                    if (dd < 10) {
                        dd = '0' + dd;
                    }
                    if (mm < 10) {
                        mm = '0' + mm;
                    }
                    return today = yyyy + '-' + mm + '-' + dd;
                }

                function loadScheduleGym() {
                    if ($("#chooseview").val() === "1") {
                        getScheduleService();
                    } else {
                        if ($("#chooseview").val() === "2") {
                            getScheduleCampus();
                        }
                    }
                }

                function getScheduleCampus() {
                    clearShedule();
                    $.ajax({
                        type: 'GET',
                        url: "../business/GetScheduleCampus.php",
                        data: {
                            "id": $("#comboCampus").val()
                        },
                        success: function (data)
                        {
                            var services = JSON.parse(data);
                            idsArray = "";
                            var service = "";
                            $.each(services, function (i, item) {
                                service = item.idservicescheduleservice + item.nameservice;
                                if (idsArray.indexOf(service) === -1) {
                                    idsArray += service + "-";
                                }
                                $("#g" + item.hourscheduleservice + item.dayscheduleservice).html(item.nameservice);
                                if (item.quotaservice === "0") {
                                    $("#g" + item.hourscheduleservice + item.dayscheduleservice).css("background-color", "#ffff33");
                                }
                            });
                            idsArray = idsArray.split("-");
                        },
                        error: function ()
                        {
                            alert("Error show services!");
                        }
                    });
                }

                function getScheduleService() {
                    clearShedule();
                    $.ajax({
                        type: 'GET',
                        url: "../business/GetScheduleService.php",
                        data: {
                            "idService": $("#comboService").val(),
                            "idCampus": $("#comboCampus").val()
                        },
                        success: function (data)
                        {
                            var services = JSON.parse(data);
                            $.each(services, function (i, item) {
                                $("#g" + item.hourscheduleservice + item.dayscheduleservice).html(item.nameservice);
                                if (item.quotaservice === "0") {
                                    $("#g" + item.hourscheduleservice + item.dayscheduleservice).css("background-color", "#ffff33");

                                }

                            });

                        },
                        error: function ()
                        {
                            alert("Error show services!");
                        }
                    });
                }

                function addScheduleClient(id, text) {
                    var service = $('#' + id).html();
                    if (service.length > 0) {
                        return confirmMsg(id, text);
                    } else {
                        $('#' + id).html(text);
                        $('#' + id).css("background-color", "#00ff40");
                        return true;
                    }
                    return true;
                }

                function deleteScheduleClient(id) {
                    if (id === idServiceTmp) {
                        $('#' + id).html(serviseTmp);
                        $('#' + id).css("background-color", "#0066ff");
                    } else {
                        $('#' + id).html("");
                        $('#' + id).css("background-color", "#ffffff");
                    }
                }

                function confirmMsg(id, text) {
                    var mensaje = confirm("Ya tienes un servicio asignado en ese espacio ¿Desea reemplazarlo?");
                    if (mensaje) {
                        idServiceTmp = id;
                        serviseTmp = $('#' + id).html();
                        $('#' + id).html(text);
                        $('#' + id).css("background-color", "#00ff40");
                        return true;
                    } else {
                        $('#' + id).css("background-color", "#0066ff");
                        return false;
                    }
                }

                function show() {
                    clearShedule();
                    var selectService = $('#comboService');
                    selectService.val($('option:first', selectService).val());
                    var selectCampus = $('#comboCampus');
                    selectCampus.val($('option:first', selectCampus).val());
                    var selectModule = $('#comboPaymentModule');
                    selectModule.val($('option:first', selectModule).val());
                    $.datepicker.setDefaults($.datepicker.regional["es"]);
                    $("#date").datepicker({
                        dateFormat: 'dd/mm/yy',
                        firstDay: 1
                    }).datepicker("setDate", new Date());
                    switch ($('#chooseview').val()) {
                        case "0":
                            $('#showService').hide();
                            $('#showCampus').hide();
                            $('#thService').hide();
                            $('#thCampus').hide();
                            $('#labelStarDate').hide();
                            $('#labelModule').hide();
                            $('#showDate').hide();
                            $('#showModule').hide();
                            break;
                        case "1":
                            $('#showService').show();
                            $('#showCampus').show();
                            $('#thService').show();
                            $('#thCampus').show();
                            $('#labelStarDate').show();
                            $('#labelModule').show();
                            $('#showDate').show();
                            $('#showModule').show();
                            loadService();
                            break;
                        case "2":
                            $('#showService').hide();
                            $('#showCampus').show();
                            $('#thService').hide();
                            $('#thCampus').show();
                            $('#labelStarDate').show();
                            $('#labelModule').show();
                            $('#showDate').show();
                            $('#showModule').show();
                            loadCampus();
                            break;
                        default :
                            $('#showService').hide();
                            $('#showCampus').hide();
                            $('#thService').hide();
                            $('#thCampus').hide();
                            $('#labelStarDate').hide();
                            $('#labelModule').hide();
                            $('#showDate').hide();
                            $('#showModule').hide();
                            break;
                    }
                }

                function loadPaymentModule() {
                    $.ajax({
                        type: 'GET',
                        url: "../business/GetPaymentModule.php",
                        success: function (data)
                        {
                            var module = JSON.parse(data);
                            var htmlCombo = '<OPTION VALUE="-1">Seleccionar</OPTION>';
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

                function loadService() {
                    clearShedule();
                    $.ajax({
                        type: 'GET',
                        url: "../business/GetService.php",
                        success: function (data)
                        {
                            var services = JSON.parse(data);
                            var htmlCombo = '<OPTION VALUE="-1">Seleccionar</OPTION>';
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
                }

                function loadCampus() {
                    clearShedule();
                    $.ajax({
                        type: 'GET',
                        url: "../business/GetCampus.php",
                        success: function (data)
                        {
                            var campus = JSON.parse(data);
                            var htmlCombo = '<OPTION VALUE="-1">Seleccionar</OPTION>';
                            $.each(campus, function (i, item) {
                                htmlCombo += '<OPTION VALUE="' + item.idcampus + '">' + item.namecampus + '</OPTION>';
                            });
                            $("#comboCampus").html(htmlCombo);
                        },
                        error: function ()
                        {
                            alert("Error show campus!");
                        }
                    });
                }

                function loadCampusService() {
                    clearShedule();
                    var idService = $('#comboService').val();
                    $.ajax({
                        type: 'GET',
                        url: "../business/GetCampusService.php",
                        data: {
                            "idService": idService
                        },
                        success: function (data)
                        {
                            var campus = JSON.parse(data);
                            var htmlCombo = '<OPTION VALUE="-1">Seleccionar</OPTION>';
                            $.each(campus, function (i, item) {
                                htmlCombo += '<OPTION VALUE="' + item.idcampus + '">' + item.namecampus + '</OPTION>';
                            });
                            $("#comboCampus").html(htmlCombo);
                        },
                        error: function ()
                        {
                            alert("Error show services!");
                        }
                    });
                }

                function clearShedule() {
                    clearSheduleGym();
                    clearSheduleClient();
                }

                function clearSheduleGym() {
                    $("#tbgym tbody tr").each(function ()
                    {
                        $(this).children("td").each(function ()
                        {
                            $(this).html("");
                            $(this).css('background-color', "#ffffff");
                        });
                    });
                }

                function clearSheduleClient() {
                    $("#tbclient tbody tr").each(function ()
                    {
                        $(this).children("td").each(function ()
                        {
                            $(this).css("background-color", "#ffffff");
                            $(this).html("");
                        });
                    });
                    loadScheduleClient();
                }

</script>
