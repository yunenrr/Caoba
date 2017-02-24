<?php
include_once 'Connection.php';

/**
 * Clase que nos permite gestionar los registros del historial de las salas
 *
 * @author Yunen Ramos Ramírez
 * @version 1.0
 */
class HistoryCampusData 
{
    private $connection;
    
    /**
     * Método constructor
     */
    function HistoryCampusData() 
    {
        $this->connection = new Connection();
    }//Fin del método constructor

    /**
     * Método que se encarga de verificar si una persona existe en la base.
     * @param String $dniPerson Corresponde al número de cédula de la persona.
     * @return int 0: Si no existe, y 1 en caso contrario.
     */
    function existPerson($dniPerson)
    {
        $connO = $this->connection->getConnection();
        mysqli_set_charset($connO, "utf8");
        
        //Validamos la información
        $dniPerson = mysqli_real_escape_string($connO,$dniPerson);
        
        //Sentencia sql
        $sql = "select dniperson from tbperson where dniperson = '$dniPerson';";
        
        $result = mysqli_query($connO,$sql);
        
        if(mysqli_num_rows($result) > 0)
        {
            $id = 1;
        }
        else
        {
            $id = 0;
        }
        
        //Cerramos la conexión
        $this->connection->closeConnection();
        return $id;
    }//Fin del método
}//Fin de la clase