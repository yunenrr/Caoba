<?php
include_once 'Connection.php';
include_once '../domain/Service.php';
include_once '../domain/Person.php';

/**
 * Clase que nos permite manipular los servicios en la base de datos.
 *
 * @author Yunen Ramos Ramírez
 * @version 1.0
 */
class ServiceData
{
    private $connection;
    
    /**
     * Función constructora.
     */
    public function ServiceData()
    {
        $this->connection = new Connection();
    }//Fin de la función
    
    /**
     * Función que nos permite obtener todos los servicios de la base de datos.
     * @param array $array Corresponde un arreglo de servicios.
     */
    public function getAllService()
    {
        //Abrimos la conexión
        $connO = $this->connection->getConnection();
        mysqli_set_charset($connO, "utf8");
        
        $sql = "SELECT idService,idInstructorService,nameService,"
                . "descriptionService,quotaService,starDateService,"
                . "endDateService FROM TBService;";
        $result = mysqli_query($connO,$sql);
        $array = [];
        
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $service = new Service($row['idService'], $row['idInstructorService'], $row['nameService'],
                        $row['descriptionService'], $row['quotaService'],
                        $row['starDateService'],$row['endDateService']);
                array_push($array, $service);
            }//Fin del while
        }//Fin del if
        
        $this->connection->closeConnection();
        
        return $array;
    }//Fin de la función
    
    /**
     * Función que nos permite obtener todos los instructores
     */
    public function getAllInstructor()
    {
        //Abrimos la conexión
        $connO = $this->connection->getConnection();
        mysqli_set_charset($connO, "utf8");
        
        $sql = "SELECT TBInstructor.idInstructor,TBPerson.namePerson,"
                . "TBPerson.firstNamePerson,TBPerson.secondNamePerson FROM "
                . "TBInstructor INNER JOIN TBPerson ON"
                . " TBInstructor.idPersonInstructor = TBPerson.idPerson;";
        
        $result = mysqli_query($connO,$sql);
        $array = [];
        
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $person = new Person($row['idInstructor'],0,$row['namePerson'],$row['firstNamePerson'], 
                        $row['secondNamePerson'],0,0,0,0,0,0);
                array_push($array, $person);
            }//Fin del while
        }//Fin del if
        
        $this->connection->closeConnection();
        
        return $array;
    }//Fin de la función
    
    /**
     * Función que nos permite insertar servicios.
     * @param Service $service Corresponde al servicio que se va agregar.
     * @return String Indicando si se ingresó o no.
     */
    public function insertService($service)
    {
        //Obtenemos el ID que le vamos a asignar
        $idService = $this->getLastID("Service");
        
        //Abrimos la conexión
        $connO = $this->connection->getConnection();
        mysqli_set_charset($connO, "utf8");
        
        //Preparamos la información
        $service->setIdInstructorService(mysqli_real_escape_string($connO,$service->getIdInstructorService()));
        $service->setNameService(mysqli_real_escape_string($connO,$service->getNameService()));
        $service->setDescriptionService(mysqli_real_escape_string($connO,$service->getDescriptionService()));
        $service->setQuotaService(mysqli_real_escape_string($connO,$service->getQuotaService()));
        $service->setStartDateService(mysqli_real_escape_string($connO,$service->getStartDateService()));
        $service->setEndDateService(mysqli_real_escape_string($connO,$service->getEndDateService()));
        
        //Ejecutamos la sentencia
        $sql = "INSERT INTO TBService (idService,idInstructorService,nameService,"
                . "descriptionService,quotaService,starDateService,"
                . "endDateService) VALUES ($idService,".$service->getIdInstructorService().","
                . "'".$service->getNameService()."','".$service->getDescriptionService()."',"
                . "".$service->getQuotaService().","
                . "'".$service->getStartDateService()."','".$service->getEndDateService()."');";
        $result = mysqli_query($connO,$sql);
        
        if($result){}
        else{$idService = "0";}
        
        //Cerramos la conexión
        $this->connection->closeConnection();
        return $idService;
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
     * Función que nos permite eliminar servicios.
     * @param int $id Corresponde al id del servicio que se desea eliminar.
     * @return int Indicando si hubieron o no errores.
     */
    public function deleteService($id)
    {
        //Abrimos la conexión
        $connO = $this->connection->getConnection();
        mysqli_set_charset($connO, "utf8");

        //Preparamos la información
        $id = mysqli_real_escape_string($connO,$id);
        
        $sql = "UPDATE TBDayHourService SET TBDayHourService.condition = 0 "
                . "WHERE TBDayHourService.idDayHourService IN "
                . "(SELECT TBRelationServiceSchedule.idDayHourService FROM "
                . "TBRelationServiceSchedule WHERE TBRelationServiceSchedule.idService = $id );";
        $result = mysqli_query($connO,$sql);
        
        if($result)
        {
            $sql = "DELETE FROM TBService WHERE TBService.idService = $id;";
            $result = mysqli_query($connO,$sql);
            if($result){$result = "1";}
            else{$result = "0";}
        }
        else{$result = "0";}
        
        $this->connection->closeConnection();
        
        return $result;
    }//Fin de la función
    
    /**
     * Funcion que nos permite actualizar la informacion de un servicio.
     * @param Service $service Corresponde al servicio que se va actualizar.
     * @return int Indicando si hubieron o no errores.
     */
    public function updateService($service)
    {
        //Abrimos la conexión
        $connO = $this->connection->getConnection();
        mysqli_set_charset($connO, "utf8");
        
        //Preparamos la información
        $service->setIdService(mysqli_real_escape_string($connO,$service->getIdService()));
        $service->setIdInstructorService(mysqli_real_escape_string($connO,$service->getIdInstructorService()));
        $service->setNameService(mysqli_real_escape_string($connO,$service->getNameService()));
        $service->setDescriptionService(mysqli_real_escape_string($connO,$service->getDescriptionService()));
        $service->setQuotaService(mysqli_real_escape_string($connO,$service->getQuotaService()));
        $service->setStartDateService(mysqli_real_escape_string($connO,$service->getStartDateService()));
        $service->setEndDateService(mysqli_real_escape_string($connO,$service->getEndDateService()));
        
        $sql = "UPDATE TBService SET idInstructorService = ".$service->getIdInstructorService().", nameService = '".$service->getNameService()."', "
                . "descriptionService = '".$service->getDescriptionService()."', "
                . "quotaService = '".$service->getQuotaService()."', starDateService = '".$service->getStartDateService()."', "
                . "endDateService = '".$service->getEndDateService()."' WHERE TBService.idService = ".$service->getIdService().";";
        $result = mysqli_query($connO,$sql);
        
        if($result){$result = "1";}
        else{$result = "0";}
        
        $this->connection->closeConnection();
        
        return $result;
    }//Fin de la función
    
    /**
     * Función que nos permite obtener la información de un servicio por el id
     * @param int $id Corresponde al identificador del servicio
     */
    public function getServiceByID($id)
    {
        //Abrimos la conexión
        $connO = $this->connection->getConnection();
        mysqli_set_charset($connO, "utf8");
        
        $sql = "SELECT idService,idInstructorService,nameService, "
                . "descriptionService,quotaService,"
                . "starDateService,endDateService FROM TBService "
                . "WHERE TBService.idService = $id;";
        $result = mysqli_query($connO,$sql);
        $service;
        
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $service = new Service($row['idService'], $row['idInstructorService'], $row['nameService'],
                        $row['descriptionService'], $row['quotaService'],
                        $row['starDateService'],$row['endDateService']);
            }//Fin del while
        }//Fin del if
        
        $this->connection->closeConnection();
        
        return $service;
    }//Fin de la función
}//Fin de la clase
