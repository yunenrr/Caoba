<?php

include './ConditionBusiness.php';
$coditionBusiness = new ConditionBusiness();
$result = $coditionBusiness->deleteCondition($_POST['id']);
echo $result;

?>
