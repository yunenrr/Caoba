<?php
include 'Connection.php';
include '../domain/Service.php';
include '../domain/Person.php';

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
        
        $sql = "SELECT idService,idInstructorService,nameService,descriptionService,"
                . "priceService, quotaService FROM TBService;";
        $result = mysqli_query($connO,$sql);
        $array = [];
        
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $service = new Service($row['idService'], $row['idInstructorService'], $row['nameService'],
                        $row['descriptionService'], $row['priceService'], $row['quotaService']);
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
                        $row['secondNamePerson'],0,0,0,0);
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
        
        //Ejecutamos la sentencia
        $sql = "INSERT INTO TBService(idService,idInstructorService,nameService,descriptionService,priceService,quotaService) "
                . "VALUES ($idService,".$service->getIdInstructorService().",'".$service->getNameService()."',"
                . "'".$service->getDescriptionService()."',".$service->getPriceService().",".$service->getQuotaService().");";
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
        
        $sql = "DELETE FROM TBService WHERE TBService.idService = $id;";
        $result = mysqli_query($connO,$sql);
        
        if($result){$result = "1";}
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
}//Fin de la clase
