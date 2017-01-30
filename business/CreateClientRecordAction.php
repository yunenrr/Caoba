<?php

include './ServiceBusiness1.php';

if (isset($_POST['submit'])) {
    $idPersonUserClientRecord = (int) $_POST['idClient'];
    $idService = (int) $_POST['comboService'];
    $idRelation = (int) $_POST['comboHourStart'];
    $idModule = (int) $_POST['comboPaymentModule'];
    $startDateClientRecord = $_POST['startDay'];
    
    if(isset($idPersonUserClientRecord) && isset($idRelation) && isset($idModule) && isset($startDateClientRecord)){
        $serviceBusiness1 = new ServiceBusiness1();
        $idClientRecord = $serviceBusiness1->getMaxId();
        $idRelationServiceScheduleClientRecord = $serviceBusiness1->getIdRelationtServices($idService, $idRelation);
        $idServicePaymentModuleClientRecord = $serviceBusiness1->getIdTbServicePaymentModule($idService, $idModule);
        
        if($serviceBusiness1->insertServiceToClient($idClientRecord, 
                $idPersonUserClientRecord, 
                $idServicePaymentModuleClientRecord, 
                $idRelationServiceScheduleClientRecord, 
                $startDateClientRecord)){
            
            header("location: ../presentation/ChooseService.php?id=".$idPersonUserClientRecord."&success=inserted");
            
        }else{
            header("location: ../presentation/ChooseService.php?id=".$idPersonUserClientRecord."&error=inserted");
        }
        
    }
    
}else{
     header("location: ../presentation/ViewClient.php?error=insert_Payment_Module");
}



