/* 
 * Script que contiene los métodos necesarios para poder interactuar con la capa business
 * en todo lo relacionado con los horarios
 */
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
                    var temp = '';
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
* Función que nos permite obtener el formato de la hora.
* @param {int} idHour Corresponde al identificador de la hora, en entero.
* @return {String} Corresponde a la hora pero con formato, ejmp: 7:00am
* */
function getFormatHour(idHour)
{
    var hour = idHour;
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

function getDay(idDay)
{
    var answer = "";
    switch(idDay)
    {
        case "0":answer = "Monday";break;
        case "1":answer = "Tuesday";break;
        case "2":answer = "Wednesday";break;
        case "3":answer = "Thursday";break;
        case "4":answer = "Friday";break;
        case "5":answer = "Saturday";break;
        case "6":answer = "Sunday";break;
    }//Fin del swtich
    return answer;
}//Fin del if