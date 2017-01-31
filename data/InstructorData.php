<?php
include 'Connection.php';
include '../domain/Person.php';
include '../domain/Gender.php';

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
        $idPerson = $this->getLastID("person");
        $idInstructor = $this->getLastID("instructor");
        
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
        $person->setPhoneReferencePerson(mysqli_real_escape_string($connO,$person->getPhoneReferencePerson()));
        $person->setBloodTypePerson(mysqli_real_escape_string($connO,$person->getBloodTypePerson()));
        
        //Ejecutamos la sentencia
        $sql = "insert into tbperson(idperson,dniperson,nameperson,firstnameperson,secondnameperson,ageperson,genderperson,"
                . "emailperson,addressperson,phonereferenceperson,bloodtypeperson) VALUES ($idPerson,"
                . "'".$person->getDniPerson()."','".$person->getNamePerson()."','".$person->getFirstNamePerson()."','".$person->getSecondNamePerson()."',".$person->getAgePerson().",".$person->getGenderPerson().","
                . "'".$person->getEmailPerson()."','".$person->getAddressPerson()."','".$person->getPhoneReferencePerson()."'"
                . ",'".$person->getBloodTypePerson()."');";
        $result = mysqli_query($connO,$sql);
        
        if($result)
        {
            $sql = "insert into tbinstructor(idinstructor,idpersoninstructor) values) VALUES ($idInstructor,$idPerson);";
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
        
        $sql = "select tbperson.idperson,dniperson,nameperson,firstnameperson,"
                . "secondnameperson,ageperson,genderperson,emailperson,"
                . "addressperson,phonereferenceperson,bloodtypeperson from tbperson "
                . "inner join tbinstructor on tbperson.idperson = tbinstructor.idpersoninstructor;";
        $result = mysqli_query($connO,$sql);
        $array = [];
        
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $person = new Person($row['idperson'], $row['dniperson'],$row['nameperson'],$row['firstnameperson'], 
                        $row['secondnamePerson'], $row['ageperson'],$row['genderperson'], $row['emailperson'], 
                        $row['addressperson'],$row['phonereferenceperson'],$row['bloodtypeperson']);
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
        
        $sql = "delete from tbperson where tbperson.idperson = $id;";
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
        $person->setPhoneReferencePerson(mysqli_real_escape_string($connO,$person->getPhoneReferencePerson()));
        $person->setBloodTypePerson(mysqli_real_escape_string($connO,$person->getBloodTypePerson()));
        
        $sql = "UPDATE tbperson set dniperson = '".$person->getDniPerson()."',nameperson = '".$person->getNamePerson()."', firstnameperson = '".$person->getFirstNamePerson()."', secondnameperson = '".$person->getSecondNamePerson()."', ageperson = ".$person->getAgePerson().", genderperson = ".$person->getGenderPerson().", emailperson = '".$person->getEmailPerson()."', addressperson = '".$person->getAddressPerson()."', phonereferenceperson = '".$person->getPhoneReferencePerson()."', bloodtypeperson = '".$person->getBloodTypePerson()."' WHERE tbperson.idperson = ".$person->getIdPerson().";";
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
     * Función que nos permite obtener todos los géneros
     */
    public function getAllGender()
    {
        //Abrimos la conexión
        $connO = $this->connection->getConnection();
        mysqli_set_charset($connO, "utf8");
        
        $sql = "SELECT idgender, namegender FROM tbgender;";
        
        $result = mysqli_query($connO,$sql);
        $array = [];
        
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $gender = new Gender($row['idgender'], $row['namegender']);
                array_push($array, $gender);
            }//Fin del while
        }//Fin del if
        
        $this->connection->closeConnection();
        
        return $array;
    }//Fin de la función
}//Fin de la clase