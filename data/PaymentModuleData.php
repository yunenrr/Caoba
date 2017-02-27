<?php
include_once 'Connection.php';
include_once '../domain/PaymentModule.php';

/**
 * Clase que nos permite manipular los métodos de pago en la base de datos.
 *
 * @author Yunen Ramos Ramírez
 * @version 1.0
 */
class PaymentModuleData
{
    //Declaración de variables globales
    private $connection;
    
    /**
     * Función constructora
     */
    function __construct() 
    {
        $this->connection = new Connection();
    }//Fin de la función constructora

    /**
     * Función que nos permite obtener todos los métodos de pago existentes.
     */
    public function getAllPaymentModule()
    {
        //Abrimos la conexión
        $connO = $this->connection->getConnection();
        mysqli_set_charset($connO, "utf8");
        
        $sql = "SELECT idpaymentmodule, namepaymentmodule FROM tbpaymentmodule;";
        
        $result = mysqli_query($connO,$sql);
        $array = [];
        
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $paymentModule = new PaymentModule($row['idpaymentmodule'], 
                        $row['namepaymentmodule'],0);
                array_push($array, $paymentModule);
            }//Fin del while
        }//Fin del if
        
        $this->connection->closeConnection();
        
        return $array;
    }//Fin de la función
    
    /**
     * Función que nos permite insertar métodos de pago para los servicios.
     * @param int $idService Corresponde al identificador del servicio.
     * @param int $idPaymentMethod Corresponde al identificador del método de pago.
     * @param int $price Corresponde al monto a pagar por el servicio con la modalidad seleccionada.
     * @return String Indicando si se ingresó o no.
     */
    public function insertServicePaymentMethod($idService,$idPaymentMethod,$price)
    {
        //Obtenemos el ID que le vamos a asignar
        $idServicePaymentMethod = $this->getLastID("servicepaymentmodule");
        
        //Abrimos la conexión
        $connO = $this->connection->getConnection();
        mysqli_set_charset($connO, "utf8");
        
        //Preparamos la información
        $idService = mysqli_real_escape_string($connO,$idService);
        $idPaymentMethod = mysqli_real_escape_string($connO,$idPaymentMethod);
        $price = mysqli_real_escape_string($connO,$price);
        
        //Ejecutamos la sentencia
        $sql = "INSERT INTO tbservicepaymentmodule(idservicepaymentmodule,"
                . "idserviceservicepaymentmodule,idpaymentmoduleservicepaymentmodule,priceservicepaymentmodule)"
                . " VALUES ($idServicePaymentMethod,$idService,$idPaymentMethod,$price);";
        $result = mysqli_query($connO,$sql);
        
        if($result){$result="1";}
        else{$result = "0";}
        
        //Cerramos la conexión
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
     * Función que nos permite obtener todos los métodos de pago existentes para un servicio en específico.
     * @param String $id Corresponde al identificador del servicio.
     */
    public function getCurrentPaymentModule($id)
    {
        //Abrimos la conexión
        $connO = $this->connection->getConnection();
        mysqli_set_charset($connO, "utf8");
        
        $sql = "SELECT idpaymentmodule, namepaymentmodule,priceservicepaymentmodule FROM tbpaymentmodule "
                . "INNER JOIN tbservicepaymentmodule ON tbpaymentmodule.idpaymentmodule = "
                . "tbservicepaymentmodule.idpaymentmoduleservicepaymentmodule WHERE "
                . "tbservicepaymentmodule.idserviceservicepaymentmodule = $id;";
        
        $result = mysqli_query($connO,$sql);
        $array = [];
        
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $paymentModule = new PaymentModule($row['idpaymentmodule'], 
                        $row['namepaymentmodule'],$row['priceservicepaymentmodule']);
                array_push($array, $paymentModule);
            }//Fin del while
        }//Fin del if
        
        $this->connection->closeConnection();
        
        return $array;
    }//Fin de la función
    
    /**
     * Función que nos permite eliminar métodos de pago para los servicios.
     * @param int $idService Corresponde al identificador del servicio.
     * @param int $idPaymentMethod Corresponde al identificador del método de pago.
     * @return String Indicando si se ingresó o no.
     */
    public function deleteServicePaymentMethod($idService,$idPaymentMethod)
    {   
        //Abrimos la conexión
        $connO = $this->connection->getConnection();
        mysqli_set_charset($connO, "utf8");
        
        //Preparamos la información
        $idService = mysqli_real_escape_string($connO,$idService);
        $idPaymentMethod = mysqli_real_escape_string($connO,$idPaymentMethod);
        
        //Ejecutamos la sentencia
        $sql = "DELETE FROM tbservicepaymentmodule WHERE "
                . "tbservicepaymentmodule.idserviceservicepaymentmodule = $idService "
                . "AND tbservicepaymentmodule.idpaymentmoduleservicepaymentmodule = $idPaymentMethod;";
        $result = mysqli_query($connO,$sql);
        if($result){$result="1";}
        else{$result = "0";}
        
        //Cerramos la conexión
        $this->connection->closeConnection();
        return $result;
    }//Fin de la función
}//Fin de la clase PaymentModuleData 