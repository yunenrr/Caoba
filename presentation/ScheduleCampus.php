<?php include './header.php' ?>
<div>
    <h1>Schedule Campus:</h1>
    <div>
        <label>Campus:</label>
        <select id="selCampus" name="selCampus"></select>
    </div>
    <div>
        <label>Add Schedule:</label><label id="lblAddSchedule"></label>
    </div>
    <div>
        <label>Services:</label>
        <select id="selService" name="selService"></select>
    </div>
    <button id="btnAdd">Add</button>
    <div>
        <label>Remove Schedule:</label><label id="lblRemoveSchedule"></label>
    </div>
    <button id="btnRemove">Remove</button>
    <fieldset>
        <legend>Current Schedule:</legend>
        <table>
            <thead>
                <tr>
                    <td>Schedule</td>
                    <td>Monday</td>
                    <td>Tuesday</td>
                    <td>Wednesday</td>
                    <td>Thursday</td>
                    <td>Friday</td>
                </tr>
            </thead>
            <tbody id="tableSchedule">
            </tbody>
        </table>
    </fieldset>
    <div id="msg"></div>
</div>
<script src="../js/jsSchedule.js" type="text/javascript"></script>
<script src="../js/jsService.js" type="text/javascript"></script>
<script src="../js/jsMessage.js" type="text/javascript"></script>
<script src="../js/jsValidation.js" type="text/javascript"></script>
<?php include './footer.php' ?>
<script type="text/javascript">
    $(document).ready
    (
        function()
        {
            var arrayScheduleDB = "";
            var arrayScheduleAdd = "";
            var arrayScheduleRemove = "";
            var arrayService = "";
            getSelectAllService();
            getAllService();
            getSelectAllCampus();
            getScheduleByCampus("0");
            
            function getScheduleByCampus(idCampus)
            {
                var infoData = "option=1&idCampus="+idCampus;

                $.ajax
                (
                    {
                        type: 'POST',
                        url: "../business/ScheduleServiceBusiness.php",
                        data: infoData,
                        beforeSend: function(before)
                        {
                            $("#msg").html(getWaitMessage());
                        },
                        success: function(data)
                        {
                            $("#msg").html("");
                            if(data.toString().length > 0)
                            {
                                arrayScheduleDB = data.split(";");
                                fillTableSchedule();
                            }
                            else
                            {
                                fillTableSchedule();
                            }
                        },
                        error:function()
                        {
                            $("#msg").html(getErrorMessage(5));
                        }
                    }//Fin de las llaves AJAX
                );//Fin del AJAX
            }//Fin de la función
            
            /**
            * Función que se encarga de llenar la tabla de horarios.
            * */
            function fillTableSchedule()
            {
                var temp = "";
                
                //Ciclo para llenar las horas
                for(var i = 5; i < 22;i++)
                {
                    temp = temp+'<tr id="trH'+i+'"><td>'+getFormatHour(i)+' - '+getFormatHour(i+1)+'</td>';
                    //Ciclo para los días
                    for(var j = 0; j < 5; j++)
                    {
                        var idService = searchInArrayDB(i,j);
                        
                        if(idService !== "-0")
                        {
                            temp = temp + '<td class="tdField" id="td'+i+'-'+j+'-'+idService+'">'+getNameService(idService)+'</td>';
                        }
                        else{temp = temp + '<td class="tdField" id="td'+i+'-'+j+'-0"></td>';}
                    }//Fin del for
                    temp = temp+"</tr>";
                }//Fin del for
                $("#tableSchedule").html(temp);
            }//Fin de la función
            
            function searchInArrayDB(hour,day)
            {
                var answer = "-0";
                var arrayTemp = "";
                //Ciclo para el arreglo de horarios de la base de datos
                for(var k = 0; k < arrayScheduleDB.length; k++)
                {
                    var currentSchedule = arrayScheduleDB[k].split(",");

                    //Pregunta si es el mismo día y hora
                    if(parseInt(currentSchedule[0]) === hour && parseInt(currentSchedule[1]) === day)
                    {
                        answer = currentSchedule[2];
                    }//Fin del if
                    arrayTemp = arrayTemp + arrayScheduleDB[k] + ";";
                }//Fin del for   
                arrayTemp = arrayTemp.substring(0,arrayTemp.length-1);
                arrayScheduleDB = arrayTemp.split(";");
                return answer;
            }//Fin de la función
            
            function searchInArraySchedule(array,hour,day)
            {
                var answer = false; //No existe
                
                if(array.length > 0)
                {
                    var arrayTemp = array.split(";");

                    //Ciclo para el arreglo de horarios de la base de datos
                    for(var k = 0; k < arrayTemp.length; k++)
                    {
                        var currentSchedule = arrayTemp[k].split("-");

                        //Pregunta si es el mismo día y hora
                        if(currentSchedule[0] === hour && currentSchedule[1] === day)
                        {
                            answer = true;
                        }//Fin del if
                    }//Fin del for   
                }//Fin del if
                
                return answer;
            }//Fin de la función
            
            function getNameService(idService)
            {
                var answer = "";
                var arrayTemp = arrayService.split(";");

                //Ciclo para el arreglo de horarios de la base de datos
                for(var k = 0; k < arrayTemp.length; k++)
                {
                    var currentService = arrayTemp[k].split(",");

                    //Pregunta si es el mismo día y hora
                    if(currentService[0] === idService)
                    {
                        answer = currentService[1];
                    }//Fin del if
                }//Fin del for
                
                return answer;
            }//Fin de la función
            
            function addToArray(idField)
            {
                var answer = false;
                var arrayTemp = idField.split("-");
                
                //Preguntamos si es agregar
                if(arrayTemp[2] === "0")
                {
                    //Verificamos que no existe actualmente
                    if(!searchInArraySchedule(arrayScheduleAdd,arrayTemp[0],arrayTemp[1]))
                    {
                        var text = $("#lblAddSchedule").text() + getDay(arrayTemp[1]) + ": " + getFormatHour(parseInt(arrayTemp[0])) + " - " + getFormatHour(parseInt(arrayTemp[0])+1) + " ";
                        $("#lblAddSchedule").text(text);
                        arrayScheduleAdd = arrayScheduleAdd  + idField + ";";
                    }//Fin del if
                    answer = true;
                }//Fin del if
                else
                {
                    //Verificamos que no existe actualmente
                    if(!searchInArraySchedule(arrayScheduleRemove,arrayTemp[0],arrayTemp[1]))
                    {
                        var text = $("#lblRemoveSchedule").text() + getDay(arrayTemp[1]) + ": " + getFormatHour(parseInt(arrayTemp[0])) + " - " + getFormatHour(parseInt(arrayTemp[0])+1) + " ";
                        $("#lblRemoveSchedule").text(text);
                        arrayScheduleRemove = arrayScheduleRemove  + idField + ";";
                    }//Fin del
                    answer = false;
                }//Fin del else
                return answer;
            }//Fin de la función
            
            function getAllService()
            {
                var infoData = "option=1";

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
                                arrayService = data;
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
            }//Fin de la función
            
            /**************************** EVENTOS *****************************/
            $("#selCampus").change
            (
                function()
                {
                    if($("#selCampus").val() !== "-0")
                    {
                        arrayScheduleAdd = "";
                        arrayScheduleRemove = "";
                        arrayScheduleDB = "";
                        getScheduleByCampus($("#selCampus").val());
                    }//Fin del if
                    else
                    {
                        $("#msg").html(getErrorMessage(9));
                    }//Fin del else
                }//Fin de la función del evento
            );//Cambio del select campus
    
            //Evento campos horarios
            $("#tableSchedule").on
            (
                'click','td.tdField', function() 
                {
                    var row = $(this).attr("id");
                    var currentRow = row.substring(2,row.length);
                    
                    //If para asignar color
                    if(addToArray(currentRow))
                    {
                        $(this).css("background-color", "#00ff40"); //Verde
                    }//Fin del if
                    else
                    {
                        $(this).css("background-color", "#b94646"); //Rojo
                    }//Fin del else
                }//Fin de la función del evento
            );//Fin del even
            
            //Evento para agregar horarios
            $("#btnAdd").on
            (
                'click',function()
                {
                    //Validamos que haya seleccionado una opción
                    if($("#selService").val() !== "0")
                    {
                        //Validamos que haya agregado algo al array
                        if(!validateEmptyField(arrayScheduleAdd))
                        {
                            arrayScheduleAdd = arrayScheduleAdd.substring(0,arrayScheduleAdd.length-1);
                            var infoData = "option=2&idCampus="+$("#selCampus").val() +
                                    "&idService="+$("#selService").val() +
                                    "&arrayScheduleAdd="+arrayScheduleAdd;

                            $.ajax
                            (
                                {
                                    type: 'POST',
                                    url: "../business/ScheduleServiceBusiness.php",
                                    data: infoData,
                                    beforeSend: function(before)
                                    {
                                        $("#msg").html("<p>Wait.</p>");
                                    },
                                    success: function(data)
                                    {
                                        if(data.toString().length > 0)
                                        {
                                            arrayScheduleAdd = "";
                                            $("#lblAddSchedule").text("");
                                            arrayScheduleDB = "";
                                            getScheduleByCampus($("#selCampus").val());
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
                        }
                        else
                        {
                            $("#msg").html(getErrorMessage(11));
                        }//Fin del else
                    }//Fin del if
                    else
                    {
                        $("#msg").html(getErrorMessage(10));
                    }//Fin del else
                }//Fin de la funcion del evento
            );//Fin del evento del boton
            
            //Evento para eliminar horarios
            $("#btnRemove").on
            (
                'click',function()
                {
                    //Validamos que haya agregado algo al array
                    if(!validateEmptyField(arrayScheduleRemove))
                    {
                        arrayScheduleRemove = arrayScheduleRemove.substring(0,arrayScheduleRemove.length-1);
                        var infoData = "option=3&idCampus="+$("#selCampus").val() +
                                "&arrayScheduleRemove="+arrayScheduleRemove;

                        $.ajax
                        (
                            {
                                type: 'POST',
                                url: "../business/ScheduleServiceBusiness.php",
                                data: infoData,
                                beforeSend: function(before)
                                {
                                    $("#msg").html("<p>Wait.</p>");
                                },
                                success: function(data)
                                {
                                    if(data.toString().length > 0)
                                    {
                                        arrayScheduleRemove = "";
                                        $("#lblRemoveSchedule").text("");
                                        arrayScheduleDB = "";
                                        getScheduleByCampus($("#selCampus").val());
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
                    }
                    else
                    {
                        $("#msg").html(getErrorMessage(11));
                    }//Fin del else
                }//Fin de la funcion del evento
            );//Fin del evento del boton
        }//Fin de la función principal
    );//Fin de la lectura del documento
</script>
