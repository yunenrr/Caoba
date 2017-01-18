<?php
include 'Connection.php';
include '../domain/Person.php';

/**
 * Clase que nos permite manipular el instructor en la base de datos.
 *
 * @author Yunen Ramos Ramírez
 * @version 1.0
 */
class InstructorData
{
    //Variables globales
    private $connection;
    
    /**
     * Función constructora
     */
    public function InstructorData()
    {
        $this->connection = new Connection();
    }//Fin de la función
    
    /**
     * Función que nos permite insertar instructores.
     * @param person $person Corresponde al instructor que se va agregar.
     * @return String Indicando si se ingresó o no.
     */
    public function insertInstructor($person)
    {
        //Obtenemos el ID que le vamos a asignar
        $idPerson = $this->getLastID("Person");
        $idInstructor = $this->getLastID("Instructor");
        
        //Abrimos la conexión
        $connO = $this->connection->getConnection();
        mysqli_set_charset($connO, "utf8");
        
        //Preparamos la información
        $person->setDniPerson(mysqli_real_escape_string($connO,$person->getDniPerson()));
        $person->setNamePerson(mysqli_real_escape_string($connO,$person->getNamePerson()));
        $person->setFirstNamePerson(mysqli_real_escape_string($connO,$person->getFirstNamePerson()));
        $person->setSecondNamePerson(mysqli_real_escape_string($connO,$person->getSecondNamePerson()));
        $person->setAgePerson(mysqli_real_escape_string($connO,$person->getAgePerson()));
        $person->setGenderPerson(mysqli_real_escape_string($connO,$person->getGenderPerson()));
        $person->setEmailPerson(mysqli_real_escape_string($connO,$person->getEmailPerson()));
        $person->setAddressPerson(mysqli_real_escape_string($connO,$person->getAddressPerson()));
        
        //Ejecutamos la sentencia
        $sql = "INSERT INTO TBPerson(idPerson,dniPerson,namePerson,firstNamePerson,secondNamePerson,agePerson,genderPerson,emailPerson,addressPerson) VALUES ($idPerson,"
                . "'".$person->getDniPerson()."','".$person->getNamePerson()."','".$person->getFirstNamePerson()."','".$person->getSecondNamePerson()."',".$person->getAgePerson().",".$person->getGenderPerson().","
                . "'".$person->getEmailPerson()."','".$person->getAddressPerson()."');";
        $result = mysqli_query($connO,$sql);
        
        if($result)
        {
            $sql = "INSERT INTO TBInstructor(idInstructor,idPersonInstructor) VALUES ($idInstructor,$idPerson);";
            $result = mysqli_query($connO,$sql);
            
            if($result){}
            else{$idPerson = "0";}
        }
        else{$idPerson = "0";}
        
        //Cerramos la conexión
        $this->connection->closeConnection();
        return $idPerson;
    }//Fin de la función
    
    /**
     * Función que nos permite obtener todos los intructores de la base de datos.
     * @param array $array Corresponde un arreglo de instructores.
     */
    public function getAllInstructor()
    {
        //Abrimos la conexión
        $connO = $this->connection->getConnection();
        mysqli_set_charset($connO, "utf8");
        
        $sql = "SELECT TBPerson.idPerson,dniPerson,namePerson,firstNamePerson,secondNamePerson,agePerson,genderPerson,"
                . "emailPerson,addressPerson FROM TBPerson INNER JOIN TBInstructor ON TBPerson.idPerson = TBInstructor.idPersonInstructor;";
        $result = mysqli_query($connO,$sql);
        $array = [];
        
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $person = new Person($row['idPerson'], $row['dniPerson'],$row['namePerson'],$row['firstNamePerson'], 
                        $row['secondNamePerson'], $row['agePerson'],$row['genderPerson'], $row['emailPerson'], 
                        $row['addressPerson']);
                array_push($array, $person);
            }//Fin del while
        }//Fin del if
        
        $this->connection->closeConnection();
        
        return $array;
    }//Fin de la función
    
    /**
     * Función que nos permite eliminar instructores.
     * @param int $id Corresponde al id de la persona que se desea eliminar.
     * @return int Indicando si hubieron o no errores.
     */
    public function deleteInstructor($id)
    {
        //Abrimos la conexión
        $connO = $this->connection->getConnection();
        mysqli_set_charset($connO, "utf8");

        //Preparamos la información
        $id = mysqli_real_escape_string($connO,$id);
        
        $sql = "DELETE FROM TBPerson WHERE TBPerson.idPerson = $id;";
        $result = mysqli_query($connO,$sql);
        
        if($result){$result = "1";}
        else{$result = "0";}
        
        $this->connection->closeConnection();
        
        return $result;
    }//Fin de la función
    
    /**
     * Funcion que nos permite actualizar la informacion de un instructor.
     * @param Person $person Corresponde al instructor que se va actualizar.
     * @return int Indicando si hubieron o no errores.
     */
    public function updateInstructor($person)
    {
        //Abrimos la conexión
        $connO = $this->connection->getConnection();
        mysqli_set_charset($connO, "utf8");
        
        //Preparamos la información
        $person->setIdPerson(mysqli_real_escape_string($connO,$person->getIdPerson()));
        $person->setDniPerson(mysqli_real_escape_string($connO,$person->getDniPerson()));
        $person->setNamePerson(mysqli_real_escape_string($connO,$person->getNamePerson()));
        $person->setFirstNamePerson(mysqli_real_escape_string($connO,$person->getFirstNamePerson()));
        $person->setSecondNamePerson(mysqli_real_escape_string($connO,$person->getSecondNamePerson()));
        $person->setAgePerson(mysqli_real_escape_string($connO,$person->getAgePerson()));
        $person->setGenderPerson(mysqli_real_escape_string($connO,$person->getGenderPerson()));
        $person->setEmailPerson(mysqli_real_escape_string($connO,$person->getEmailPerson()));
        $person->setAddressPerson(mysqli_real_escape_string($connO,$person->getAddressPerson()));
        
        $sql = "UPDATE TBPerson SET dniPerson = '".$person->getDniPerson()."',namePerson = '".$person->getNamePerson()."',"
                . "firstNamePerson = '".$person->getFirstNamePerson()."',secondNamePerson = '".$person->getSecondNamePerson()."', "
                . "agePerson = ".$person->getAgePerson().", genderPerson = ".$person->getGenderPerson().",emailPerson = '".$person->getEmailPerson()."',"
                . "addressPerson = '".$person->getAddressPerson()."' WHERE TBPerson.idPerson = ".$person->getIdPerson().";";
        $result = mysqli_query($connO,$sql);
        
        if($result){$result = "1";}
        else{$result = "0";}
        
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
}//Fin de la clase