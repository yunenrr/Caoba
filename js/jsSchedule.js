/* 
 * Script que contiene los métodos necesarios para poder interactuar con la capa business
 * en todo lo relacionado con los horarios
 */
/**
 * Función que nos permite obtener todos los servicios para ingresarlos como opciones al select correspondiente.
 * */
function getSelectAllService()
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
                $("#msg").html("<p>Wait.</p>");
            },
            success: function(data)
            {
                if(data.toString().length > 0)
                {
                    var temp = '<option value="0" selected="">Select</option>';
                    var array = data.split(";");

                    for(var i = 0; i < array.length; i++)
                    {
                        var service = array[i].split(",");
                        
                        temp = temp + '<option value="'+service[0]+'">'+service[2]+'</option>';
                    }
                    $("#selService").html(temp);
                    $("#msg").html("");
                }
                else
                {
                    $("#msg").html("Don't have service");
                }
            },
            error:function()
            {
                $("#msg").html("<p>Error.</p>");
            }
        }
    );
}//Fin de la función

/**
 * Función que nos permite obtener todos los campus para ingresarlos como opciones al select correspondiente.
 * */
function getSelectAllCampus()
{
    var infoData = "option=1";

    $.ajax
    (
        {
            type: 'POST',
            url: "../business/CampusBusiness.php",
            data: infoData,
            beforeSend: function(before)
            {
                $("#msg").html("<p>Wait.</p>");
            },
            success: function(data)
            {
                if(data.toString().length > 0)
                {
                    var temp = '<option value="-0" selected="">Select</option>';
                    var array = data.split(";");

                    for(var i = 0; i < array.length; i++)
                    {
                        var service = array[i].split(",");
                        
                        temp = temp + '<option value="'+service[0]+'">'+service[1]+'</option>';
                    }
                    $("#selCampus").html(temp);
                    $("#msg").html("");
                }
                else
                {
                    $("#msg").html("Don't have campus");
                }
            },
            error:function()
            {
                $("#msg").html("<p>Error.</p>");
            }
        }
    );
}//Fin de la función

/**
 * Función que nos permite obtener todos los días que tienen asignado un horario
 *  para ingresarlos como opciones al select correspondiente.
 * */
function getSelectAllDay()
{
    var infoData = "option=1&idCampus="+$("#selCampus").val();

    $.ajax
    (
        {
            type: 'POST',
            url: "../business/ScheduleBusiness.php",
            data: infoData,
            beforeSend: function(before)
            {
                $("#msg").html("<p>Wait.</p>");
            },
            success: function(data)
            {
                if(data.toString().length > 0)
                {
                    var temp = '<option value="0" selected="">Select</option>';
                    var array = data.split(";");

                    for(var i = 0; i < array.length; i++)
                    {
                        var service = array[i].split(",");
                        
                        temp = temp + '<option value="'+service[0]+'">'+service[1]+'</option>';
                    }
                    $("#selDay").html(temp);
                    $("#msg").html("");
                }
                else
                {
                    $("#selDay").html('<option value="0" selected="">Select</option>');
                    $("#selSchedule").html('<option value="0" selected="">Select</option>');
                    $("#msg").html("Don't have day");
                }
            },
            error:function()
            {
                $("#msg").html("<p>Error.</p>");
            }
        }
    );
}//Fin de la función

/**
 * Función que nos permite obtener todos los horarios disponibles para un campus y día
 * en específico.
 * */
function getSelectAllScheduleByCampusDay()
{
    var infoData = "option=2&idCampus="+$("#selCampus").val() +
            "&idDay="+$("#selDay").val();
    $.ajax
    (
        {
            type: 'POST',
            url: "../business/ScheduleBusiness.php",
            data: infoData,
            beforeSend: function(before)
            {
            },
            success: function(data)
            {
                if(data.toString().length > 0)
                {
                    var arrayTemp = data.split(";");
                    var temp = '<option value="0" selected="">Select</option>';

                    for(var i = 0; i < arrayTemp.length; i++)
                    {
                        var service = arrayTemp[i].split(",");
                        temp = temp + '<option value="'+service[0]+'">'+getFormatHour(service[1])+' - '+getFormatHour(service[2])+'</option>';
                    }//Fin del for
                    $("#selSchedule").html(temp);
                }
                else
                {
                    $("#msg").html("Don't have schedule in the database");
                }
            },
            error:function()
            {
                $("#msg").html("<p>Error.</p>");
            }
        }
    );
}//Fin de la función

/**
* Función que nos permite obtener el formato de la hora.
* @param {String} idHour Corresponde al identificador de la hora en la base de datos.
* @return {String} Corresponde a la hora pero con formato, ejmp: 7:00am
* */
function getFormatHour(idHour)
{
    var hour = parseInt(idHour) - 1;
    var answer = "";

    if(hour > 12)
    {
        hour = hour-12;
        answer = hour + ":00 pm";
    }//Fin del if
    else if (hour === 12){answer = hour + ":00 md";}
    else{answer = hour + ":00 am";}
    return answer;
}//Fin de la función

/**
 * Función que nos permite insertar relaciones entre horarios y servicios.
 * */
function insertScheduleByService()
{
    var infoData = "option=3&idService="+$("#selService").val() +
            "&idSchedule="+$("#selSchedule").val();
    hideOptionSelect("1","selSchedule",$("#selSchedule").val());

    $.ajax
    (
        {
            type: 'POST',
            url: "../business/ScheduleBusiness.php",
            data: infoData,
            beforeSend: function(before)
            {
                $("#msg").html("<p>Wait.</p>");
            },
            success: function(data)
            {
                if(data.toString().length > 0)
                {
                    $("#msg").html("Schedule successfully added");
                }
                else
                {
                    $("#msg").html("Don't select schedule");
                }
            },
            error:function()
            {
                $("#msg").html("<p>Error.</p>");
            }
        }
    );
}//Fin de la función

/**
 * Función que nos permite ocultar/mostrar opciones de un select.
 * @param {String} type Corresponde a un valor (1/0) indicando si tenemos que ocultar/mostrar
 * @param {String} select Corresponde al nombre del select.
 * @param {String} value Corresponde al valor de la opción.
 * */
function hideOptionSelect(type,select,value)
{
    //Ocultar
    if(type === "1")
    {
        $("#"+select+" option[value="+value+"]").hide();
        $("#"+select).val("0");
    }//Fin del if
    else //Mostrar
    {
        $("#"+select+" option[value="+value+"]").show();
        $("#"+select).val("0");
    }//Fin del else
}//Fin de la función hideOptionSelect

/**
* Función que nos permite horarios en la tabla de horarios.
* @param {int} idSchedule Corresponde al identificador del horario.
* @param {String} nameService Corresponde al nombre del servicio.
* @param {String} nameCampus Corresponde al nombre del campus.
* @param {String} schedule Corresponde al horario.
* @param {int} idService Corresponde al identificador del servicio.
* */
function insertGUI(idSchedule,nameService,nameCampus,schedule,idService)
{
    var newRow = ($("#tableSchedule tr").length);
    var temp = "";

    if(newRow === 0)
    {  
        temp = '<tr id="trS'+newRow+'">'+
                '<td>'+nameService+' <input type="hidden" id="txtDay'+newRow+'" value="'+idSchedule +'" /><input type="hidden" id="txtID'+newRow+'" value="'+idService +'" /></td>'+
                '<td>'+nameCampus+'</td>'+
                '<td>'+schedule+'</td>'+
            '</tr>';
        $("#tableSchedule").html(temp);
    }
    else
    {
        var row = $("#tableSchedule tr:last").attr("id");
        var newRow = parseInt(row.substring(3,row.length)) + 1;
        temp = '<tr id="trS'+newRow+'">'+
                '<td>'+nameService+' <input type="hidden" id="txtDay'+newRow+'" value="'+idSchedule +'" /><input type="hidden" id="txtID'+newRow+'" value="'+idService +'" /></td>'+
                '<td>'+nameCampus+'</td>'+
                '<td>'+schedule+'</td>'+
            '</tr>';

        $("#tableSchedule tr:last").after(temp);
    }//Fin del else

    var row = $("#tableSchedule tr:last").attr("id");
    var newRow = row.substring(3,row.length);
    var buttons = '<input type="button" value="Delete" class="btnDelete" id="btnDelete'+newRow+'" name="btnDelete'+newRow+'" /></td>';
    $("#tableSchedule tr:last").append(buttons);
}//Fin de la función insertGUI

/**
 * Fución que nos permite eliminar la relación entre horarios y servicios.
 * @param {int} currentRow Corresponde a la posición de la fila en la tabla.
 * */
function deleteScheduleByService(currentRow)
{
    var infoData = "option=4&idService="+$("#txtID"+currentRow).val() +
            "&idSchedule="+$("#txtDay"+currentRow).val();
    $.ajax
    (
        {
            type: 'POST',
            url: "../business/ScheduleBusiness.php",
            data: infoData,
            beforeSend: function(before)
            {
                $("#msg").html("<p>Wait.</p>");
            },
            success: function(data)
            {
                if(data.toString().length > 0)
                {
                    $("#trS"+currentRow).remove();
                    $("#msg").html("Schedule successfully deleted");
                }
                else
                {
                    $("#msg").html("Don't have schedule in the database");
                }
            },
            error:function()
            {
                $("#msg").html("<p>Error.</p>");
            }
        }
    );
}//Fin de la función

/**
 * Función que nos permite reprensetar en la tabla los horarios actuales para un determinado servicio.
 * @param {int} idService Corresponde al identificador del servicio.
 * @param {String} nameService Corresponde al nombre del servicio.
 * */
function getRowTableCurrentSchedule(idService,nameService)
{
    var infoData = "option=5&id="+idService;
     $.ajax
     (
         {
             type: 'POST',
             url: "../business/ScheduleBusiness.php",
             data: infoData,
             beforeSend: function(before)
             {
             },
             success: function(data)
             {
                 if(data.toString().length > 0)
                 {
                     var arraySchedule = data.split(";");

                     for(var i = 0; i < arraySchedule.length; i++)
                     {
                         var service = arraySchedule[i].split(",");
                         insertGUI(service[1],nameService,service[0],service[2] +": "+getFormatHour(service[3])+' - '+getFormatHour(service[4]),idService);
                     }//Fin del 
                 }
             },
             error:function()
             {
                 $("#msg").html("<p>Error.</p>");
             }
         }
     );
}//Fin de la función