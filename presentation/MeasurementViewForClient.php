<?php
include './header.php'; //header include
?> 
<div >
    <img src="./Graph.php?id=0" alt="" border="0">
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
        $("#client").prepend("<p>Nombre:" + types[0].nameperson + "</p><p> Id: " + types[0].idperson + "</p>");
        $("#client").prepend("<H1>Datos del Cliente</H1>");
    }
    function domAdd2(data) {
        var types = JSON.parse(data);
        $("#meansu").empty();
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
        $("#meansu").prepend("<H1>Historial de medidas</H1>");
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
                domAdd('error');
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
