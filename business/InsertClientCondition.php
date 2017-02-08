<?php

include './ConditionBusiness.php';

$coditionBusiness = new ConditionBusiness();
//$result = $coditionBusiness->insertCondition("ddf", 5);
$result = $coditionBusiness->insertClientCondition($_POST['idclient'], $_POST['idcondition']);

echo true;
//exit;
//echo json_encode($result);
?>
