/* 
 * Script que contiene los métodos necesarios para poder interactuar con la capa business
 * en todo lo relacionado con los servicios.
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
                    var temp = '<option value="0" selected="">Seleccione</option>';
                    var array = data.split(";");

                    for(var i = 0; i < array.length; i++)
                    {
                        var service = array[i].split(",");
                        
                        temp = temp + '<option value="'+service[0]+'">'+service[1]+'</option>';
                    }
                    $("#selService").html(temp);
                    $("#msg").html("");
                }
                else
                {
                    $("#msg").html("No existen servicios");
                }
            },
            error:function()
            {
                $("#msg").html("Ocurrió un error al realizar la petición en el servidor.");
            }
        }
    );
}//Fin de la función

/**
* Función que nos permite obtener el entero del precio.
* @param {String} money Corresponde al String del precio.
* @return {String} Corresponde al precio, pero sin puntos ni símbolo de colón.
* */
function getMoneyInt(money)
{
    var moneyInt = "";
    var moneyWithOutColon = money.substring(1,money.lenght);
    var arrayMoney = moneyWithOutColon.split(".");

    for(var i = 0; i < arrayMoney.length;i++)
    {
        moneyInt = moneyInt + arrayMoney[i];
    }

    return moneyInt;
}//Fin de la función


/**
* Función que nos retorna la fecha invertida.
* @param {String} date Corresponde a la fecha tal y como está en el campo de texto.
* @return {String} Corresponde a la fecha pero en order: yyyy-mm-dd
* */
function getDateInvert(date)
{
    var array = date.split("-");
    var answer = array[2]+"-"+array[1]+"-"+array[0];
    return answer;
}//Fin de la función