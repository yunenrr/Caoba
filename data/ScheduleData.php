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
        
        $sql = "SELECT tbdayhourservice.dayservice,tbday.nameday FROM tbdayhourservice INNER JOIN tbday ON tbdayhourservice.dayservice = tbday.idday WHERE tbdayhourservice.idcampusservice = $idCampus GROUP BY tbday.idday;";
        
        $result = mysqli_query($connO,$sql);
        $array = [];
        
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $day = new Day($row['dayservice'],$row['nameday']);
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
        
        $sql = "select iddayhourservice,dayservice, hourstartservice,hourendservice from "
                . "tbdayhourservice where tbdayhourservice.idcampusservice = $idcampus and tbdayhourservice.dayservice = $idday
                    and tbdayhourservice.condition = 0;";
        
        $result = mysqli_query($connO,$sql);
        $array = [];
        
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $dayHourService = new DayHourService($row['iddayhourservice'], 
                        $row['dayservice'], $row['hourstartservice'], $row['hourendservice'],0);
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
     * Función que nos permite insertar horarios para los servicios.
     * @param int $idService Corresponde al identificador del servicio.
     * @param int $idSchedule Corresponde al identificador del horario.
     * @param int $quotaService Corresponde al cupo del servicio en ese horario.
     * @return String Indicando si se ingresó o no.
     */
    public function insertSchedule($idService,$idSchedule,$quotaService)
    {
        //Obtenemos el ID que le vamos a asignar
        $idRelationServiceSchedule = $this->getLastID("relationserviceschedule");
        
        //Abrimos la conexión
        $connO = $this->connection->getConnection();
        mysqli_set_charset($connO, "utf8");
        
        //Preparamos la información
        $idService = mysqli_real_escape_string($connO,$idService);
        $idSchedule = mysqli_real_escape_string($connO,$idSchedule);
        $quotaService = mysqli_real_escape_string($connO,$quotaService);
        
        $sql = "insert into tbrelationserviceschedule "
            . "(idrelationserviceschedule,iddayhourservice,idservice,quotaservice) "
            . "values ($idRelationServiceSchedule,$idSchedule,$idService,$quotaService);";
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
        $sql = "UPDATE tbdayhourservice SET tbdayhourservice.condition = $valueCondition WHERE tbdayhourservice.iddayhourservice = $idSchedule;";
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
        $sql = "delete from tbrelationserviceschedule where "
                . "tbrelationserviceschedule.idservice = $idService and "
                . "tbrelationserviceschedule.iddayhourservice = $idSchedule;";
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
        $sql = "select tbdayhourservice.iddayhourservice,tbday.nameday,"
                . "hourstartservice,hourendservice,tbcampus.namecampus from "
                . "tbdayhourservice inner join tbrelationserviceschedule on "
                . "tbdayhourservice.iddayhourservice = "
                . "tbrelationserviceschedule.iddayhourservice inner join tbday "
                . "on tbday.idday = tbdayhourservice.dayservice inner join "
                . "tbcampus on tbcampus.idcampus = tbdayhourservice.idcampusservice "
                . "where tbrelationserviceschedule.idservice = $id;";
        
        $result = mysqli_query($connO,$sql);
        $array = [];
        
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $dayHourService = new DayHourService($row['iddayhourservice'], 
                        $row['nameday'], $row['hourstartservice'], $row['hourendservice'],$row['namecampus']);
                array_push($array, $dayHourService);
            }//Fin del while
        }//Fin del if
        
        $this->connection->closeConnection();
        
        return $array;
    }//Fin de la función
}//Fin de la clase