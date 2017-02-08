<?php
session_start();
include './header.php';
if (false) {
    
}
?>
<div>
    <form name="insertExercise" action="../business/CreateNewExerciseAction.php" method="POST">
        <label>All Exercises</label>
        <select id="idexercise" name="idexercise" SIZE=1></select>
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

        <input name="submit" type="submit" value="Create"/>
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
                var htmlCombo = '';
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
