<?php
include_once 'Connection.php';
include_once '../domain/ScheduleService.php';

/**
 * Clase que nos permite manipular los horarios en la base de datos.
 *
 * @author Yunen Ramos Ramírez
 * @version 1.0
 */
class ScheduleServiceData 
{
    private $connection;
    
    /**
     * Función constructora
     */
    function ScheduleServiceData() 
    {
        $this->connection = new Connection();
    }//Fin de la función

    /**
     * Método que nos permite obtener el horario en el rango de dos fechas.
     * @param date $currentDate Corresponde a la fecha actual.
     * @param int $idCampus Corresponde al identificador del campus.
     * @return array[ScheduleService] Un arreglo de horarios.
     */
    public function getDatePerWeek($currentDate,$idCampus)
    {
        //Abrimos la conexión
        $connO = $this->connection->getConnection();
        mysqli_set_charset($connO, "utf8");
        
        //Validamos la información
        $currentDate = mysqli_real_escape_string($connO,$currentDate);
        $idCampus = mysqli_real_escape_string($connO,$idCampus);
        
        $sql = "select idscheduleservice, idcampuscheduleservice, "
                . "idservicescheduleservice, dayscheduleservice, hourscheduleservice, "
                . "datescheduleservice from tbscheduleservice where idcampuscheduleservice = $idCampus "
                . "and datescheduleservice >= '$currentDate' order by hourscheduleservice,dayscheduleservice;";
        
        $result = mysqli_query($connO,$sql);
        $array = [];
        
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $scheduleService = new ScheduleService($row['idscheduleservice'], 
                        $row['idcampuscheduleservice'], $row['idservicescheduleservice'], 
                        $row['dayscheduleservice'], $row['hourscheduleservice'], $row['datescheduleservice']);
                array_push($array, $scheduleService);
            }//Fin del while
        }//Fin del if
        
        $this->connection->closeConnection();
        
        return $array;
    }//Fin de la función 
    
    /**
     * Método que nos retorna las fechas para un día en específico, por ejemplo:
     * Las fechas de todos los lunes en un año.
     * @param date $dateStart Corresponde a la fecha de inicio.
     * @param date $dateFinish Corresponde a la fecha de fin.
     * @param int $day Corresponde al identificador del día.
     * @return String Contiene todas las fechas del día ingresado.
     */
    public function getDateForScheduleService($dateStart,$dateFinish,$day)
    {
        switch ($day)
        {
            case 0:$day = "Monday";break;
            case 1:$day = "Tuesday";break;
            case 2:$day = "Wednesday";break;
            case 3:$day = "Thursday";break;
            case 4:$day = "Friday";break;
            case 5:$day = "Saturday";break;
            case 6:$day = "Sunday";break;
        }//Fin del switch


        $dateInsert =  strtotime("$dateStart");
        $dateEnd =  strtotime("$dateFinish");
        $temp = "";
        while($dateInsert < $dateEnd)
        {
            $calNextDay = strtotime ("next ".$day,$dateInsert);

            if($calNextDay < $dateEnd)
            {
                $nextDay = date("Y-m-d",$calNextDay);
                $temp = $temp.$nextDay.",";
            }//Fin del if
            $dateInsert = $calNextDay;
        }//Fin del while
        return $temp;
    }//Fin del método
    
    /**
     * Método que ingresa un horario para un servicio.
     * @param ScheduleService $scheduleService Corresponde al horario que se desea ingresar.
     * @return int 0: Si ocurrió un error.
     */
    public function insertScheduleService($scheduleService)
    {
         $idScheduleService = $this->getLastID("scheduleservice");
         
        //Abrimos la conexión
        $connO = $this->connection->getConnection();
        mysqli_set_charset($connO, "utf8");
        
        //Validamos la información
        $scheduleService->setIdcampusScheduleService(mysqli_real_escape_string($connO,$scheduleService->getIdcampusScheduleService()));
        $scheduleService->setIdserviceScheduleService(mysqli_real_escape_string($connO,$scheduleService->getIdserviceScheduleService()));
        $scheduleService->setDayScheduleService(mysqli_real_escape_string($connO,$scheduleService->getDayScheduleService()));
        $scheduleService->setHourScheduleService(mysqli_real_escape_string($connO,$scheduleService->getHourScheduleService()));
        $scheduleService->setDateScheduleService(mysqli_real_escape_string($connO,$scheduleService->getDateScheduleService()));
        
        $sql = "insert into tbscheduleservice(idscheduleservice, datescheduleservice, "
                . "idcampuscheduleservice, idservicescheduleservice,dayscheduleservice,"
                . "hourscheduleservice) values ($idScheduleService,"
                . "'".$scheduleService->getDateScheduleService()."',"
                . "".$scheduleService->getIdcampusScheduleService().","
                . "".$scheduleService->getIdserviceScheduleService().","
                . "".$scheduleService->getDayScheduleService().","
                . "".$scheduleService->getHourScheduleService().");";
        $result = mysqli_query($connO,$sql);
            
        if($result){}
        else{$result = "0";}
        
        //Cerramos la conexión
        $this->connection->closeConnection();
        return $result;
    }//Fin de la función
    
    /**
     * Método que elimina un horario para un servicio.
     * @param ScheduleService $scheduleService Corresponde al horario que se desea eliminar.
     * @return int 0: Si ocurrió un error.
     */
    public function deleteSchedule($scheduleService)
    {
        //Abrimos la conexión
        $connO = $this->connection->getConnection();
        mysqli_set_charset($connO, "utf8");
        
        //Validamos la información
        $scheduleService->setIdcampusScheduleService(mysqli_real_escape_string($connO,$scheduleService->getIdcampusScheduleService()));
        $scheduleService->setDayScheduleService(mysqli_real_escape_string($connO,$scheduleService->getDayScheduleService()));
        $scheduleService->setHourScheduleService(mysqli_real_escape_string($connO,$scheduleService->getHourScheduleService()));
        
        $sql = "delete from tbscheduleservice where "
                . "idcampuscheduleservice = ".$scheduleService->getIdcampusScheduleService()." and "
                . "dayscheduleservice = ".$scheduleService->getDayScheduleService()." and "
                . "hourscheduleservice = ".$scheduleService->getHourScheduleService().";";
        $result = mysqli_query($connO,$sql);
            
        if($result){}
        else{$result = "0";}
        
        //Cerramos la conexión
        $this->connection->closeConnection();
        return $result;
    }//Fin de la función
    
    /**
     * Función que nos permite obtener el último ID asignado.
     * @return int Corresponde al ID a asignar
     */
    public function getLastID($table)
    {
        $connO = $this->connection->getConnection();
        $sqlQuery = "SELECT MAX(id".$table.") as maxID FROM tb".$table.";";
        $result = mysqli_query($connO,$sqlQuery);
        
        if($result == null)
        {
            $id = 1;
        }
        else
        {
            $row = mysqli_fetch_array($result);
            $id = $row['maxID'] + 1;
        }
        
        $this->connection->closeConnection();
        
        return $id;
    }//Fin de la función
    
    /**
     * Método que verifica que no ocurran choques de horarios.
     * @param int $idService Corresponde al identificador del servicio.
     * @param int $idDay Corresponde al identificador del día.
     * @param int $idHour Corresponde al identificador de la hora.
     */
    public function validateCampusSchedule($idService,$idDay,$idHour)
    {
        $connO = $this->connection->getConnection();
        $sqlQuery = "select idservicescheduleservice from tbscheduleservice where "
                . "idservicescheduleservice = $idService and "
                . "dayscheduleservice = $idDay and "
                . "hourscheduleservice = $idHour;";
        $result = mysqli_query($connO,$sqlQuery);
        
        if(mysqli_num_rows($result) > 0)
        {
            $id = 1;
        }
        else
        {
            $id = 0;
        }
        
        //Cerramos la conexión
        $this->connection->closeConnection();
        return $id;
    }//Fin del método
}//Fin de la clase