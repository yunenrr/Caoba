<?php include './header.php' ?>
<div>
    <h2>Add Schedule</h2>
    <fieldset>
        <legend>Current Schedule</legend>
        <div>
            <label>Service:</label>
            <select id="selService" name="selService"></select>
        </div>
        <div>
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
<?php include './footer.php' ?>
<script type="text/javascript">
    $(document).ready
    (
        function()
        {
            getSelectAllService();
            
            /***************************** EVENTOS ****************************/
            //Evento del select de servicios.
            $("#selService").change
            (
                function()
                {
                    $("#tableSchedule").html("");
                    if($("#selService").val() !== "0")
                    {
                        getRowTableCurrentSchedule($("#selService").val(),$("#selService option:selected").html());
                    }//Fin del if
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
                }//Fin de la función del evento
            );//Fin del evento
        }//Fin de la función principal
    );//Fin de la lectura de la página
</script>