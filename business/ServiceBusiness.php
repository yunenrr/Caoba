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
     */
    switch($option)
    {
        case 1:
            $data = new ServiceData();
            $array = $data->getAllService();
            $temp = "";
            foreach ($array as $current)
            {
                $temp = $temp.$current->id.",";
                $temp = $temp.$current->idInstructor.",";
                $temp = $temp.$current->serviceName.",";
                $temp = $temp.$current->description.",";
                $temp = $temp.$current->price.",";
                $temp = $temp.$current->quota.";";
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
                $temp = $temp.$current->id.",";
                $temp = $temp.$current->personName." ".$current->firstName." ".$current->secondName.";";
            }//Fin del foreach
            if(strlen($temp) > 0){$temp = substr($temp,0, strlen($temp)-1);}
            echo $temp;
            break;
        case 3:
            $idInstructor = $_POST['selInstructor'];
            $serviceName = $_POST['txtName'];
            $description = $_POST['txtDescription'];
            $price = $_POST['txtPrice'];
            $quota = $_POST['txtQuota'];
            
            //Verificamos que no estén vacíos
            if((strlen($idInstructor) > 0) &&
                (strlen($serviceName) > 0) &&
                (strlen($description) > 0) &&
                (strlen($price) > 0) &&
                (strlen($quota) > 0))
            {
                $data = new ServiceData();
                $service = new Service(0, $idInstructor, $serviceName, 
                        $description, $price, $quota);
                echo $data->insertService($service);
            }//Fin del if
            else
            {
                echo "0";
            }
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
            $price = $_POST['txtPrice'];
            $quota = $_POST['txtQuota'];
            
            //Verificamos que no estén vacíos
            if((strlen($idInstructor) > 0) &&
                (strlen($serviceName) > 0) &&
                (strlen($description) > 0) &&
                (strlen($price) > 0) &&
                (strlen($quota) > 0))
            {
                $data = new ServiceData();
                $service = new Service($id, $idInstructor, $serviceName, 
                        $description, $price, $quota);
                echo $data->updateService($service);
            }//Fin del if
            else
            {
                echo "0";
            }
            break;
    }//Fin del switch
}//Fin del if
?>