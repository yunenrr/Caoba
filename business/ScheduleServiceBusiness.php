<?php
include_once '../data/ScheduleServiceData.php';
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
     * 1 - Obtener el horario de entre una semana.
     * 2 - Insertar la relacion entre horario y servicio.
     * 3 - Eliminar la relacion entre horario y servicio.
     */
    switch($option)
    {
        case 1:
            $idCampus = $_POST['idCampus'];
            $currentDate = date("Y-m-d");
            
            //Conexión con la data
            $data = new ScheduleServiceData();
            $arraySchedule = $data->getDatePerWeek($currentDate, $idCampus);
            
            //Recorremos para mandar a vista
            $temp = "";
            foreach ($arraySchedule as $current)
            {  
                $temp = $temp.$current->getHourScheduleService().",";
                $temp = $temp.$current->getDayScheduleService().",";
                $temp = $temp.$current->getIdserviceScheduleService().";";
            }//Fin del foreach
            if(strlen($temp) > 0){$temp = substr($temp,0, strlen($temp)-1);}
            echo $temp;
            break;
        case 2:
            $idCampus = $_POST['idCampus'];
            $idService = $_POST['idService'];
            $arrayAdd = $_POST['arrayScheduleAdd'];
            $serviceData = new ServiceData();
            $service = $serviceData->getServiceByID($idService);
            $scheduleData = new ScheduleServiceData();
            $temp = "";

            //Recorremos los días del horario seleccionados
            $arrayDayHour = explode(";", $arrayAdd);
            foreach ($arrayDayHour as $currentDayHour)
            {
                $arraySchedule = explode("-", $currentDayHour);
                $scheduleService = new ScheduleService(0,$idCampus, 
                            $idService, $arraySchedule[1], $arraySchedule[0], 
                            $service->getEndDateService());
                $temp = $scheduleData->insertScheduleService($scheduleService);
            }//Fin del foreach
            echo $temp;
            break;
        case 3:
            $idCampus = $_POST['idCampus'];
            $arrayScheduleRemove = $_POST['arrayScheduleRemove'];
            $scheduleData = new ScheduleServiceData();
            $temp = "";
            
            //Recorremos los días del horario seleccionados
            $arrayDayHour = explode(";", $arrayScheduleRemove);
            foreach ($arrayDayHour as $currentDayHour)
            {
                $arraySchedule = explode("-", $currentDayHour);
                $scheduleService = new ScheduleService(0,$idCampus, 
                        0, $arraySchedule[1], $arraySchedule[0],0);
                $temp = $scheduleData->deleteSchedule($scheduleService);
            }
            echo $temp;
            break;
    }//Fin del switch
}//Fin del if
?>