<?php

include './PhoneBusiness.php';

$id = $_POST['id'];

if (isset($id)) {

    $phoneBusiness = new PhoneBusiness();
    if ($phoneBusiness->deletePhone($id)) {
        echo true;
    } else {
        echo false;
    }
} else {
    echo false;
}
?>