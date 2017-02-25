<?php
include './header.php'; //header include
?> 

<div >
    <form  id="form" >
        <div id="ok"> 
            <!--<img src="./Graph.php?id=<?php // echo $_GET['id']                                    ?>" alt="" border="0">-->
        </div>
        <table border="1px" cellpadding="1px">
            <!--head row-->
            <tr>
                <!--columns-->
                <td><strong>transverseThorax</strong></td>
                <td><input type="number" name="transverseThorax" required value="1"></td>
                <td><strong>backThorax</strong></td>
                <td><input type="number" name="backThorax" required value="1"></td>
                <!--columns-->
                <td><strong>biiliocrestideo</strong></td>
                <td><input type="number" name="biiliocrestideo" required value="1"></td>
                <td><strong>humeral</strong></td>
                <td><input type="number" name="humeral" required value="1"></td>
                <td><strong>femoral</strong></td>
                <td><input type="number" name="femoral" required value="1"></td>

            </tr>
            <tr>
                <td><strong>head</strong></td>
                <td><input type="number" name="head" required value="1"></td>

                <td><strong>armRelaxed</strong></td>
                <td><input type="number" name="armRelaxed" required value="1"></td>
                <td><strong>armFlexed</strong></td>
                <td><input type="number" name="armFlexed" required value="1"></td>
                <td><strong>forearmt</strong></td>
                <td><input type="number" name="forearmt" required value="1"></td>
                <td><strong>mesosternalThorax</strong></td>
                <td><input type="number" name="mesosternalThorax" required value="1"></td>


            </tr>
            <tr>
                <td><strong>waist</strong></td>
                <td><input type="number" name="waist" required value="1"></td>
                <td><strong>hip</strong></td>
                <td><input type="number" name="hip" required value="1"></td>
                <!--columns-->
                <td><strong>innerThigh</strong></td>
                <td><input type="number" name="innerThigh" required value="1"></td>

                <td><strong>upperThigh</strong></td>
                <td><input type="number" name="upperThigh" required value="1"></td>

                <td><strong>calfMax</strong></td>
                <td><input type="number" name="calfMax" required value="1"></td>



            </tr>
            <tr>

                <td><strong>triceps</strong></td>
                <td><input type="number" name="triceps" required value="1"></td>


                <td><strong>subscapular</strong></td>
                <td><input type="number" name="subscapular" required value="1"></td>

                <td><strong>supraspiral</strong></td>
                <td><input type="number" name="supraspiral" required value="1"></td>
                <!--columns-->
                <td><strong>abdominal</strong></td>
                <td><input type="number" name="abdominal" required value="1"></td>

                <td><strong>medialThigh</strong></td>
                <td><input type="number" name="medialThigh" required value="1"></td>
            </tr>

            <tr>
                <td><strong>calf</strong></td>
                <td><input type="number" name="calf" required value="1"></td>
                <td><strong>Peso(kg)</strong></td>
                <td><input type="number" name="weight" required value="1"></td>
                <td><strong>Altura(Mts)</strong></td>
                <td><input type="number" name="height" required value="1"></td>
            </tr>
        </table>
        <input type="submit" value=" Registrar" id="btn_enviar"/>

    </form>

</div>
<!--<div id="client">
</div>-->
<div id="meansu">

</div>

<script type="text/javascript">
    $(document).ready(function () {
        ajaxGetClientData('../business/returnClientAction.php');
        ajaxGetClientHistory('../business/returnMeasurementAction.php');
        ajaxGetMeasurementQuantity();
    });
    function domAdd(data) {
        var types = JSON.parse(data);
        $("#client").prepend("<p>Nombre:" + types[0].nameperson + "</p><p>ID: " + types[0].idperson + "</p>");
        $("#client").prepend("<H1>Datos del cliente</H1>");
    }
    function chargeTable(types) {
        $("#meansu1").empty();
        $("#meansu2").empty();
        $("#meansu3").empty();
        $("#meansu4").empty();
        $("#meansu5").empty();
        $("#meansu6").empty();
        $("#meansu7").empty();
        $("#meansu8").empty();
        $("#meansu9").empty();
        $("#meansu10").empty();
        $("#meansu11").empty();
        $("#meansu12").empty();
        $("#meansu13").empty();
        $("#meansu14").empty();
        $("#meansu15").empty();
        $("#meansu16").empty();
        $("#meansu17").empty();
        $("#meansu18").empty();
        $("#meansu19").empty();
        $("#meansu20").empty();
        $("#meansu21").empty();
        $("#meansu22").empty();
        $("#meansu23").empty();
        $("#meansu24").empty();
        $("#meansu25").empty();
        $("#meansu").empty();
        var table = "<table border=\"1px\" cellpadding=\"5px\"> <tr id=\"meansu1\"><td><strong>Fechas -->></strong></td></tr>";
        table = table + "</td></tr><tr id=\"meansu24\"><td><strong>***Peso ***</strong></td></tr>";
        table = table + "<tr id=\"meansu25\"><td><strong>***Grasa Total***</strong></td></tr>";
        table = table + "<tr id=\"meansu23\"><td><strong>***Masa Muscular***</strong><tr id=\"meansu2\"><td>transverseThorax</td></tr>";
        table = table + "<tr id=\"meansu3\"><td>backThorax</td> </tr><tr id=\"meansu4\"><td>biiliocrestideo</td> </tr>";
        table = table + "<tr id=\"meansu5\"><td>humeral</td></tr><tr id=\"meansu6\"><td>femoral</td></tr>";
        table = table + "<tr id=\"meansu7\"><td>head</td></tr><tr id=\"meansu8\"><td>armRelaxed</td></tr>";
        table = table + "<tr id=\"meansu9\"><td>armFlexed</td></tr><tr id=\"meansu10\"><td>forearm</td></tr>";
        table = table + "<tr id=\"meansu11\"><td>mesosternalthorax</td></tr><tr id=\"meansu12\"><td>waistt</td></tr>";
        table = table + "<tr id=\"meansu13\"><td>hip</td></tr><tr id=\"meansu14\"><td>innerthigh</td></tr>";
        table = table + "<tr id=\"meansu15\"><td>upperthigh</td></tr><tr id=\"meansu16\"><td>calfmax</td></tr>";
        table = table + "<tr id=\"meansu17\"><td>triceps</td></tr><tr id=\"meansu18\"><td>subscapular</td></tr>";
        table = table + "<tr id=\"meansu19\"><td>supraspiral</td></tr><tr id=\"meansu20\"><td>abdominal</td></tr>";
        table = table + "<tr id=\"meansu21\"><td>medialthigh</td></tr><tr id=\"meansu22\"><td>calf</td></tr></table>";
        $("#meansu").append(table);

        for (i in types)
        {
            $("#meansu1").append("<td>" + types[i].measurementDate + "</td>");
            $("#meansu2").append("<td>" + types[i].transverseThorax + "</td>");
            $("#meansu3").append("<td>" + types[i].backThorax + "</td>");
            $("#meansu4").append("<td>" + types[i].biiliocrestideo + "</td>");
            $("#meansu5").append("<td>" + types[i].humeral + "</td>");
            $("#meansu6").append("<td>" + types[i].femoral + "</td>");
            $("#meansu7").append("<td>" + types[i].head + "</td>");
            $("#meansu8").append("<td>" + types[i].armRelaxed + "</td>");
            $("#meansu9").append("<td>" + types[i].armFlexed + "</td>");
            $("#meansu10").append("<td>" + types[i].forearm + "</td>");
            $("#meansu11").append("<td>" + types[i].mesosternalThorax + "</td>");
            $("#meansu12").append("<td>" + types[i].waist + "</td>");
            $("#meansu13").append("<td>" + types[i].hip + "</td>");
            $("#meansu14").append("<td>" + types[i].innerThigh + "</td>");
            $("#meansu15").append("<td>" + types[i].upperThigh + "</td>");
            $("#meansu16").append("<td>" + types[i].calfMax + "</td>");
            $("#meansu17").append("<td>" + types[i].triceps + "</td>");
            $("#meansu18").append("<td>" + types[i].subscapular + "</td>");
            $("#meansu19").append("<td>" + types[i].supraspiral + "</td>");
            $("#meansu20").append("<td>" + types[i].abdominal + "</td>");
            $("#meansu21").append("<td>" + types[i].medialThigh + "</td>");
            $("#meansu22").append("<td>" + types[i].calf + "</td>");
            $("#meansu23").append("<td>" + types[i].musclemass + "</td>");
            $("#meansu24").append("<td>" + types[i].weight + "</td>");
            $("#meansu25").append("<td>" + types[i].totalfat + "</td>");
//            $("#meansu26").append("<td>" + types[i].height + "</td>");
        }
        $("#meansu").prepend("<H1>Historial del Cliente</H1>");
    }

    function domAdd2(data) {
        var types = JSON.parse(data);
        if (types.length >= 1) {
            chargeTable(types);
        } else {
        }
    }
    function test() {
        $.ajax({
            url: './Graph.php',
            type: 'GET',
            data: {"id": $.get("id")},
            success: function (res) {
            },
            error: function (res) {
            }
        });
    }
    function ajaxGetMeasurementQuantity() {
        $.ajax({
            url: '../business/ReturnMeasurementQuantity.php',
            type: 'POST',
            dataType: 'json',
            data: {"id": $.get("id")},
            success: function (res) {
                var result = JSON.stringify(res);
                var types = JSON.parse(result);
                if (types.msg !== "si") {
                    $("#ok").empty();
                    $("#ok").prepend("<h4>Ingrese al menos dos medidas para observar grafico</h4>");
                } else {
                    test();
                    $("#ok").empty();
                    $("#ok").prepend("<img src=\"./Graph.php?id=" + $.get("id") + "\" border=\"0\">");
                }
            },
            error: function (res) {
            }
        });
    }
    function ajaxGetClientHistory(path) {
        $.ajax({
            url: path,
            type: 'POST',
            dataType: 'json',
            data: {"id": $.get("id")},
            success: function (res) {
                var result = JSON.stringify(res);
                domAdd2(result);
            },
            error: function (res) {
            }
        });
    }
    function ajaxGetClientData(path) {
        $.ajax({
            url: path,
            type: 'POST',
            dataType: 'json',
            data: {"id": $.get("id")},
            success: function (res) {
                var result = JSON.stringify(res);
                domAdd(result);
            },
            error: function (res) {
                domAdd('error');
            }
        });
    }
    $(function send(data) {
        $("#btn_enviar").click(function () {
            var dataString = $("#form").serializeArray();
            dataString.push({name: 'idPersonMeasurement', value: $.get("id")});
            var url = "../business/InsertMeasurementAction.php"; // El script a dónde se realizará la petición.
            $.ajax({
                type: "POST",
                url: url,
                data: dataString, // Adjuntar los campos del formulario enviado.
                success: function (data)
                {
                    ajaxGetClientHistory('../business/returnMeasurementAction.php');
                    ajaxGetMeasurementQuantity();

                },
                error: function (data)
                {
                }
            });
            return false; // Evitar ejecutar el submit del formulario.
        });
    });
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
        };
    })(jQuery);
</script>
