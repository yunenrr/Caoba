<?php
include_once '../data/PaymentModuleData.php';

/**
 * Clase que nos va a permitir manipular el CRUD de métodos de pago.
 * @author Yunen Ramos Ramírez
 * @version 1.0
 */
if(isset($_POST['option']))
{
    $option = $_POST['option'];
    
    /**
     * Opciones:
     * 1 - Obtener todos los metodos de pago
     * 2 - Obtener los métodos de pagos actuales
     * 3 - Eliminar métodos de pago de un servicio.
     * 4 - Insertar métodos de pago a un servicio específico.
     */
    switch($option)
    {
        case 1:
            $data = new PaymentModuleData();
            $array = $data->getAllPaymentModule();
            $temp = "";
            foreach ($array as $current)
            {   
                $temp = $temp.$current->getIdPaymentModule().",";
                $temp = $temp.$current->getNamePaymentModule().";";
            }//Fin del foreach
            if(strlen($temp) > 0){$temp = substr($temp,0, strlen($temp)-1);}
            echo $temp;
            break;
        case 2:
            $id = $_POST['id'];
            $data = new PaymentModuleData();
            $array = $data->getCurrentPaymentModule($id);
            $temp = "";
            foreach ($array as $current)
            {   
                $temp = $temp.$current->getIdPaymentModule().",";
                $temp = $temp.$current->getNamePaymentModule().",";
                $temp = $temp.$current->getPricePaymentModule().";";
            }//Fin del foreach
            if(strlen($temp) > 0){$temp = substr($temp,0, strlen($temp)-1);}
            echo $temp;
            break;
        case 3:
            $idService = $_POST['id'];
            $idPaymentMethod = $_POST['paymentMethod'];
            $data = new PaymentModuleData();
            echo $data->deleteServicePaymentMethod($idService, $idPaymentMethod);
            break;
        case 4:
            $idService = $_POST['id'];
            $idPaymentMethod = $_POST['paymentMethod'];
            $array = explode(",", $idPaymentMethod);
            $data = new PaymentModuleData();
            echo $data->insertServicePaymentMethod($idService,$array[0],$array[1]);
            breaK;
    }//Fin del switch
}//Fin del if