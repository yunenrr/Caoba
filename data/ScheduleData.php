<?php
include_once 'Connection.php';
include_once '../domain/Day.php';
include_once '../domain/DayHourService.php';

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

    
    /**
     * Función que nos permite obtener todos los días de la base de datos.
     * @param int $idCampus Corresponde al identificador del campus
     */
    public function getAllDay($idCampus)
    {
        //Abrimos la conexión
        $connO = $this->connection->getConnection();
        mysqli_set_charset($connO, "utf8");
        
        $idCampus = mysqli_real_escape_string($connO,$idCampus);
        
        $sql = "SELECT TBDayHourService.dayService,TBDay.nameDay FROM TBDayHourService INNER JOIN TBDay ON TBDayHourService.dayService = TBDay.idDay WHERE TBDayHourService.idCampusService = $idCampus GROUP BY TBDay.idDay;";
        
        $result = mysqli_query($connO,$sql);
        $array = [];
        
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $day = new Day($row['dayService'],$row['nameDay']);
                array_push($array, $day);
            }//Fin del while
        }//Fin del if
        
        $this->connection->closeConnection();
        
        return $array;
    }//Fin de la función
    
    /**
     * Función que nos permite obtener los horarios por día y campus.
     * @param int $idDay Corresponde al identificador del día.
     * @param int $idCampus Corresponde al identificador del campus.
     */
    public function getScheduleByDay($idCampus,$idDay)
    {
        //Abrimos la conexión
        $connO = $this->connection->getConnection();
        mysqli_set_charset($connO, "utf8");
        
        //Prepraramos la información para la consulta
        $idCampus = mysqli_real_escape_string($connO,$idCampus);
        $idDay = mysqli_real_escape_string($connO,$idDay);
        
        $sql = "SELECT idDayHourService,dayService, hourStartService,hourEndService FROM "
                . "TBDayHourService WHERE TBDayHourService.idCampusService = $idCampus AND TBDayHourService.dayService = $idDay
                    AND TBDayHourService.condition = 0;";
        
        $result = mysqli_query($connO,$sql);
        $array = [];
        
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $dayHourService = new DayHourService($row['idDayHourService'], 
                        $row['dayService'], $row['hourStartService'], $row['hourEndService'],0);
                array_push($array, $dayHourService);
            }//Fin del while
        }//Fin del if
        
        $this->connection->closeConnection();
        
        return $array;
    }//Fin de la función
    
    /**
     * Función que nos permite obtener el último ID asignado.
     * @return int Corresponde al ID a asignar
     */
    public function getLastID($table)
    {
        $connO = $this->connection->getConnection();
        $sqlQuery = "SELECT MAX(id".$table.") as maxID FROM TB".$table.";";
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
     * Función que nos permite insertar horarios para los servicios.
     * @param int $idService Corresponde al identificador del servicio.
     * @param int $idSchedule Corresponde al identificador del horario.
     * @param int $quotaService Corresponde al cupo del servicio en ese horario.
     * @return String Indicando si se ingresó o no.
     */
    public function insertSchedule($idService,$idSchedule,$quotaService)
    {
        //Obtenemos el ID que le vamos a asignar
        $idRelationServiceSchedule = $this->getLastID("RelationServiceSchedule");
        
        //Abrimos la conexión
        $connO = $this->connection->getConnection();
        mysqli_set_charset($connO, "utf8");
        
        //Preparamos la información
        $idService = mysqli_real_escape_string($connO,$idService);
        $idSchedule = mysqli_real_escape_string($connO,$idSchedule);
        $quotaService = mysqli_real_escape_string($connO,$quotaService);
        
        $sql = "INSERT INTO TBRelationServiceSchedule "
            . "(idRelationServiceSchedule,idDayHourService,idService,quotaService) "
            . "VALUES ($idRelationServiceSchedule,$idSchedule,$idService,$quotaService);";
        $result = mysqli_query($connO,$sql);
            
        if($result){}
        else{$result = "0";}
        
        //Cerramos la conexión
        $this->connection->closeConnection();
        return $result;
    }//Fin de la función
    
    /**
     * Función que nos permite actualizar la condición de un horario.
     * @param int $idSchedule Corresponde al identificador del horario.
     * @param int $valueCondition Corresponde al valor que se va asignar a la condición de ese horario.
     * @return int Indicando si se actualizó o no.
     */
    public function updateScheduleCondition($idSchedule,$valueCondition)
    {
        //Abrimos la conexión
        $connO = $this->connection->getConnection();
        mysqli_set_charset($connO, "utf8");
        
        $idSchedule = mysqli_real_escape_string($connO,$idSchedule);
        $valueCondition = mysqli_real_escape_string($connO,$valueCondition);
        
        //Ejecutamos la sentencia
        $sql = "UPDATE TBDayHourService SET TBDayHourService.condition = $valueCondition WHERE TBDayHourService.idDayHourService = $idSchedule;";
        $result = mysqli_query($connO,$sql);
        
        if($result){}
        else{$result = "0";}
        
        //Cerramos la conexión
        $this->connection->closeConnection();
        return $result;
    }//Fin de la función
    
    /**
     * Función que nos permite eliminar horarios para los servicios.
     * @param int $idService Corresponde al identificador del servicio.
     * @param int $idSchedule Corresponde al identificador del horario.
     * @return String Indicando si se ingresó o no.
     */
    public function deleteSchedule($idService,$idSchedule)
    {   
        //Abrimos la conexión
        $connO = $this->connection->getConnection();
        mysqli_set_charset($connO, "utf8");
        
        //Preparamos la información
        $idService = mysqli_real_escape_string($connO,$idService);
        $idSchedule = mysqli_real_escape_string($connO,$idSchedule);
        $sql = "DELETE FROM TBRelationServiceSchedule WHERE "
                . "TBRelationServiceSchedule.idService = $idService AND "
                . "TBRelationServiceSchedule.idDayHourService = $idSchedule;";
        $result = mysqli_query($connO,$sql);

        if($result){}
        else{$result = "0";}
        
        //Cerramos la conexión
        $this->connection->closeConnection();
        return $result;
    }//Fin de la función
    
    /**
     * Función que nos permite obtener los horarios por día.
     * @param String $id Corresponde al identificador del servicio.
     */
    public function getCurrentSchedule($id)
    {
        //Abrimos la conexión
        $connO = $this->connection->getConnection();
        mysqli_set_charset($connO, "utf8");
        
        //Prepraramos la información para la consulta
        $id = mysqli_real_escape_string($connO,$id);
        $sql = "SELECT TBDayHourService.idDayHourService,TBDay.nameDay,"
                . "hourStartService,hourEndService,TBCampus.nameCampus FROM "
                . "TBDayHourService INNER JOIN TBRelationServiceSchedule ON "
                . "TBDayHourService.idDayHourService = "
                . "TBRelationServiceSchedule.idDayHourService INNER JOIN TBDay "
                . "ON TBDay.idDay = TBDayHourService.dayService INNER JOIN "
                . "TBCampus ON TBCampus.idCampus = TBDayHourService.idCampusService "
                . "WHERE TBRelationServiceSchedule.idService = $id;";
        
        $result = mysqli_query($connO,$sql);
        $array = [];
        
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $dayHourService = new DayHourService($row['idDayHourService'], 
                        $row['nameDay'], $row['hourStartService'], $row['hourEndService'],$row['nameCampus']);
                array_push($array, $dayHourService);
            }//Fin del while
        }//Fin del if
        
        $this->connection->closeConnection();
        
        return $array;
    }//Fin de la función
}//Fin de la clase