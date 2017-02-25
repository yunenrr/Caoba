<?php
include_once '../data/HistoryCampusData.php';
include_once '../data/ScheduleServiceData.php';

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
            ini_set('date.timezone','America/Costa_Rica'); //Establecer la hora de Costa Rica
            $dniPerson = $_POST['dniPerson']; //Obtenemos el identificador del campus
            $idCampus = $_POST['idCampus']; //Obtenemos la sala
            $currentDate = date("Y-m-d"); //Obtenemos la fecha actual
            $currentHour = date("H"); //Obtiene la hora en formato 24 horas
            
            //Iniciamos los data
            $dataHistory = new HistoryCampusData();
            $dataSchedule = new ScheduleServiceData();
            $existClient = $dataHistory->existPerson($dniPerson);
            
            //Preguntamos si el cliente existe
            if($existClient != "0")
            {
                $idService = $dataSchedule->getScheduleByCampusHour($idCampus, $currentHour);
                
                //Preguntamos si se brinda un servicio a esa hora
                if($idService != "0")
                {
                    //Verificamos que no se haya ya logueado.
                    if($dataHistory->existSessionInCurrentCampus($dniPerson, $currentDate, $currentHour) == "0")
                    {
                        $dataHistory->registerClientInCampus($dniPerson, $idCampus, 
                                $idService,$currentDate, $currentHour);
                        echo $existClient;
                    }//Fin del if
                    else{echo "3";}
                }//Fin del if del servicio
                else{echo "2";}
            }//Fin del if del cliente
            else{echo "4";}
            break;
    }//Fin del switch
}//Fin del if
?>