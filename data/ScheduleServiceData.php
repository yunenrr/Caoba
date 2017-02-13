<?php
include_once 'Connection.php';
include_once '../domain/ScheduleService.php';

/**
 * Clase que nos permite manipular los horarios en la base de datos.
 *
 * @author Yunen Ramos Ramírez
 * @version 1.0
 */
class ScheduleData 
{
    private $connection;
    
    /**
     * Función constructora
     */
    function ScheduleData() 
    {
        $this->connection = new Connection();
    }//Fin de la función

    function getDatePerWeek($startDate,$endDate,$idCampus)
    {
        //Abrimos la conexión
        $connO = $this->connection->getConnection();
        mysqli_set_charset($connO, "utf8");
        
        //Validamos la información
        $startDate = mysqli_real_escape_string($connO,$startDate);
        $endDate = mysqli_real_escape_string($connO,$endDate);
        $idCampus = mysqli_real_escape_string($connO,$idCampus);
        
        $sql = "select idscheduleservice, idcampuscheduleservice, "
                . "idservicescheduleservice, dayscheduleservice, hourscheduleservice, "
                . "datescheduleservice from tbscheduleservice where idcampuscheduleservice = $idCampus "
                . "and datescheduleservice >= '$startDate' and datescheduleservice <= '$endDate' order by hourscheduleservice,dayscheduleservice;";
        
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
    
    function getDateForScheduleService($dateStart,$dateFinish,$day)
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
    
    function insertScheduleService($scheduleService)
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
    
    function deleteSchedule($scheduleService)
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
}//Fin de la clase