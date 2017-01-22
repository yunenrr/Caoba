<?php

include './FoodBusiness.php';
include './DietBusiness.php';
include './DietPlanBusiness.php';
include './DietPersonBussiness.php';

if (isset($_POST['option'])) {
    $option = $_POST['option'];

    switch ($option) {

        case 1://insert a diet

            // get value
            $nameDiet = $_POST['txtName'];
            $descriptionDiet = $_POST['txtDescription'];
            $dietDayDietPlan = $_POST['txtDay'];
            $dietHourDietPlan = $_POST['txtHour'];
            $temp = (INT) $_POST['quantityFood'];
            $idFoodDietPlan = $_POST['selFood'];
            $idPersonDietPerson =$_POST['idPerson'];

            $dietBusiness = new DietBusiness();
            $dietPlanBusiness = new DietPlanBusiness();
            $dietPersonBusiness = new DietPersonBusiness();

            // obtengo las id de las tablas
            $idDiet = $dietBusiness->getMaxId();
            $idDietPerson = $dietPersonBusiness->getMaxId();
            $idDietPlan = $dietPlanBusiness->getMaxId();

            $diet = new Diet($idDiet, $nameDiet, $descriptionDiet);
            $dietPlan = new DietPlan($idDietPlan, $idFoodDietPlan, $idDiet, $dietDayDietPlan, $dietHourDietPlan);
            $dietPerson = new DietPerson($idDietPerson,$idPersonDietPerson,$idDiet );

            if ($dietBusiness->insertDiet($diet)) {
                $dietPlanBusiness->insertDietPlan($dietPlan);// insert food a dietplan
                $dietPersonBusiness->insertDietPerson($dietPerson);//assign a diet to person
                

                for ($i = 1; $i < $temp + 1; $i++) { //  insert food a dietplan
                    $idFoodDietPlan = (INT) $_POST[$i];
                    $idDietPlan = $dietPlanBusiness->getMaxId();
                    $dietPlan = new DietPlan($idDietPlan, $idFoodDietPlan, $idDiet, $dietDayDietPlan, $dietHourDietPlan);
                    $dietPlanBusiness->insertDietPlan($dietPlan);
                }
            }
            break;

        case 2: // get all the food
            $foodBusiness = new FoodBusiness();
            $array = $foodBusiness->getAllFood();
            $temp = "";
            foreach ($array as $current) {
                $temp = $temp . $current->getIdFood() . ",";
                $temp = $temp . $current->getNameFood() . " " . $current->getNutritionalValueFood() . ";";
            }//Fin del foreach
            if (strlen($temp) > 0) {
                $temp = substr($temp, 0, strlen($temp) - 1);
            }
            echo $temp;
            break;

        case 3;// get the person diet and show
            $idPersonDietPerson =$_POST['idPerson'];
            $dietBusiness = new DietBusiness();
            $temp=$dietBusiness->getDiet($idPersonDietPerson);
            if(strlen($temp) > 0){$temp = substr($temp,0, strlen($temp)-1);}
            echo $temp;
            
            break;
        case 4;// delete a diet
            $idDiet =(int)$_POST['txtID'];
            $dietBusiness = new DietBusiness();
            echo $dietBusiness->deleteDiet($idDiet);
            break;
    }
}