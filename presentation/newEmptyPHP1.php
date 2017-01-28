<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../business/InventoryBusiness.php';
include '../business/PersonBusiness.php';
include '../business/UserBusiness.php';
include '../business/DietBusiness.php';

$personBusiness = new PersonBusiness();
//$phoneBusiness = new PhoneBusiness();
$userBusiness = new UserBusiness();


$idPersonDietPerson = 3;
$dietBusiness = new DietBusiness();
$temp = $dietBusiness->getDiet($idPersonDietPerson);
if (strlen($temp) > 0) {
    $temp = substr($temp, 0, strlen($temp) - 1);
}
echo $temp;


//echo $userBusiness->verifyUserNameUser("ka");
//$person = new Person(1, 1, 'ka', 'ka', 'ka', 23, 1, 'va', 'vane', '2244', 'a+');
//$personBusiness->insertPerson($person);
//$id= $userBusiness->getMaxId();
//$user = new User(1, '1', 0, 'sfs', '424');
//        $userBusiness->insertUser($user);


//$inventoryBusiness = new InventoryBusiness();
//$array = $inventoryBusiness->getAllInventory();
////$temp = "";
//foreach ($array as $current) {
//    echo $current->getNameActiveInventory();
//                $temp = $temp . $current->getIdInventory() . "," . $current->getCodeActiveInventory() . "," . $current->getNameActiveInventory() . "," . $current->getQuantityInventory() . ",".$current->getPriceInventory().",".$current->getRegistrationDateInventory().";";
//}//Fin del foreach 
//            if (strlen($temp) > 0) {
//                $temp = substr($temp, 0, strlen($temp) - 1);
//            }
//            echo $temp;
//$inventory = new Inventory('4', 'uyyyyyyyyyyy', '67', '87878', '2017-01-04', 'yuyduy', '68767');
////echo $inventoryBusiness->insertInventory($inventory);
//echo $inventoryBusiness->deleteInventory(4); 

//$inventory = new Inventory(1, 'karen', 90, 90, '2017-01-04', '97', 'ui');
//            echo $inventoryBusiness->updateInventory($inventory);