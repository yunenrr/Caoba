<?php include './header.php' ?>
<div>
    <h1>Horario Salas:</h1>
    <div>
        <label>Salas:</label>
        <select id="selCampus" name="selCampus"></select>
    </div>
    <div>
        <label>Servicios:</label>
        <select id="selService" name="selService"></select>
    </div>
    <button id="btnAdd">Agregar</button>
    <button id="btnRemove">Eliminar</button>
    <fieldset>
        <legend>Horario actual:</legend>
        <table>
            <thead>
                <tr>
                    <td>Horario</td>
                    <td>Lunes</td>
                    <td>Martes</td>
                    <td>Miércoles</td>
                    <td>Jueves</td>
                    <td>Viernes</td>
                </tr>
            </thead>
            <tbody id="tableSchedule" style="cursor: default">
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"><label style="background-color: #00ff40;">&Square;</label> <label> = Agregar</label></td>
                    <td colspan="3"><label style="background-color: #b94646;">&Square;</label> <label> = Eliminar</label></td>
                </tr>
            </tfoot>
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
            
            /**
             * Función que se encarga de mostrar el horario para la sala recibida.
             * @param {String} idCampus Corresponde al identificador del campus.
             * */
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
            
            /**
            * Función que se encarga de buscar en el arreglo de horarios de la base de datos
            * un horario que coincida con el recibido por parámetros.
            * @param {int} hour Corresponde al identificador de la hora
            * @param {int} day Corresponde al identificador del día.
            * @return {String} -0 si no se encontró coincidencia, y el identificador del servicio en casoc ontrario.
            * */
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
            
            /**
            * Busca en el array indicado el horario recibido por parámetro.
            * @param {Array} array Corresponde al arreglo en el que se desea buscar.
            * @param {int} hour Corresponde al identificador de la hora.
            * @param {int} day Corresponde al identificador del día.
            * @return {boolean} true: si existe en el horario, false en caso contrario.
            * */
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
            
            /**
            * Función que retorna el nombre del servicio.
            * @param {int} idService Corresponde al identificador del servicio.
            * @return {String} Contiene el nombre del servicio.
            * */
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
            
            /**
            * Función agrega un valor al array correspondiente.
            * @param {String} idField Valor que se desea agregar.
            * @return {String} F = Free,
            * */
            function addToArray(idField)
            {
                var answer = "";
                var arrayTemp = idField.split("-");
                
                //Preguntamos si es agregar
                if(arrayTemp[2] === "0")
                {
                    //Verificamos que no existe actualmente
                    if(!searchInArraySchedule(arrayScheduleAdd,arrayTemp[0],arrayTemp[1]))
                    {
                        //Si no existe lo agregamos al array correspondiente
                        arrayScheduleAdd = arrayScheduleAdd  + idField + ";";
                    }//Fin del if
                    answer = "f";
                }//Fin del if
                //Preguntamos si ya se había seleccionado para agregar
                else if(arrayTemp[2] === "a")
                {
                    //Verificamos que existe actualmente
                    if(searchInArraySchedule(arrayScheduleAdd,arrayTemp[0],arrayTemp[1]))
                    {
                        arrayScheduleAdd = removeToArray(arrayScheduleAdd,idField);
                    }//Fin del if
                    answer = "df";
                }//Fin del if
                //Preguntamos si ya se había seleccionado para eliminar
                else if(arrayTemp[2] === "r")
                {
                    //Verificamos que existe actualmente
                    if(searchInArraySchedule(arrayScheduleRemove,arrayTemp[0],arrayTemp[1]))
                    {
                        arrayScheduleRemove = removeToArray(arrayScheduleRemove,idField);
                    }//Fin del if
                    answer = "dr";
                }//Fin del if                
                else
                {
                    //Verificamos que no existe actualmente
                    if(!searchInArraySchedule(arrayScheduleRemove,arrayTemp[0],arrayTemp[1]))
                    {
                        arrayScheduleRemove = arrayScheduleRemove  + idField + ";";
                    }//Fin del
                    answer = "o";
                }//Fin del else
                return answer;
            }//Fin de la función
            
            /**
            * Función que nos permite eliminar un elemento de un array.
            * @param {Array} array Corresponde al array que se desea revisar.
            * @param {String} value Corresponde al valor que se desea buscar en el arreglo.
            * @return {Array} El nuevo arreglo sin el valor recibido por parámetro.
            * */
            function removeToArray(array,value)
            {
                var arraySchedule = value.split("-");
                var hour = arraySchedule[0];
                var day = arraySchedule[1];
                var newArray = "";
                
                
                if(array.length > 0)
                {
                    var arrayTemp = array.split(";");
                    
                    //Ciclo para el arreglo de horarios de la base de datos
                    for(var k = 0; k < arrayTemp.length; k++)
                    {
                        //Validamos que no esté vacío
                        if(arrayTemp[k].length > 0)
                        {
                            var currentSchedule = arrayTemp[k].split("-");

                            //Pregunta si es el mismo día y hora
                            if(currentSchedule[0] !== hour || currentSchedule[1] !== day)
                            {
                                newArray = newArray + arrayTemp[k] + ";";
                            }//Fin del if
                        }//Fin del if
                    }//Fin del for   
                }//Fin del if
                
                return newArray;
            }//Fin de la función
            
            /**
            * Función que obtiene todos los servicios de la base de datos.
            * */
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
            
            /**
            * Función que se encarga de vacíar los valores almacenados en memoria.
            * */
            function clearData()
            {
                arrayScheduleAdd = "";
                arrayScheduleRemove = "";
                arrayScheduleDB = "";
            }//Fin de la función
            
            /**************************** EVENTOS *****************************/
            $("#selCampus").change
            (
                function()
                {
                    if($("#selCampus").val() !== "-0")
                    {
                        clearData();
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
                    var currentOption = addToArray(currentRow);
                    
                    //Switch para asignar color
                    switch(currentOption)
                    {
                        case "f":
                            $(this).css("background-color", "#00ff40"); //Verde
                            var newId = row.substring(0,(row.length-1));
                            newId = newId + "a";
                            $(this).attr("id",newId);
                            break;
                        case "o":
                            $(this).css("background-color", "#b94646"); //Rojo
                            var newId = row.substring(0,(row.length-1));
                            newId = newId + "r";
                            $(this).attr("id",newId);
                            break;
                        case "df":
                            $(this).css("background-color", "transparent"); //Default
                            var newId = row.substring(0,(row.length-1));
                            newId = newId + "0";
                            $(this).attr("id",newId);
                            break;
                        case "dr":
                            $(this).css("background-color", "transparent"); //Default
                            var newId = row.substring(0,(row.length-1));
                            newId = newId + "n";
                            $(this).attr("id",newId);
                            break;
                    }//Fin del switch
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
                                        $("#msg").html(getWaitMessage());
                                    },
                                    success: function(data)
                                    {
                                        if(data.toString().length > 0)
                                        {
                                            clearData();
                                            getScheduleByCampus($("#selCampus").val());
                                        }
                                        else
                                        {
                                            $("#msg").html("Verifique que el servicio actual no se brinde en el mismo horario y día pero en otra sala.");
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
                                        clearData();
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
