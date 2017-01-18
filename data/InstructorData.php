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
        $idPerson = $this->getLastID("TBPerson");
        $idInstructor = $this->getLastID("TBInstructor");
        
        //Abrimos la conexión
        $connO = $this->connection->getConnection();
        mysqli_set_charset($connO, "utf8");
        
        //Preparamos la información
        $person->dni = mysqli_real_escape_string($connO,$person->dni);
        $person->personName = mysqli_real_escape_string($connO,$person->personName);
        $person->firstName = mysqli_real_escape_string($connO,$person->firstName);
        $person->secondName = mysqli_real_escape_string($connO,$person->secondName);
        $person->age = mysqli_real_escape_string($connO,$person->age);
        $person->gender = mysqli_real_escape_string($connO,$person->gender);
        $person->email = mysqli_real_escape_string($connO,$person->email);
        $person->address = mysqli_real_escape_string($connO,$person->address);
        
        //Ejecutamos la sentencia
        $sql = "INSERT INTO TBPerson(id,dni,personName,firstName,secondName,age,gender,email,address) VALUES ($idPerson,"
                . "'$person->dni','$person->personName','$person->firstName','$person->secondName',$person->age,$person->gender,"
                . "'$person->email','$person->address');";
        $result = mysqli_query($connO,$sql);
        
        if($result)
        {
            $sql = "INSERT INTO TBInstructor(id,idPerson) VALUES ($idInstructor,$idPerson);";
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
        
        $sql = "SELECT TBPerson.id,dni,personName,firstName,secondName,age,"
                . "gender,email,address FROM TBPerson INNER JOIN TBInstructor ON "
                . "TBPerson.id = TBInstructor.idPerson;";
        $result = mysqli_query($connO,$sql);
        $array = [];
        
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $person = new Person($row['id'], $row['dni'],$row['personName'],$row['firstName'], 
                        $row['secondName'], $row['age'],$row['gender'], $row['email'], $row['address']);
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
        
        $sql = "DELETE FROM TBPerson WHERE TBPerson.id = $id;";
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
        $person->id = mysqli_real_escape_string($connO,$person->id);
        $person->dni = mysqli_real_escape_string($connO,$person->dni);
        $person->personName = mysqli_real_escape_string($connO,$person->personName);
        $person->firstName = mysqli_real_escape_string($connO,$person->firstName);
        $person->secondName = mysqli_real_escape_string($connO,$person->secondName);
        $person->age = mysqli_real_escape_string($connO,$person->age);
        $person->gender = mysqli_real_escape_string($connO,$person->gender);
        $person->email = mysqli_real_escape_string($connO,$person->email);
        $person->address = mysqli_real_escape_string($connO,$person->address);
        
        $sql = "UPDATE TBPerson SET dni = '$person->dni',personName = '$person->personName',"
                . "firstName = '$person->firstName',secondName = '$person->secondName', "
                . "age = $person->age, gender = $person->gender,email = '$person->email',"
                . "address = '$person->address' WHERE TBPerson.id = $person->id;";
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
        $sqlQuery = "SELECT MAX(".$table.".id) as maxID FROM ".$table.";";
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