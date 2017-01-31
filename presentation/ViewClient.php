<?php

include './header.php';
include ('../business/PersonBusiness.php' );
include '../business/PersonStateBusiness.php';
// number of results to show per page
$perPage = 10;
$personBusiness = new PersonBusiness();
$gender = $personBusiness->GetAllGender();

$PersonsArray = $personBusiness->getAllPersons();
$totalResults = sizeof($PersonsArray);
$totalPages = ceil($totalResults / $perPage);

//// check if the 'page' variable is set in the URL (ex: view-paginated.php?page=1)

if (isset($_GET['page']) && is_numeric($_GET['page'])) {

    $showPage = $_GET['page'];
// make sure the $show_page value is valid
    if ($showPage > 0 && $showPage <= $totalPages) {

        $start = ($showPage - 1) * $perPage;
        $end = $start + $perPage;
    } else {

// error - show first set of results
        $start = 0;
        $end = $perPage;
    }
} else {

// if page isn't set, show first set of results
    $start = 0;
    $end = $perPage;
}
//
//
PRINT <<<HERE

<H1 ALIGN=JUSTIFY> Customer Registration </H1>
 
HERE;
//
//// display data in table
//
echo "<table border='2'>";
echo "<tr> <th>Identify</th> <th>Person Name</th> <th>First Name</th> "
 . "<th>Second Name</th> <th>Age</th> <th>Gende</th> <th>Email</th><th>Address</th>"
 . "<th>Blood Type</th><th>Phone Reference</th><th>Status</th><th>Phones</th><th>Routine</th><th>Diet</th><th>Family</th><th>Sesion</th></tr>";

//// loop through results of database query, displaying them in the table

for ($i = $start; $i < $end; $i++) {

// make sure that PHP doesn't try to show results that don't exist

    if ($i == $totalResults) {
        break;
    }
//
//// echo out the contents of each row into a table
    echo "<tr>";
    $tempGender = "";
    foreach ($gender as $value) {
        if ($PersonsArray[$i]->getGenderPerson() == $value->getIdGender()) {
            $tempGender = $value->getNameGender();
        }
    }
    echo '<td>' . $PersonsArray[$i]->getDniPerson() . '</td>';
    echo '<td>' . $PersonsArray[$i]->getNamePerson() . '</td>';
    echo '<td>' . $PersonsArray[$i]->getFirstNamePerson() . '</td>';
    echo '<td>' . $PersonsArray[$i]->getSecondNamePerson() . '</td>';
    echo '<td>' . $PersonsArray[$i]->getAgePerson() . '</td>';
    echo '<td>' . $tempGender . '</td>';
    echo '<td>' . $PersonsArray[$i]->getEmailPerson() . '</td>';
    echo '<td>' . $PersonsArray[$i]->getAddressPerson() . '</td>';
    echo '<td>' . $PersonsArray[$i]->getBloodTypePerson() . '</td>';
    echo '<td>' . $PersonsArray[$i]->getPhoneReferencePerson() . '</td>';
    $personStateBusiness = new personStateBusiness();
    if ($personStateBusiness->getPersonStateBusiness($PersonsArray[$i]->getDniPerson()) == 1) {
        echo '<td>' . 'Activo' . '</td>';
    } else {
        echo '<td>' . 'Inactivo' . '</td>';
    };
    $name = str_replace(" ", "_", $PersonsArray[$i]->getNamePerson());
    echo '<td><a href="../presentation/EditPhone.php?id=' . $PersonsArray[$i]->getIdPerson() . '&name=' . $name . '">Phones</a></td>';
    echo '<td><a href="../presentation/Routine.php?id=' . $PersonsArray[$i]->getIdPerson() . '&name=' . $name . '">Routine</a></td>';
    echo '<td><a href="../presentation/diet.php?id=' . $PersonsArray[$i]->getIdPerson() . '&name=' . $name . '">Diet</a></td>';
    echo '<td><a href="../presentation/familyRelationship.php?id=' . $PersonsArray[$i]->getIdPerson() . '&name=' . $name . '">Familiy</a></td>';
    echo '<td><a href="../presentation/ChooseService.php?id=' . $PersonsArray[$i]->getIdPerson() . '">Service</a></td>';

    echo '<td><a href="../presentation/EditClient.php?id=' . $PersonsArray[$i]->getIdPerson() . '">Edit</a></td>';
    echo '<td><a href="../business/DeletePersonAction.php?id=' . $PersonsArray[$i]->getIdPerson() . '">Delete</a></td>';


    echo "</tr>";
}
echo "</table>";

//// display pagination
echo "<p> <b>View Page:</b> ";
for ($i = 1; $i <= $totalPages; $i++) {
    echo "<a href='../presentation/ViewClient.php?page=$i'>$i</a> ";
}
?>
<p><a href="../presentation/CreateNewClient.php">Add a new client</a></p>
<?php include './footer.php' ?>
