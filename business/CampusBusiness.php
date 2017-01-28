<?php
include_once '../data/CampusData.php';

/**
 * Clase que nos va a permitir manipular el CRUD de campus
 * @author Yunen Ramos Ramírez
 * @version 1.0
 */
if(isset($_POST['option']))
{
    $option = $_POST['option'];
    
    /**
     * Opciones:
     * 1 - Obtener todos los campus.
     */
    switch($option)
    {
        case 1:
            $data = new CampusData();
            $array = $data->getAllCampus();
            $temp = "";
            foreach ($array as $current)
            {   
                $temp = $temp.$current->getIdCampus().",";
                $temp = $temp.$current->getNameCampus().";";
            }//Fin del foreach
            if(strlen($temp) > 0){$temp = substr($temp,0, strlen($temp)-1);}
            echo $temp;
            break;
    }//Fin del switch
}//Fin del if
?>