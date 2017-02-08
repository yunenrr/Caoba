<?php
include './header.php'; //header include
?> 

<div >
    <form  id="form" >
        <div id="ok"></div>
        <table border="1px" cellpadding="15px">

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

            </tr>

        </table>
        <input type="submit" value=" SEND " id="btn_enviar"/>

    </form>
</div>
<div id="client">
</div>
<div id="meansu">
</div>
<script type="text/javascript">
    $(document).ready(function () {
        ajaxGetClientData('../business/returnClientAction.php');
        ajaxGetClientHistory('../business/returnMeasurementAction.php');
    });
    
    
    function domAdd(data) {
        var types = JSON.parse(data);
//        $("#client").prepend("<H1>CLIENT DATA</H1>");
        $("#client").prepend("<p>Name:" + types[0].namePerson + "</p><p>Dni: " + types[0].dniPerson + "</p>");
        $("#client").prepend("<H1>CLIENT DATA</H1>");
    }
    function domAdd2(data) {
        var types = JSON.parse(data);
        $("#meansu").empty()
        for (i in types)
        {
            $("#meansu").prepend("<h4>Date: " + types[i].measurementDate + "</h4>");
            $("#meansu").prepend("<h4>transverseThorax: " + types[i].transverseThorax + "</h4>");
            $("#meansu").prepend("<h4>backThorax: " + types[i].backThorax + "</h4>");
            $("#meansu").prepend("<h4>biiliocrestideo: " + types[i].biiliocrestideo + "</h4>");
            $("#meansu").prepend("<h4>humeral: " + types[i].humeral + "</h4>");
            $("#meansu").prepend("<h4>femoral: " + types[i].femoral + "</h4>");
            $("#meansu").prepend("<h4>head: " + types[i].head + "</h4>");
            $("#meansu").prepend("<h4>armRelaxed: " + types[i].armRelaxed + "</h4>");
            $("#meansu").prepend("<h4>armFlexed: " + types[i].armFlexed + "</h4>");
            $("#meansu").prepend("<br/>");
        }
        $("#meansu").prepend("<H1>CLIENT HISTORY</H1>");
    }

    function ajaxGetClientHistory(path) {
        $.ajax({
            url: path,
            type: 'POST',
            dataType: 'json',
            data: {"dni": $.get("dni")},
            success: function (res) {
                var result = JSON.stringify(res);
//                alert(res);
                domAdd2(result);

            },
            error: function (res) {
                domAdd('error');
            }
        });
    }

    function ajaxGetClientData(path) {
        $.ajax({
            url: path,
            type: 'POST',
            dataType: 'json',
            data: {"dni": $.get("dni")},
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
            dataString.push({name: 'idPersonMeasurement', value: $.get("dni")});
            var url = "../business/InsertMeasurementAction.php"; // El script a dónde se realizará la petición.
            $.ajax({
                type: "POST",
                url: url,
                data: dataString, // Adjuntar los campos del formulario enviado.
                success: function (data)
                {
                    ajaxGetClientHistory('../business/returnMeasurementAction.php');
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
