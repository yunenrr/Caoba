<?php

include './PersonStateBusiness.php';
$id = $_POST['id'];
//$personState = new PersonState(0, 123, 0);
$personStateBusiness = new personStateBusiness();
$return = $personStateBusiness->updatePersonState($id );
$array = array("status" => $return);
echo (json_encode($array));
//echo true;
