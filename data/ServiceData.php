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
        
        $sql = "select idservice, idinstructorservice, nameservice, "
                . "descriptionservice, quotaservice,enddateservice, "
                . "DATEDIFF(enddateservice,CURRENT_DATE) as 'diffDays' "
                . "from tbservice;";
        $result = mysqli_query($connO,$sql);
        $array = [];
        
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $service = new Service($row['idservice'], $row['idinstructorservice'], $row['nameservice'],
                        $row['descriptionservice'], $row['quotaservice'],
                        $row['enddateservice'],$row['diffDays']);
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
        
        $sql = "select tbinstructor.idinstructor,tbperson.nameperson,"
                . "tbperson.firstnameperson,tbperson.secondnameperson from "
                . "tbinstructor inner join tbperson on"
                . " tbinstructor.idpersoninstructor = tbperson.idperson;";
        
        $result = mysqli_query($connO,$sql);
        $array = [];
        
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $person = new Person($row['idinstructor'],0,$row['nameperson'],$row['firstnameperson'], 
                        $row['secondnameperson'],0,0,0,0,0,0);
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
        $idService = $this->getLastID("service");
        
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
        $sql = "insert into tbservice (idservice,idinstructorservice,nameservice,"
                . "descriptionservice,quotaservice,stardateservice,"
                . "enddateservice) values($idService,".$service->getIdInstructorService().","
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
        
        $sql = "update tbdayhourservice set tbdayhourservice.condition = 0 "
                . "where tbdayhourservice.iddayhourservice in "
                . "(select tbrelationserviceschedule.iddayhourservice from "
                . "tbrelationserviceschedule where tbrelationserviceschedule.idservice = $id );";
        $result = mysqli_query($connO,$sql);
        
        if($result)
        {
            $sql = "DELETE FROM tbservice WHERE tbservice.idservice = $id;";
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
        
        $sql = "UPDATE tbservice SET idinstructorservice = ".$service->getIdInstructorService().", "
                . "nameservice = '".$service->getNameService()."', "
                . "descriptionservice = '".$service->getDescriptionService()."', "
                . "quotaservice = ".$service->getQuotaService()." WHERE tbservice.idservice = ".$service->getIdService().";";
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
        
        $sql = "select idservice, idinstructorservice, nameservice, "
                . "descriptionservice, quotaservice, stardateservice,enddateservice "
                . "from tbservice where tbservice.idservice = $id;";
        
        $result = mysqli_query($connO,$sql);
        $service;
        
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $service = new Service($row['idservice'], $row['idinstructorservice'], $row['nameservice'],
                        $row['descriptionservice'], $row['quotaservice'],
                        $row['stardateservice'],$row['enddateservice']);
            }//Fin del while
        }//Fin del if
        
        $this->connection->closeConnection();
        
        return $service;
    }//Fin de la función
    
    /**
     * Método que nos permite renovar las fechas de un servicio.
     * @param Service $service Corresponde al servicio que se desea actualizar.
     * @return int 0:si ocurrió un error y 1:si se ingresa correctamente.
     */
    public function renewService($service)
    {
        //Abrimos la conexión
        $connO = $this->connection->getConnection();
        mysqli_set_charset($connO, "utf8");
        
        //Preparamos la información
        $service->setIdService(mysqli_real_escape_string($connO,$service->getIdService()));
        $service->setStartDateService(mysqli_real_escape_string($connO,$service->getStartDateService()));
        $service->setEndDateService(mysqli_real_escape_string($connO,$service->getEndDateService()));
        
        $sql = "update tbservice set stardateservice = '".$service->getStartDateService()."', "
                . "enddateservice = '".$service->getEndDateService()."' where tbservice.idservice = ".$service->getIdService().";";
        $result = mysqli_query($connO,$sql);
        
        if($result){$result = "1";}
        else{$result = "0";}
        
        $this->connection->closeConnection();
        
        return $result;
    }//Fin de la función
}//Fin de la clase
