<?php
include '../data/ServiceData.php';
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
     * 6 - Obtener todos los metodos de pago
     * 7 - Obtener todos los días.
     * 8 - Obtener los horarios por día.
     * 9 - Obtener la información de un servicio específico.
     * 10 - Obtener los métodos de pagos actuales
     * 11 - Obtener los horarios actuales.
     * 12 - Eliminar métodos de pago de un servicio.
     * 13 - Insertar métodos de pago a un servicio específico.
     * 14 - Eliminar horarios de un servicio.
     * 15 - Insertar horario a un servicio en específico.
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
                $temp = $temp.$current->getIdInstructorService().",";
                $temp = $temp.$current->getNameService().",";
                $temp = $temp.$current->getDescriptionService().",";
                $temp = $temp.$current->getQuotaService().";";
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
            $startDateService = $_POST['startDate'];
            $endDateService = $_POST['endDate'];
            $paymentMethod = $_POST['paymentMethod'];
            $selectedSchedule = $_POST['selectedSchedule'];
            $condition = 0;
            
            //Verificamos que no estén vacíos
            if((strlen($idInstructor) > 0) &&
                (strlen($serviceName) > 0) &&
                (strlen($description) > 0) &&
                (strlen($quota) > 0) &&
                (strlen($startDateService) > 0) &&
                (strlen($endDateService) > 0))
            {
                $data = new ServiceData();
                $service = new Service(0, $idInstructor, $serviceName, 
                        $description, $quota,$startDateService,$endDateService);
                $condition = $data->insertService($service);
                
                //Insertamos las modalidades de pago
                if($condition !== "0")
                {
                    $array = explode(";", $paymentMethod);
                    foreach ($array as $current)
                    {
                        $arraySecond = explode(",", $current);
                        $cond = $data->insertServicePaymentMethod($condition,$arraySecond[0],$arraySecond[1]);
                    }
                    
                    //Insertamos los horarios
                    if($cond !== "0")
                    {
                        $array = explode(",", $selectedSchedule);
                    
                        foreach ($array as $current)
                        {
                            $cond = $data->insertSchedule($condition, $current);
                        }
                    }//Fin del if
                    else{echo $cond ;}
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
            $startDateService = $_POST['startDate'];
            $endDateService = $_POST['endDate'];
            
            if((strlen($idInstructor) > 0) &&
                (strlen($serviceName) > 0) &&
                (strlen($description) > 0) &&
                (strlen($quota) > 0) &&
                (strlen($startDateService) > 0) &&
                (strlen($endDateService) > 0))
            {
                $data = new ServiceData();
                $service = new Service($id, $idInstructor, $serviceName, 
                        $description, $quota, $startDateService, $endDateService);
                echo $data->updateService($service);
            }//Fin del if
            else
            {
                echo "0";
            }
            break;
        case 6:
            $data = new ServiceData();
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
        case 7:
            $data = new ServiceData();
            $array = $data->getAllDay();
            $temp = "";
            foreach ($array as $current)
            {   
                $temp = $temp.$current->getIdDay().",";
                $temp = $temp.$current->getNameDay().";";
            }//Fin del foreach
            if(strlen($temp) > 0){$temp = substr($temp,0, strlen($temp)-1);}
            echo $temp;
            break;
        case 8:
            $idDay = $_POST['day'];
            $data = new ServiceData();
            $array = $data->getScheduleByDay($idDay);
            $temp = "";
            foreach ($array as $current)
            {   
                $temp = $temp.$current->getIdDayHourService().",";
                $temp = $temp.$current->getHourStartService().",";
                $temp = $temp.$current->getHourEndService().";";
            }//Fin del foreach
            if(strlen($temp) > 0){$temp = substr($temp,0, strlen($temp)-1);}
            echo $temp;
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
        case 10:
            $id = $_POST['id'];
            $data = new ServiceData();
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
        case 11:
            $id = $_POST['id'];
            $data = new ServiceData();
            $array = $data->getCurrentSchedule($id);
            $temp = "";
            foreach ($array as $current)
            {   
                $temp = $temp.$current->getIdDayHourService().",";
                $temp = $temp.$current->getDayService().",";
                $temp = $temp.$current->getHourStartService().",";
                $temp = $temp.$current->getHourEndService().";";
            }//Fin del foreach
            if(strlen($temp) > 0){$temp = substr($temp,0, strlen($temp)-1);}
            echo $temp;
            break;
        case 12:
            $idService = $_POST['id'];
            $idPaymentMethod = $_POST['paymentMethod'];
            $data = new ServiceData();
            echo $data->deleteServicePaymentMethod($idService, $idPaymentMethod);
            break;
        case 13:
            $idService = $_POST['id'];
            $idPaymentMethod = $_POST['paymentMethod'];
            $array = explode(",", $idPaymentMethod);
            $data = new ServiceData();
            echo $data->insertServicePaymentMethod($idService,$array[0],$array[1]);
            break;
        case 14:
            $idService = $_POST['id'];
            $idSchedule = $_POST['idSchedule'];
            $data = new ServiceData();
            echo $data->deleteSchedule($idService, $idSchedule);
            break;
        case 15:
            $idService = $_POST['id'];
            $idSchedule = $_POST['idSchedule'];
            $data = new ServiceData();
            echo $data->insertSchedule($idService, $idSchedule);
            break;
    }//Fin del switch
}//Fin del if
?>