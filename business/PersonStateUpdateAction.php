<?php

include './PersonStateBusiness.php';
$state = $_POST['state'];
$id = $_POST['id'];
$personState = new PersonState(0, $id, $state);
$personStateBusiness = new personStateBusiness();
$personStateBusiness->updatePersonState($personState);
echo true;
