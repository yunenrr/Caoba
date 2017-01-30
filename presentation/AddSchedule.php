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
            <table>
                <thead>
                    <tr>
                        <td>Service:</td>
                        <td>Campus:</td>
                        <td>Schedule:</td>
                        <td>Delete:</td>
                    </tr>
                </thead>
                <tbody id="tableSchedule" name="tableSchedule"></tbody>
            </table>
        </div>
    </fieldset>
    <div id="msg"></div>
</div>
<script src="../js/jsSchedule.js" type="text/javascript"></script>
<script src="../js/jsService.js" type="text/javascript"></script>
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
                        $("#selSchedule").html('<option value="0" selected="">Select</option>');
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
                                insertGUI($("#selSchedule").val(),$("#selService option:selected").html(),$("#selCampus option:selected").html(),$("#selDay option:selected").html() +': '+$("#selSchedule option:selected").html(),$("#selService").val());
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
                        $("#msg").html("");
                    }//Fin del if
                    else
                    {
                        $("#msg").html("Please select a service");
                    }//Fin del else
                }//Fin de la función del evento
            );//Fin del evento
    
            //Evento eliminar horarios
            $("#tableSchedule").on
            (
                'click','input.btnDelete', function() 
                {
                    var row = $(this).attr("id");
                    var currentRow = row.substring(9,row.length);
                    deleteScheduleByService(currentRow);
                    $("#selSchedule").html('<option value="0" selected="">Select</option>');
                    $("#selDay").val("0");
                }//Fin de la función del evento
            );//Fin del evento
        }//Fin de la función principal
    );//Fin de la lectura de la página
</script>