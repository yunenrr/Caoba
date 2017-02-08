<?php
session_start();
include './header.php';
if (false) {
    
}
?>
<div>

    <form name="updateExercise" action="../business/DeleteExerciseAction.php" method="POST">

        <select id="idexercise" name="idexercise" SIZE=1></select>

        <input id="submit" name="submit" type="submit" value="Delete"/>
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
</script>
