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
            message = "Dejó un espacio en blanco."; 
            break;
        //El valor no es un número
        case 2: 
            message = "No ingresó un número"; 
            break;
        //No seleccionó un método de pago.
        case 3: 
            message = "Seleccione un método de pago."; 
            break;
        //La fecha no es valida
        case 4:
            message = "La fecha es inválida"; 
            break;
        //Ocurrió un error al procesar la solicitud en el servidor.
        case 5:
            message = "Ocurrió un error al procesar la solicitud en el servidor.";
            break;
        //La fecha ingresada es menor que la del sistema.
        case 6:
            message = "Please enter a date that is greater than or equal to the current date.";
            break;
        //La fecha ingresada es mayor que la que fecha final que posee.
        case 7:
            message = "La fecha ingresada es mayor que la fecha final que posee.";
            break;
        //La fecha ingresada es menor que la que fecha inicial que posee.
        case 8:
            message = "La fecha ingresada es menor que la fecha inicial.";
            break;
        //No seleccionó un campus.
        case 9:
            message = "Seleccione una sala";
            break;
        //No seleccionó un servicio.
        case 10:
            message = "Seleccione un servicio";
            break;
        //No seleccionó un servicio.
        case 11:
            message = "Seleccione un campo del horario";
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
            message = "El método de pago fue ingresado correctamente."; 
            break;
        //Servicio ingresado correctamente.
        case 2:
            message = "El servicio fue ingresado correctamente."; 
            break;
        //Servicio renovado correctamente.
        case 3:
            message = "El servicio fue renovado correctamente."; 
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
            message = "El método de pago se removió correctamente"; 
            break;
        //El servicio se canceló correctamente.
        case 2: 
            message = "El servicio se canceló correctamente"; 
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
   return "Por favor espere, se está realizando la petición."; 
}//Fin de la función