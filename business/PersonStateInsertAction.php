<?php
include './PersonStateBusiness.php';
$state = $_POST['state'];
$id = $_POST['id'];
//$state = $_GET['state'];
//$id = $_GET['id'];
$personState = new PersonState(0, $id, $state);
$personStateBusiness = new personStateBusiness();
$personStateBusiness->insertPersonState($personState);
echo true;
