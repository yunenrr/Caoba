<?php
include_once '../data/ServiceData.php';
include_once '../data/PaymentModuleData.php';

/**
 * Clase que nos va a permitir manipular el CRUD de servicios
 * @author Yunen Ramos Ramírez
 * @version 1.0
 */
if(isset($_POST['option']))
{
    $option = $_POST['option'];
    
    /**
     * Opciones:
     * 1 - Obtener todos los servicios.  
     * 2 - Obtener todos los instructores.
     * 3 - Insertar un nuevo servicio.
     * 4 - Eliminar servicios.
     * 5 - Actualizar servicios.
     * 7 - Obtener todos los días.
     * 9 - Obtener la información de un servicio específico.
     */
    switch($option)
    {
        case 1:
            $data = new ServiceData();
            $array = $data->getAllService();
            $temp = "";
            foreach ($array as $current)
            {   
                $temp = $temp.$current->getIdService().",";
                $temp = $temp.$current->getNameService().",";
                $temp = $temp.$current->getEndDateService().";";
            }//Fin del foreach
            if(strlen($temp) > 0){$temp = substr($temp,0, strlen($temp)-1);}
            echo $temp;
            break;
        case 2:
            $data = new ServiceData();
            $temp = "";
            $array = $data->getAllInstructor();
            
            foreach ($array as $current)
            {
                $temp = $temp.$current->getIdPerson().",";
                $temp = $temp.$current->getNamePerson()." ".$current->getFirstNamePerson()." ".$current->getSecondNamePerson().";";
            }//Fin del foreach
            if(strlen($temp) > 0){$temp = substr($temp,0, strlen($temp)-1);}
            echo $temp;
            break;
        case 3:
            $idInstructor = $_POST['selInstructor'];
            $serviceName = $_POST['txtName'];
            $description = $_POST['txtDescription'];
            $quota = $_POST['txtQuota'];
            $periodicity = $_POST['selPeriodicity'];
            $txtStartDate = $_POST['txtStartDate'];
            $paymentMethod = $_POST['paymentMethod'];
            $condition = 0;
            
            //Verificamos que no estén vacíos
            if((strlen($idInstructor) > 0) &&
                (strlen($serviceName) > 0) &&
                (strlen($description) > 0) &&
                (strlen($quota) > 0))
            {
                $data = new ServiceData();
                $paymentModuleData = new PaymentModuleData();
                $dateInsert =  strtotime("$txtStartDate");
                $calDateEnd = strtotime("$periodicity month","$dateInsert");
                $dateEnd = date("Y-m-d",$calDateEnd);
                
                $service = new Service(0, $idInstructor, $serviceName, 
                        $description, $quota,$txtStartDate,$dateEnd);
                $condition = $data->insertService($service);
                
                //Insertamos las modalidades de pago
                if($condition !== "0")
                {
                    $array = explode(";", $paymentMethod);
                    foreach ($array as $current)
                    {
                        $arraySecond = explode(",", $current);
                        $cond = $paymentModuleData->insertServicePaymentMethod($condition,$arraySecond[0],$arraySecond[1]);
                    }
                }//Fin del if
                else{echo "0";}
            }//Fin del if
            else{echo "0";}
            break;
        case 4:
            $txtID = $_POST['txtID'];
            $data = new ServiceData();
            echo $data->deleteService($txtID);
            break;
        case 5:
            $id = $_POST['txtID'];
            $idInstructor = $_POST['selInstructor'];
            $serviceName = $_POST['txtName'];
            $description = $_POST['txtDescription'];
            $quota = $_POST['txtQuota'];
            
            if((strlen($idInstructor) > 0) &&
                (strlen($serviceName) > 0) &&
                (strlen($description) > 0) &&
                (strlen($quota) > 0))
            {
                $data = new ServiceData();
                $service = new Service($id, $idInstructor, $serviceName, 
                        $description, $quota, 0, 0);
                echo $data->updateService($service);
            }//Fin del if
            else
            {
                echo "0";
            }
            break;
        case 6:
            $idService = $_POST['txtID'];
            $txtStartDate = $_POST['txtStartDate'];
            $periodicity = $_POST['selPeriodicity'];
            
            //Calculos para la fecha final
            $dateInsert =  strtotime("$txtStartDate");
            $calDateEnd = strtotime("$periodicity month","$dateInsert");
            $dateEnd = date("Y-m-d",$calDateEnd);
            
            $service = new Service($idService, 0, 0, 0, 0, $txtStartDate, $dateEnd);
            $data = new ServiceData();
            echo $data->renewService($service);
            break;
        case 7:
            $idService = $_POST['txtID'];
            $txtStartDate = $_POST['txtStartDate'];
            $txtEndDate = $_POST['txtEndDate'];
            
            
            $service = new Service($idService, 0, 0, 0, 0, $txtStartDate, $txtEndDate);
            $data = new ServiceData();
            echo $data->renewService($service);
            break;
        case 9:
            $id = $_POST['id'];
            $data = new ServiceData();
            $current = $data->getServiceByID($id);
            $temp = "";
            $temp = $temp.$current->getIdService().",";
            $temp = $temp.$current->getIdInstructorService().",";
            $temp = $temp.$current->getNameService().",";
            $temp = $temp.$current->getDescriptionService().",";
            $temp = $temp.$current->getQuotaService().",";
            $temp = $temp.$current->getStartDateService().",";
            $temp = $temp.$current->getEndDateService();
            echo $temp;
            break;
    }//Fin del switch
}//Fin del if
?>