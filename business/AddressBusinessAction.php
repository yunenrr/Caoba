<?php

include '../business/AddressBusiness.php';

if (isset($_POST['option'])) {
    $option = $_POST['option'];
    $addressBussiness = new AddressBussiness();

    switch ($option) {
        case 1: // obtinene todos los barrios

            $array = $addressBussiness->getAllAddress();
            $temp = "";
            foreach ($array as $current) {
                $temp = $temp . $current->getIdAddress() . "," . $current->getNeighborhoodAddresss() . ";";
            }//Fin del foreach
            if (strlen($temp) > 0) {
                $temp = substr($temp, 0, strlen($temp) - 1);
            }
            echo $temp;
            break;

        case 2: // inserta un nuevo barrio

            $neighborhood = $_POST['txtNeighborhood'];

            $id = $addressBussiness->getMaxId();
            $address = new Address($id, $neighborhood);
            echo $addressBussiness->insertAddress($address);
            break;

        case 3: // se utiliza para actualizar 
            
            $neighborhood = $_POST['txtNeighborhood'];
            $id = $_POST['txtID'];

            $address = new Address($id, $neighborhood);
            echo $addressBussiness->updateAddress($address);
            break;

        case 4: // se utiliza para eliminar
            $id = $_POST['txtID'];
            echo $addressBussiness->deleteAddress($id);
            break;
    }
}
