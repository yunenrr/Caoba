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