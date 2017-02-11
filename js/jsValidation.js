/**
 * Función que nos permite validar campos
 * @param {String} valueField Corresponde al valor del campo.
 * @return {boolean} True si está vacío o false si no está vacío.
 * */
function validateEmptyField(valueField)
{
    var flag = false;
    if(valueField.length === 0)
    {
        flag = true;
    }//Fin del if
    return flag;
}//Fin de la función

/**
 * Función que nos permite validar que el texto ingresado no sea superior al máximo permitido.
 * @param {String} valueField Corresponde al valor del campo.
 * @param {int} maxLength Corresponde a la longitud máxima permitida.
 * @return {boolean} True si tiene una longitud mayor o false si no se pasó del máximo permitido.
 * */
function validateMaxLengthField(valueField,maxLength)
{
    var flag = false;
    if(valueField.length > maxLength)
    {
        flag = true;
    }//Fin del if
    return flag;
}//Fin de la función

/**
 * Función que nos permite saber si el valor del campo es númerico o no.
 * @param {String} valueField Corresponde al valor del campo.
 * @return {boolean} true: Si es númerio / False si no es un número.
 * */
function validateNumberField(valueField)
{
    var flag = true;
    
    //Se valida que sea un número
    if(isNaN(valueField))
    {
        flag = false;
    }//Fin del if
    else
    {
        if(parseInt(valueField) <= 0)
        {
            flag = false;
        }//Fin del if
    }//Fin del else
    
    return flag;
}//Fin de la función

/**
 * Función que nos permite saber si una fecha es valida o no.
 * @param {String} valueField Corresponde al valor del campo. Formato: dd-mm-aaaa
 * @return {boolean} True: Si es una fecha valida / False: Si no es una fecha valida.
 * */
function validateDate(valueField)
{
    var dateArray = valueField.split("-");
    var d = dateArray[0];
    var m = dateArray[1];
    var y = dateArray[2];
    return m > 0 && m < 13 && y > 0 && y < 32768 && d > 0 && d <= (new Date(y, m, 0)).getDate();
}//Fin de la función

/**
 * Función que compara una fecha con la fecha actual.
 * @param {String} valueField Corresponde a la fecha que se desea validar.
 * @return {boolean} True: Si la fecha es mayor que la actual, false en caso contrario.
 * */
function compareDateWithCurrentDate(valueField)
{
    var condition = false;
    var x = new Date();
    var dateArray = valueField.split("-");
    x.setFullYear(dateArray[2],dateArray[1]-1,dateArray[0]); //Queda en el formato yyyy/mm/dd
    var today = new Date(); //Obtenemos la fecha actual

    if (x >= today)
    {
        condition = true;
    }
    return condition;
}//Fin de la función

/**
 * Función que nos permite comparar dos fechas.
 * @param {String} oldFinishDate Corresponde a la antigua fecha de fin.
 * @param {String} newFinishDate Corresponde a la nueva fecha de fin.
 * @return {boolean} True: Si la nueva fecha es mayor que la antigua, false en caso contrario.
 * */
function compareDate(oldFinishDate,newFinishDate)
{
    var condition = false;
    var oldDate = new Date();
    var oldDateArray = oldFinishDate.split("-");
    oldDate.setFullYear(oldDateArray[2],oldDateArray[1]-1,oldDateArray[0]); //Queda en el formato yyyy/mm/dd
    
    var newDate = new Date(); //Obtenemos la fecha actual
    var newDateArray = newFinishDate.split("-");
    newDate.setFullYear(newDateArray[2],newDateArray[1]-1,newDateArray[0]);
    

    if (newDate > oldDate)
    {
        condition = true;
    }
    return condition;
}//Fin de la función