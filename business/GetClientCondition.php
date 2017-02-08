<?php

include './ConditionBusiness.php';

$coditionBusiness = new ConditionBusiness();
$result = $coditionBusiness->getClientCondition($_POST['id']);
//$result = $coditionBusiness->getClientCondition(1);
echo json_encode($result);
?>
