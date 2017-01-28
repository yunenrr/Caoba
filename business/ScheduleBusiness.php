<?php
include_once '../data/ScheduleData.php';
include_once '../data/ServiceData.php';

/**
 * Clase que nos va a permitir manipular el CRUD de horarios
 * @author Yunen Ramos Ramírez
 * @version 1.0
 */
if(isset($_POST['option']))
{
    $option = $_POST['option'];
    
    /**
     * Opciones:
     * 1 - Obtener todos los dias que tienen un horario.
     * 2 - Obtener todos los horarios existentes para un día y campus en específico.
     * 3 - Insertar una relación entre horario/servicio.
     */
    switch($option)
    {
        case 1:
            $idCampus = $_POST['idCampus'];
            $data = new ScheduleData();
            $array = $data->getAllDay($idCampus);
            $temp = "";
            foreach ($array as $current)
            {   
                $temp = $temp.$current->getIdDay().",";
                $temp = $temp.$current->getNameDay().";";
            }//Fin del foreach
            if(strlen($temp) > 0){$temp = substr($temp,0, strlen($temp)-1);}
            echo $temp;
            break;
        case 2:
            $idCampus = $_POST['idCampus'];
            $idDay = $_POST['idDay'];
            $data = new ScheduleData();
            $array = $data->getScheduleByDay($idCampus, $idDay);
            $temp = "";
            foreach ($array as $current)
            {   
                $temp = $temp.$current->getIdDayHourService().",";
                $temp = $temp.$current->getHourStartService().",";
                $temp = $temp.$current->getHourEndService().";";
            }//Fin del foreach
            if(strlen($temp) > 0){$temp = substr($temp,0, strlen($temp)-1);}
            echo $temp;
            break;
        case 3:
            $idService = $_POST['idService'];
            $idSchedule = $_POST['idSchedule'];
            $serviceData = new ServiceData();
            $service = $serviceData->getServiceByID($idService);
            $data = new ScheduleData();
            $data->updateScheduleCondition($idService);
            echo $data->insertSchedule($idService, $idSchedule, $service->getQuotaService());
            break;
    }//Fin del switch
}//Fin del if
?>