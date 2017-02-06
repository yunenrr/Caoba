<?php
session_start();
include './header.php';
if (false) {
    
}
?>
<div>

    <form name="updateExercise" action="../business/UpdateExerciseAction.php" method="POST">

        <select id="idexercise" name="idexercise" SIZE=1 onchange="load();"></select>
        <br>
        <br>
        <table>
            <tr>
                <td>
                    <label>Exercise: </label>
                </td>
                <td>
                    <input id="exercise" name="exercise" type="text" placeholder="Name Exercise" />
                </td>
            </tr>
        </table>

        <input id="submit" name="submit" type="submit" value="Update"/>
    </form>
</div>

<script>
    $(function () {
        $.ajax({
            type: 'GET',
            url: "../business/GetExercise.php",
            success: function (data)
            {
                var exercise = JSON.parse(data);
                var htmlCombo = '<OPTION VALUE="-1">SELECT</OPTION>';
                $.each(exercise, function (i, item) {
                    htmlCombo += '<OPTION VALUE="' + item.idexercise + '">' + item.nameexercise + '</OPTION>';
                });
                $("#idexercise").html(htmlCombo);
            },
            error: function ()
            {
                alert("Error show services!");
            }
        });
    });

    function load() {

        var data = {
            "id": $('#idexercise').val()
        };

        $.ajax({
            type: 'GET',
            url: "../business/GetExercise.php",
            data: data,
            success: function (data)
            {
                var exercise = JSON.parse(data);
                $.each(exercise, function (i, item) {
                    $('#exercise').val(item.nameexercise);
                });
            },
            error: function ()
            {
                alert("Error show services!");
            }
        });
    }
</script>
