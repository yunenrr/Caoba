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
    public function existPerson($dniPerson)
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
    
    /**
     * Método que registra los clientes que han llegado a la sala.
     * @param String $dniClient Número de cédula del cliente.
     * @param int $idCampus Identificador del campus.
     * @param int $idService Identificador del servicio.
     * @param Date $date Corresponde a la fecha actual.
     * @param int $idHour Identificador de la hora.
     * @return int 0: Si no se ingresó, y 1 en caso contrario.
     */
    public function registerClientInCampus($dniClient,$idCampus,$idService,$date,$idHour)
    {
        $idHistoryCampus = $this->getLastID("historycampus");
        
        //Inicializamos la conexión y establecemos los carácteres a usar
        $connO = $this->connection->getConnection();
        mysqli_set_charset($connO, "utf8");
        
        $sql = "insert into tbhistorycampus (idhistorycampus, dnipersonhistorycampus,"
                . " idcampushistorycampus,idservicehistorycampus, datehistorycampus, "
                . "hourhistorycampus) values ($idHistoryCampus,'$dniClient',"
                . "$idCampus,$idService,'$date',$idHour);";
        $result = mysqli_query($connO,$sql);
            
        if($result){}
        else{$result = "0";}
        
        //Cerramos la conexión
        $this->connection->closeConnection();
        return $result;
    }//Fin del método
    
    public function existSessionInCurrentCampus($dniClient,$date,$idHour)
    {
        //Inicializamos la conexión y establecemos los carácteres a usar
        $connO = $this->connection->getConnection();
        mysqli_set_charset($connO, "utf8");
        
        $sql = "select dnipersonhistorycampus from tbhistorycampus where "
                . "dnipersonhistorycampus = '$dniClient' and "
                . "datehistorycampus = '$date' and "
                . "hourhistorycampus = $idHour;";
        
        $result = mysqli_query($connO,$sql);
        $id = 1;
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
}//Fin de la clase