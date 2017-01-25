<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../business/PersonBusiness.php';
include '../business/PhoneBusiness.php';
include '../business/UserBusiness.php';

$personBusiness = new PersonBusiness();
$phoneBusiness = new PhoneBusiness();
$userBusiness = new UserBusiness();
//
//$person = new Person(1, 1, 'ka', 'ka', 'ka', 23, 1, 'va', 'vane', '2244', 'a+');
//$personBusiness->insertPerson($person);
$id= $userBusiness->getMaxId();
$user = new User(1, '1', 0, 'sfs', '424');
        $userBusiness->insertUser($user);
