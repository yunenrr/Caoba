<?php
include 'Connection.php';
include '../domain/Campus.php';

/**
 * Clase que nos permite manipular los campus en la base de datos.
 *
 * @author Yunen Ramos Ramírez
 * @version 1.0
 */
class CampusData
{
    private $connection;
    
    function CampusData() 
    {
        $this->connection = new Connection();
    }//Fin del método constructor

    /**
     * Función que nos permite obtener todos los campus de la base de datos.
     * @param array $array Corresponde un arreglo de campus.
     */
    public function getAllCampus()
    {
        //Abrimos la conexión
        $connO = $this->connection->getConnection();
        mysqli_set_charset($connO, "utf8");
        
        $sql = "select idcampus, namecampus from tbcampus;";
        $result = mysqli_query($connO,$sql);
        $array = [];
        
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $campus = new Campus($row['idcampus'], $row['namecampus']);
                array_push($array, $campus);
            }//Fin del while
        }//Fin del if
        
        $this->connection->closeConnection();
        
        return $array;
    }//Fin de la función
    
    /**
     * Función que nos permite eliminar de la base los horarios antiguos.
     * @param date $currentDate Corresponde a la fecha actual del sistema.
     */
    public function updateCampusSchedule($currentDate)
    {
        //Abrimos la conexión
        $connO = $this->connection->getConnection();
        mysqli_set_charset($connO, "utf8");
        
        //Validamos la información
        $currentDate = mysqli_real_escape_string($connO,$currentDate);
        
        $sql = "delete from tbscheduleservice where datescheduleservice < '$currentDate';";
        $result = mysqli_query($connO,$sql);
        
        if($result){}
        else{$result = "0";}
        
        //Cerramos la conexión
        $this->connection->closeConnection();
        return $result;
    }//Fin del método
}//Fin de la clase