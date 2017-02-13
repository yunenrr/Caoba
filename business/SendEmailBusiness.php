<?php
include_once '../data/SendEmailData.php';

/**
 * Clase que nos va a permitir manipular mandar correos.
 * @author Yunen Ramos Ramírez
 * @version 1.0
 */
if(isset($_POST['option']))
{
    $option = $_POST['option'];
    
    /**
     * Opciones:
     * 1 - Envíar correos.
     */
    switch($option)
    {
        case 1:
            $idService = $_POST['id'];
            $data = new SendEmailData();
            $data->sendEmail($idService);
            break;
    }//Fin del switch
}//Fin del if
?>