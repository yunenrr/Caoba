/**
 * Función que nos permite obtener el mensaje de error con base al id recibido
 * @param {int} idError Corresponde al id del error.
 * @return {String} Corresponde al mensaje con el error.
 * */
function getErrorMessage(idError)
{
    var message = "";
    switch(idError)
    {
        //Algún espacio en blanco
        case 1: 
            message = "Left some empty field."; 
            break;
        //El valor no es un número
        case 2: 
            message = "You entered a non-numeric value in a field where only numbers are accepted."; 
            break;
        //No seleccionó un método de pago.
        case 3: 
            message = "Select a payment method."; 
            break;
        //La fecha no es valida
        case 4:
            message = "The date you entered is not valid."; 
            break;
        //Ocurrió un error al procesar la solicitud en el servidor.
        case 5:
            message = "There was an error processing the request on the server.";
            break;
    }//Fin del switch
    
    return message;
}//Fin de la función

/**
 * Función que retorna el mensaje de exito correspondiente al id recibido.
 * @param {int} idSuccess Corresponde al id del mensaje que se desea obtener.
 * @return {String} Corresponde al mensaje.
 * */
function getSuccessfullyInsertedMessage(idSuccess)
{
    var message = "";
    switch(idSuccess)
    {
        //Método de pago del servicio ingresado correctamente.
        case 1: 
            message = "The payment method was successfully entered."; 
            break;
        //Servicio ingresado correctamente.
        case 2:
            message = "The service was successfully entered."; 
            break;
    }//Fin del switch
    
    return message;
}//Fin de la función

/**
 * Función que retorna el mensaje de removido exitoso correspondiente al id recibido.
 * @param {int} idRemove Corresponde al id del mensaje que se desea obtener.
 * @return {String} Corresponde al mensaje.
 * */
function getRemoveMessage(idRemove)
{
    var message = "";
    switch(idRemove)
    {
        //Se removió correctamente el método de pago
        case 1: 
            message = "Payment method was successfully removed."; 
            break;
    }//Fin del switch
    
    return message;
}//Fin de la 

/**
 * Función que nos permite obtener los mensajes de espere.
 * @return {String} Corresponde al mensaje indicandole al usuario que se espere.
 * */
function getWaitMessage()
{
   return "Please wait, the request is being processed"; 
}//Fin de la función