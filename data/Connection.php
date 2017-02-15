<?php

/**
 * Clase que nos permite configurar los parámetros de conexión con la base de 
 * datos
 * @author Yunen Ramos Ramírez
 * @version 1.0
 */
class Connection 
{

    //Declaración de clases globales
    private $server, $user, $password, $db;
    private $connection;

    /**
     * Función constructora
     */

//    public function Connection() {
//        $this->server = '163.178.107.130';
//        $this->user = 'adm';
//        $this->password = 'saucr.092';
//        $this->db = 'gymcaoba';
//    }

    public function Connection() 
    {
        $this->server = "localhost";
        $this->user = "root";
        $this->password = "";
        $this->db = "gymcaoba";
    }//Fin de la función
//    
    /**
     * Función que nos permite obtener la conexión a la base de datos
     */
    public function getConnection() 
    {
        $this->connection = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        return $this->connection;
    }//Fin de la función

    /**
     * Función que nos permite cerrar la conexión con la base de datos
     */
    public function closeConnection() 
    {
        mysqli_close($this->connection);
    }//Fin de la función
}//Fin de la clase
