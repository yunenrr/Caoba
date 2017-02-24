<?php
include_once '../data/HistoryCampusData.php';

/**
 * Clase que nos va a permitir manipular el CRUD de historial de servicios.
 * @author Yunen Ramos Ramírez
 * @version 1.0
 */
if(isset($_POST['option']))
{
    $option = $_POST['option'];
    
    /**
     * Opciones:
     * 1 - 
     */
    switch($option)
    {
        case 1:
            $dniPerson = $_POST['dniPerson']; //Obtenemos el identificador del campus
            $data = new HistoryCampusData();
            echo $data->existPerson($dniPerson);
            break;
    }//Fin del switch
}//Fin del if
?>