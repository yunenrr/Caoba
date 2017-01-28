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
        
        $sql = "SELECT idCampus, nameCampus FROM TBCampus;";
        $result = mysqli_query($connO,$sql);
        $array = [];
        
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $campus = new Campus($row['idCampus'], $row['nameCampus']);
                array_push($array, $campus);
            }//Fin del while
        }//Fin del if
        
        $this->connection->closeConnection();
        
        return $array;
    }//Fin de la función
}//Fin de la clase