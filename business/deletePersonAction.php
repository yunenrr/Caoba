<?php

/**
 * Use to delete the person In the registry
 * 
 * @author Karen
 */
include ('../business//PersonBusiness.php' );
$personBusiness = new PersonBusiness();

// check if the 'id' variable is set in URL, and check that it is valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {

// get id value
    $id = $_GET['id'];

// delete the entry
    if ($personBusiness->deletePerson($id)) {
        header("location: ../presentation/ViewClient.php?success=DELETE");
    } else {
        header("location: ../presentation/ViewClient.php?error=DELETE");
    }
} else {
// if id isn't set, or isn't valid, redirect back to view page
    header("location: ../presentation/ViewClient.php?error=DELETE");
}
?>
