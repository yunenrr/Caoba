<?php
/**
 * Verify the dni people 
 * @author Karen
 * 
 */
include '../business/PersonBusiness.php';

$personB = new PersonBusiness();

$dni = $_POST['dni'];
$result = $personB->verifyDniPerson($dni);

if ($result > 0)
    echo true;
else
    echo false;
?>

