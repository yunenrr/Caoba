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
     * 1 - Obtener todos los dias que tienen un horario.
     * 2 - Obtener todos los horarios existentes para un día y campus en específico.
     * 3 - Insertar una relación entre horario/servicio.
     * 4 - Elimiar la relación entre horario y servicio.
     * 5 - Obtener los horarios de un servicio en específico.
     * 
     * 1 - Obtener el horario de entre una semana.
     * 2 - Insertar la relacion entre horario y servicio.
     */
    switch($option)
    {
        case 1:
            $idCampus = $_POST['idCampus'];
            $lastMonday = date("Y-m-d", strtotime ("last Monday"));
            $dateMonday =  strtotime("$lastMonday");
            $dateFriday= strtotime("4 day","$dateMonday");
            $lastFriday = date("Y-m-d",$dateFriday);
            
            //Conexión con la data
            $data = new ScheduleData();
            $arraySchedule = $data->getDatePerWeek($lastMonday, $lastFriday, $idCampus);
            
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
            $scheduleData = new ScheduleData();
            $temp = "";
            
            //Recorremos los días del horario seleccionados
            $arrayDayHour = explode(";", $arrayAdd);
            foreach ($arrayDayHour as $currentDayHour)
            {
                $arraySchedule = explode("-", $currentDayHour);
                
                $stringDate = $scheduleData->getDateForScheduleService($service->getStartDateService(),
                        $service->getEndDateService(), $arraySchedule[1]);
                $stringDate = substr($stringDate,0, strlen($stringDate)-1);
                $arrayDate = explode(",", $stringDate);
                
                //Recorremos las fechas de los dias seleccionados
                foreach ($arrayDate as $currentDate)
                {
                    $scheduleService = new ScheduleService(0,$idCampus, 
                            $idService, $arraySchedule[1], $arraySchedule[0], 
                            $currentDate);
                    $temp = $scheduleData->insertScheduleService($scheduleService);
                }//Fin del foreach
            }//Fin del foreach
            echo $temp;
            break;
        case 3:
            $idCampus = $_POST['idCampus'];
            $arrayScheduleRemove = $_POST['arrayScheduleRemove'];
            $scheduleData = new ScheduleData();
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