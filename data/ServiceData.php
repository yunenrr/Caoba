<?php
include 'Connection.php';
include '../domain/Service.php';
include '../domain/Person.php';
include '../domain/PaymentModule.php';
include '../domain/Day.php';
include '../domain/DayHourService.php';

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
                . "descriptionService,priceService,quotaService,starDateService,"
                . "endDateService FROM TBService;";
        $result = mysqli_query($connO,$sql);
        $array = [];
        
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $service = new Service($row['idService'], $row['idInstructorService'], $row['nameService'],
                        $row['descriptionService'], $row['priceService'], $row['quotaService'],
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
        $service->setPriceService(mysqli_real_escape_string($connO,$service->getPriceService()));
        $service->setQuotaService(mysqli_real_escape_string($connO,$service->getQuotaService()));
        $service->setStartDateService(mysqli_real_escape_string($connO,$service->getStartDateService()));
        $service->setEndDateService(mysqli_real_escape_string($connO,$service->getEndDateService()));
        
        //Ejecutamos la sentencia
        $sql = "INSERT INTO TBService (idService,idInstructorService,nameService,"
                . "descriptionService,priceService,quotaService,starDateService,"
                . "endDateService) VALUES ($idService,".$service->getIdInstructorService().","
                . "'".$service->getNameService()."','".$service->getDescriptionService()."',"
                . "".$service->getPriceService().",".$service->getQuotaService().","
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
        $service->setPriceService(mysqli_real_escape_string($connO,$service->getPriceService()));
        $service->setQuotaService(mysqli_real_escape_string($connO,$service->getQuotaService()));
        
        $sql = "UPDATE TBService SET idInstructorService = ".$service->getIdInstructorService().", nameService = '".$service->getNameService()."',descriptionService = '".$service->getDescriptionService()."', priceService = ".$service->getPriceService().", quotaService = ".$service->getQuotaService()." WHERE TBService.idService = ".$service->getIdService().";";
        $result = mysqli_query($connO,$sql);
        
        if($result){$result = "1";}
        else{$result = "0";}
        
        $this->connection->closeConnection();
        
        return $result;
    }//Fin de la función
    
    /**
     * Función que nos permite obtener todos los métodos de pago existentes.
     */
    public function getAllPaymentModule()
    {
        //Abrimos la conexión
        $connO = $this->connection->getConnection();
        mysqli_set_charset($connO, "utf8");
        
        $sql = "SELECT idPaymentModule, namePaymentModule FROM TBPaymentModule;";
        
        $result = mysqli_query($connO,$sql);
        $array = [];
        
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $paymentModule = new PaymentModule($row['idPaymentModule'], 
                        $row['namePaymentModule']);
                array_push($array, $paymentModule);
            }//Fin del while
        }//Fin del if
        
        $this->connection->closeConnection();
        
        return $array;
    }//Fin de la función
    
    /**
     * Función que nos permite insertar métodos de pago para los servicios.
     * @param int $idService Corresponde al identificador del servicio.
     * @param int $idPaymentMethod Corresponde al identificador del método de pago.
     * @return String Indicando si se ingresó o no.
     */
    public function insertServicePaymentMethod($idService,$idPaymentMethod)
    {
        //Obtenemos el ID que le vamos a asignar
        $idServicePaymentMethod = $this->getLastID("ServicePaymentModule");
        
        //Abrimos la conexión
        $connO = $this->connection->getConnection();
        mysqli_set_charset($connO, "utf8");
        
        //Preparamos la información
        $idService = mysqli_real_escape_string($connO,$idService);
        $idPaymentMethod = mysqli_real_escape_string($connO,$idPaymentMethod);
        
        //Ejecutamos la sentencia
        $sql = "INSERT INTO TBServicePaymentModule(idServicePaymentModule,"
                . "idServiceServicePaymentModule,idPaymentModuleServicePaymentModule)"
                . " VALUES ($idServicePaymentMethod,$idService,$idPaymentMethod);";
        $result = mysqli_query($connO,$sql);
        
        if($result){$result="1";}
        else{$result = "0";}
        
        //Cerramos la conexión
        $this->connection->closeConnection();
        return $result;
    }//Fin de la función
    
    /**
     * Función que nos permite obtener todos los días de la base de datos.
     */
    public function getAllDay()
    {
        //Abrimos la conexión
        $connO = $this->connection->getConnection();
        mysqli_set_charset($connO, "utf8");
        
        $sql = "SELECT TBDayHourService.dayService,TBDay.nameDay FROM TBDayHourService INNER JOIN TBDay ON TBDayHourService.dayService = TBDay.idDay GROUP BY TBDay.idDay;";
        
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
     * Función que nos permite obtener los horarios por día
     */
    public function getScheduleByDay($day)
    {
        //Abrimos la conexión
        $connO = $this->connection->getConnection();
        mysqli_set_charset($connO, "utf8");
        
        //Prepraramos la información para la consulta
        $day = mysqli_real_escape_string($connO,$day);
        $sql = "SELECT idDayHourService,dayService, hourStartService,hourEndService FROM TBDayHourService WHERE TBDayHourService.condition = 0 AND TBDayHourService.dayService = $day;";
        
        $result = mysqli_query($connO,$sql);
        $array = [];
        
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $dayHourService = new DayHourService($row['idDayHourService'], 
                        $row['dayService'], $row['hourStartService'], $row['hourEndService']);
                array_push($array, $dayHourService);
            }//Fin del while
        }//Fin del if
        
        $this->connection->closeConnection();
        
        return $array;
    }//Fin de la función

    /**
     * Función que nos permite insertar horarios para los servicios.
     * @param int $idService Corresponde al identificador del servicio.
     * @param int $idSchedule Corresponde al identificador del horario.
     * @return String Indicando si se ingresó o no.
     */
    public function insertSchedule($idService,$idSchedule)
    {
        //Obtenemos el ID que le vamos a asignar
        $idRelationServiceSchedule = $this->getLastID("RelationServiceSchedule");
        
        //Abrimos la conexión
        $connO = $this->connection->getConnection();
        mysqli_set_charset($connO, "utf8");
        
        //Preparamos la información
        $idService = mysqli_real_escape_string($connO,$idService);
        $idSchedule = mysqli_real_escape_string($connO,$idSchedule);
        
        //Ejecutamos la sentencia
        $sql = "UPDATE TBDayHourService SET TBDayHourService.condition = 1 WHERE TBDayHourService.idDayHourService = $idSchedule;";
        $result = mysqli_query($connO,$sql);
        
        if($result)
        {
            $sql = "INSERT INTO TBRelationServiceSchedule "
                    . "(idRelationServiceSchedule,idDayHourService,idService) "
                    . "VALUES ($idRelationServiceSchedule,$idSchedule,$idService);";
            $result = mysqli_query($connO,$sql);
            
            if($result){}
            else{$result = "0";}
        }
        else{$result = "0";}
        
        //Cerramos la conexión
        $this->connection->closeConnection();
        return $result;
    }//Fin de la función
}//Fin de la clase
