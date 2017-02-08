<?php

include './ConditionBusiness.php';

$coditionBusiness = new ConditionBusiness();
$result = $coditionBusiness->getAllCondition();
echo json_encode($result);
?>
