<?php
include './header.php'; //header include
?> 
<div id="client">
    <div >
        <form  id="form" >
            <div id="ok"></div>
            <table border="1px" cellpadding="15px">

                <!--head row-->
                <tr>
                    <!--columns-->
                    <td><strong>transverseThorax</strong></td>
                    <td><input type="number" name="transverseThorax" required value="1"></td>

                </tr>
                <tr>
                    <!--columns-->
                    <td><strong>backThorax</strong></td>
                    <td><input type="number" name="backThorax" required value="1"></td>

                </tr>
                <tr>
                    <!--columns-->
                    <td><strong>biiliocrestideo</strong></td>
                    <td><input type="number" name="biiliocrestideo" required value="1"></td>

                </tr>
                <tr>
                    <!--columns-->
                    <td><strong>humeral</strong></td>
                    <td><input type="number" name="humeral" required value="1"></td>

                </tr>
                <tr>
                    <!--columns-->
                    <td><strong>femoral</strong></td>
                    <td><input type="number" name="femoral" required value="1"></td>

                </tr>
                <tr>
                    <!--columns-->
                    <td><strong>head</strong></td>
                    <td><input type="number" name="head" required value="1"></td>

                </tr>
                <tr>
                    <!--columns-->
                    <td><strong>armRelaxed</strong></td>
                    <td><input type="number" name="armRelaxed" required value="1"></td>

                </tr>
                <tr>
                    <!--columns-->
                    <td><strong>armFlexed</strong></td>
                    <td><input type="number" name="armFlexed" required value="1"></td>
                </tr>
                <tr>
                    <!--columns-->
                    <td><strong>forearmt</strong></td>
                    <td><input type="number" name="forearmt" required value="1"></td>

                </tr>
                <tr>
                    <!--columns-->
                    <td><strong>mesosternalThorax</strong></td>
                    <td><input type="number" name="mesosternalThorax" required value="1"></td>

                </tr>
                <tr>
                    <!--columns-->
                    <td><strong>waist</strong></td>
                    <td><input type="number" name="waist" required value="1"></td>

                </tr>
                <tr>
                    <!--columns-->
                    <td><strong>hip</strong></td>
                    <td><input type="number" name="hip" required value="1"></td>

                </tr>
                <tr>
                    <!--columns-->
                    <td><strong>innerThigh</strong></td>
                    <td><input type="number" name="innerThigh" required value="1"></td>

                </tr>
                <tr>
                    <!--columns-->
                    <td><strong>upperThigh</strong></td>
                    <td><input type="number" name="upperThigh" required value="1"></td>

                </tr>
                <tr>
                    <!--columns-->
                    <td><strong>calfMax</strong></td>
                    <td><input type="number" name="calfMax" required value="1"></td>

                </tr>
                <tr>
                    <!--columns-->
                    <td><strong>triceps</strong></td>
                    <td><input type="number" name="triceps" required value="1"></td>

                </tr>
                <tr>
                    <!--columns-->
                    <td><strong>subscapular</strong></td>
                    <td><input type="number" name="subscapular" required value="1"></td>

                </tr>
                <tr>
                    <!--columns-->
                    <td><strong>supraspiral</strong></td>
                    <td><input type="number" name="supraspiral" required value="1"></td>

                </tr>
                <tr>
                    <!--columns-->
                    <td><strong>abdominal</strong></td>
                    <td><input type="number" name="abdominal" required value="1"></td>

                </tr>
                <tr>
                    <!--columns-->
                    <td><strong>medialThigh</strong></td>
                    <td><input type="number" name="medialThigh" required value="1"></td>

                </tr>
                <tr>
                    <!--columns-->
                    <td><strong>calf</strong></td>
                    <td><input type="number" name="calf" required value="1"></td>

                </tr>

            </table>
            <input id="btn_enviar" type="submit">
        </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        ajaxRequest('../business/returnClientAction.php');
    });
    function domAdd(data) {
        var types = JSON.parse(data);
        $("#client").prepend("<p>Name:" + types[0].namePerson + "</p><p>Dni: " + types[0].dniPerson + "</p>");
    }
    function ajaxRequest(path) {
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
            alert('s');
            var dataString = $("#form").serializeArray();
            dataString.push({name: 'idPersonMeasurement', value: $.get("dni")});

            var url = "../business/InsertMeasurementAction.php"; // El script a dónde se realizará la petición.
            $.ajax({
                type: "POST",
                url: url,
                data: dataString, // Adjuntar los campos del formulario enviado.
                success: function (dataString)
                {
                    alert('3s');
                },
                error: function (dataString)
                {
                    alert('sxx');
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
        }
    })(jQuery);
//    
//    $(document).ready(function() {
//    $("#ok").hide();
//    $("#form").validate({
//    rules: {
//    transverseThorax: { required: true, minlength: 2},
//            backThorax: { required: true, minlength: 2},
//            biiliocrestideo { required:true, email: true},
//            humeral: { minlength: 2, maxlength: 15},
//            femoral: { required: true},
//            head: { required:true, minlength: 2},
//            armRelaxed: { required:true, minlength: 2},
//            armFlexed: { required:true, minlength: 2},
//            forearmt: { required:true, minlength: 2},
//            mesosternalThorax: { required:true, minlength: 2},
//            waist: { required:true, minlength: 2},
//            hip: { required:true, minlength: 2},
//            innerThigh: { required:true, minlength: 2},
//            upperThigh: { required:true, minlength: 2},
//            calfMax: { required:true, minlength: 2},
//            triceps: { required:true, minlength: 2},
//            subscapular: { required:true, minlength: 2},
//            supraspiral: { required:true, minlength: 2},
//            abdominal: { required:true, minlength: 2},
//            medialThigh: { required:true, minlength: 2},
//            calf: { required:true, minlength: 2}
//    },
//            messages: {
//            transverseThorax: "Debe introducir su nombre.",
//                    backThorax: "Debe introducir su apellido.",
//                    biiliocrestideo: "Debe introducir un email válido.",
//                    humeral : "El número de teléfono introducido no es correcto.",
//                    femoral : "Debe introducir solo números.",
//                    head : "El campo Mensaje es obligatorio.",
//                    armRelaxed : "El campo Mensaje es obligatorio.",
//                    armFlexed : "El campo Mensaje es obligatorio.",
//                    mesosternalThorax : "El campo Mensaje es obligatorio.",
//                    forearmt : "El campo Mensaje es obligatorio.",
//                    waist : "El campo Mensaje es obligatorio.",
//                    hip : "El campo Mensaje es obligatorio.",
//                    innerThigh : "El campo Mensaje es obligatorio.",
//                    upperThigh: "El campo Mensaje es obligatorio.",
//                    calfMax : "El campo Mensaje es obligatorio.",
//                    triceps: "El campo Mensaje es obligatorio.",
//                    subscapular : "El campo Mensaje es obligatorio.",
//                    supraspiral: "El campo Mensaje es obligatorio.",
//                    abdominal : "El campo Mensaje es obligatorio.",
//                    medialThigh : "El campo Mensaje es obligatorio.",
//                    subscapular : "El campo Mensaje es obligatorio.",
//                    calf : "El campo Mensaje es obligatorio.",
//            },
//            submitHandler: function(form){
//            var dataString = $("#form").serializeArray();
//            dataString.push({name: 'idPersonMeasurement', value: $.get("dni")});
////            alert('as');
////            $.ajax({
////            type: "POST",
////                    url:"../business/InsertMeasurementAction.php",
////                    data: dataString,
////                    success: function(data){
////                    $("#ok").html(data);
////                    $("#ok").show();
////                    $("#formid").hide();
////                    }
////                    error: function(data){
////                    $("#ok").html(data);
////                    $("#ok").show();
////                    $("#formid").hide();
////                    }
////            });
//            }
//    });
</script>

