<?php include './header.php' ?>
<div>
    <h2>Renew Service</h2>
    <div>
        <label>Name Service: </label><label id="nameService" name="nameService"></label>
    </div>
    <fieldset>
        <legend>Current Information:</legend>
        <div>
            <label>Date started: </label><label id="dateStarted" name="dateStarted"></label>
        </div>
        <div>
            <label>Date Finished: </label><label id="dateFinished" name="dateFinished"></label>
        </div>
    </fieldset>
    <fieldset>
        <legend>New Information:</legend>
        <div>
            <label>Start date:</label>
            <input type="date" class="date" id="txtStartDate" name="txtStartDate" required=""/>
            <label>*</label>
        </div>
        <div>
            <label>Periodicity:</label>
            <select id="selPeriodicity" name="selPeriodicity">
                <option value="1">Monthly</option>
                <option value="6">Biannual</option>
                <option value="12">Annual</option>
            </select>
            <label>*</label>
        </div>
        <div>
            <button id="btnRenew" name="btnRenew">Renew</button>
        </div>
        <div>
            <p>* = Required</p>
        </div>
    </fieldset>
    <div id="msg"></div>
</div>
<script src="../js/jsMessage.js" type="text/javascript"></script>
<script src="../js/jsValidation.js" type="text/javascript"></script>
<script src="../js/jsService.js" type="text/javascript"></script>
<?php include './footer.php' ?>
<script type="text/javascript">
    $(document).ready
    (
        function()
        {
            if ($.getURLParam("id")=== null || $.getURLParam("id").length === 0) 
            {
                document.location.href = "ViewService.php";
            }//Fin del if
            var id = $.getURLParam("id");
            getCurrentService();
            $('.date').mask('00-00-0000');
            
            /**
             * Función que nos permite obtener la información sobre el servicio actual.
             * */
            function getCurrentService()
            {
                var infoData = "option=9&id="+id;
                $.ajax
                (
                    {
                        type: 'POST',
                        url: "../business/ServiceBusiness.php",
                        data: infoData,
                        beforeSend: function(before)
                        {
                            $("#msg").html(getWaitMessage());
                        },
                        success: function(data)
                        {
                            if(data.toString().length > 0)
                            {
                                var arrayTemp = data.split(",");
                                $("#nameService").html(arrayTemp[2]);
                                $("#dateStarted").html(getDateInvert(arrayTemp[5]));
                                $("#dateFinished").html(getDateInvert(arrayTemp[6]));
                                $("#msg").html("");
                            }//Fin del if
                            else
                            {
                                $("#msg").html(getErrorMessage(5));
                            }
                        },
                        error:function()
                        {
                            $("#msg").html(getErrorMessage(5));
                        }
                    }
                );
            }//Fin de la función
            
            /**
             * Función que realiza las validaciones.
             * @return {boolean} True: Si cumple las validaciones / False: En caso contrario.
             * */
            function validation()
            {
                var flag = true;
                
                //Validamos que el campo no esté vacío
                if(validateEmptyField($("#txtEndDate").val()))
                {
                    flag = false;
                    $("#msg").html(getErrorMessage(1));
                }//Fin del if
                else
                {
                    //Validamos que la fecha sea valida
                    if(validateDate($("#txtStartDate").val()))
                    {
                        //Comparamos la fecha ingresada con la fecha actual
                        if(!compareDateWithCurrentDate($("#txtStartDate").val()))
                        {
                            $("#msg").html(getErrorMessage(6));
                        }//Fin del if
                    }//Fin del if
                    else
                    {
                        flag = false;
                        $("#msg").html(getErrorMessage(4));
                    }//Fin del else
                }//Fin del else
                
                return flag;
            }//Fin de la función
            
            /***************************** EVENTOS ****************************/
            $("#btnRenew").on
            (
                'click',function()
                {
                    if(validation())
                    {
                        var infoData = "option=6"+
                                "&txtID="+id +
                                "&txtStartDate="+getDateInvert($("#txtStartDate").val()) +
                                "&selPeriodicity="+$("#selPeriodicity").val();
                        $.ajax
                        (
                            {
                                type: 'POST',
                                url: "../business/ServiceBusiness.php",
                                data: infoData,
                                beforeSend: function(before)
                                {
                                    $("#msg").html(getWaitMessage());
                                },
                                success: function(data)
                                {
                                    if(data.toString() !== "0")
                                    {
                                        $("#msg").html(getSuccessfullyInsertedMessage(3));
                                        $().delay(100);
                                        location.href = "ViewService.php";
                                    }
                                    else
                                    {
                                        $("#msg").html(getErrorMessage(5));
                                    }
                                },
                                error:function()
                                {
                                    $("#msg").html(getErrorMessage(5));
                                }
                            }
                        );
                    }//Fin del if
                }//Fin de la función del evento
            );//Evento de escuchar el boton
        }//Fin de la función principal
    );//Fin de la lectura de la página
</script>