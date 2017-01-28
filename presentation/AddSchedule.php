<?php include './header.php' ?>
<div>
    <h2>Add Schedule</h2>
    <fieldset>
        <legend>Current Schedule</legend>
        <div>
            <label>Service:</label>
            <select id="selService" name="selService"></select>
            <label>Campus:</label>
            <select id="selCampus" name="selCampus"></select>
            <label>Day:</label>
            <select id="selDay" name="selDay"></select>
            <label>Schedule:</label>
            <select id="selSchedule" name="selSchedule"></select>
            <button id="btnAddSchedule" name="btnAddSchedule">Add</button>
            <table id="tableSchedule" name="tableSchedule">
                <tr>
                    <td>Boxing</td>
                    <td>01</td>
                    <td>Lunes de 7:00am a 8:00am</td>
                    <td>DELETE</td>
                </tr>
            </table>
        </div>
    </fieldset>
    <div id="msg"></div>
</div>
<script src="../js/jsSchedule.js" type="text/javascript"></script>
<?php include './footer.php' ?>
<script type="text/javascript">
    $(document).ready
    (
        function()
        {
            getSelectAllService();
            getSelectAllCampus();
            
            /************************* EVENTOS ********************************/
            //Evento del select de campus
            $("#selCampus").change
            (
                function()
                {
                    if($("#selCampus").val() !== "-0")
                    {
                        getSelectAllDay();
                    }//Fin del if
                    else
                    {
                        $("#selDay").html('<option value="0" selected="">Select</option>');
                    }//Fin del else
                }//Fin de la función del evento
            );//Fin del evento del select de campus
    
            //Evento del select de días
            $("#selDay").change
            (
                function()
                {
                    if($("#selDay").val() !== "0")
                    {
                        getSelectAllScheduleByCampusDay();
                    }//Fin del if
                    else
                    {
                        $("#selSchedule").html('<option value="0" selected="">Select</option>');
                    }//Fin del else
                }//Fin de la función del evento
            );//Fin del evento del select de días
    
            //Evento de agregar horarios
            $("#btnAddSchedule").on
            (
                'click',function()
                {   
                    if($("#selService").val() !== "0")
                    {
                        if($("#selCampus").val() !== "-0")
                        {
                            if($("#selSchedule").val() !== "0")
                            {
                                insertScheduleByService();
                            }
                            else
                            {
                                $("#msg").html("Please select a schedule");
                            }
                        }
                        else
                        {
                            $("#msg").html("Please select a campus");
                        }
//                        $("#msg").html("");
//                        insertGUI("2",$("#selScheduleByDay").val(),$("#selDay option:selected").html() +': '+$("#selScheduleByDay option:selected").html());
                    }//Fin del if
                    else
                    {
                        $("#msg").html("Please select a service");
                    }//Fin del else
                }//Fin de la función del evento
            );//Fin del evento
        }//Fin de la función principal
    );//Fin de la lectura de la página
</script>