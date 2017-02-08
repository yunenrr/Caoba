<?php

include './ConditionBusiness.php';

$coditionBusiness = new ConditionBusiness();
$result = $coditionBusiness->deleteClientCondition($_POST['id'],$_POST['condition']);
echo true;
//exit;
//echo json_encode($result);
?>
