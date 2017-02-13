<?php

include './ConditionBusiness.php';
$coditionBusiness = new ConditionBusiness();
$result = $coditionBusiness->insertCondition($_POST['name'], $_POST['risk']);
echo true;
?>
