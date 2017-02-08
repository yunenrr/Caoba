<?php

include './ConditionBusiness.php';

$coditionBusiness = new ConditionBusiness();
//$result = $coditionBusiness->insertCondition("ddf", 5);
$result = $coditionBusiness->insertCondition($_POST['name'], $_POST['risk']);

echo true;
//exit;
//echo json_encode($result);
?>
