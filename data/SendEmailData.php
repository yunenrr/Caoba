<?php
include_once 'ServiceData.php';
require '../resources/PHPMailer/PHPMailerAutoload.php';

/**
 * Clase que nos permite mandar correos.
 *
 * @author Yunen Ramos Ramírez
 * @version 1.0
 */
class SendEmailData
{
    private $connection;
    private $serviceData;
    
    /**
     * Función constructora
     */
    public function SendEmailData() 
    {
        $this->connection = new Connection();
        $this->serviceData = new ServiceData();
    }//Fin del método constructor
    
    /**
     * Función que nos permite mandar los correos.
     * @param int $idService Corresponde al identificador del servicio.
     */
    public function sendEmail($idService)
    {
        $service = $this->serviceData->getServiceByID($idService);
        
        // Creamos una nueva instancia
        $mail = new PHPMailer();
 
        // Activamos el servicio SMTP
        $mail->isSMTP();
        // Activamos / Desactivamos el "debug" de SMTP 
        // 0 = Apagado 
        // 1 = Mensaje de Cliente 
        // 2 = Mensaje de Cliente y Servidor 
        $mail->SMTPDebug = 0; 
 
        // Log del debug SMTP en formato HTML 
        $mail->Debugoutput = 'html'; 
 
        // Servidor SMTP (para este ejemplo utilizamos gmail) 
        $mail->Host = 'smtp.gmail.com'; 
 
        // Puerto SMTP 
        $mail->Port = 587; 
 
        // Tipo de encriptacion SSL ya no se utiliza se recomienda TSL 
        $mail->SMTPSecure = 'tls'; 
 
        // Si necesitamos autentificarnos 
        $mail->SMTPAuth = true; 
 
        // Usuario del correo desde el cual queremos enviar, para Gmail recordar usar el usuario completo (usuario@gmail.com) 
        $mail->Username = "gymcaobacr@gmail.com"; 
 
        // Contraseña 
        $mail->Password = "gymcaoba12345"; 
        
        //Abrimos la conexión
        $connO = $this->connection->getConnection();
 
        $sql = "SELECT nameperson,firstnameperson,secondnameperson,emailperson from "
                . "tbperson inner join tbclientschedule on tbperson.idperson = "
                . "tbclientschedule.idpersonclientschedule where "
                . "tbclientschedule.idserviceclientschedule = ".$idService.";";
        
        // Creamos la sentencias SQL 
        $result = mysqli_query($connO,$sql);

        // Iniciamos el "bucle" para enviar multiples correos. 

        while($row = mysqli_fetch_array($result)) 
        { 
            //Añadimos la direccion de quien envia el corre, en este caso Codejobs, primero el correo, luego el nombre de quien lo envia. 
            $mail->setFrom('gymcaobacr@gmail.com', 'Gym Caoba'); 
            $nameClient = $row['nameperson']." ".$row['firstnameperson']." ".$row['secondnameperson'];
            $mail->addAddress($row['emailperson'], $row['nameperson']); 

            //La linea de asunto 
            $mail->Subject = $service->getNameService().' Service Cancellation'; 

            $message = '            <h1 style="text-align: center;">Service Cancellation</h1>
            <p style="font-size: 20px;">
                Greetings '.$nameClient.', it is a pleasure to write you on behalf of the 
                team of Gym Caoba, we write to inform you that the service '.$service->getNameService().' 
                is no longer being taught from '.$this->getInvertDate($service->getEndDateService()).'.
                <br>
                We apologize for the inconvenience that this news represents for you.</p>';
            
            // La mejor forma de enviar un correo, es creando un HTML e insertandolo de la siguiente forma, PHPMailer permite insertar, imagenes, css, etc. (No se recomienda el uso de Javascript) 
            $mail->msgHTML($message);

            // Enviamos el Mensaje 
            $mail->send(); 

            // Borramos el destinatario, de esta forma nuestros clientes no ven los correos de las otras personas y parece que fuera un único correo para ellos. 
            $mail->ClearAddresses(); 
        }//Fin del while
    }//Fin de la función
    
    /**
     * Función que recibe una fecha en formato yyyy-mm-dd y la retorna en formato dd-mm-yyyy.
     * @param String $date Corresponde a la fecha que se le desea dar vuelta.
     * @return String Fecha ya volteada.
     */
    private function getInvertDate($date)
    {
        $array = explode("-", $date);
        $newDate = $array[2]."-".$array[1]."-".$array[0];
        return $newDate;
    }//Fin de la función
}//Fin de la clase