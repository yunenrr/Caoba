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

