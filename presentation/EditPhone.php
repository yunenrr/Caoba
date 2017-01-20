<?php
include './header.php';
include ('../business/PhoneBusiness.php' );

// number of results to show per page
$perPage = 10;

$phoneBusiness = new PhoneBusiness();
$idPerson = (int) $_GET['id'];
$name = str_replace("_", " ", $_GET['name']);
$PhonesArray = $phoneBusiness->getAllPhonesPerson($idPerson);


$totalResults = sizeof($PhonesArray);
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

<H1 ALIGN=JUSTIFY> Phones $name</H1>
 
HERE;
//
//// display data in table
//
echo "<table border='1' cellpadding='10'>";
echo "<tr> <th>Phone </th> </tr>";

//// loop through results of database query, displaying them in the table

for ($i = $start; $i < $end; $i++) {

// make sure that PHP doesn't try to show results that don't exist

    if ($i == $totalResults) {
        break;
    }
//
//// echo out the contents of each row into a table
    echo "<tr>";

    echo '<td> '
    . '<input readonly="readonly" id="phone' . $PhonesArray[$i]->getIdPhone() . '" type="text"  value="' . $PhonesArray[$i]->getNumberPhone() . '" />'
    . '</td>';

    echo '<td>'
    . '<input id="edit' . $PhonesArray[$i]->getIdPhone() . '" type="button" onclick="editButton(' . $PhonesArray[$i]->getIdPhone() . ', 1);" value="Edit" >'
    . '<input id="update' . $PhonesArray[$i]->getIdPhone() . '"  style="display:none;" type="button" onclick="updateButton(' . $PhonesArray[$i]->getIdPhone() . ', ' . $idPerson . ');" value="Update" >'
    . '</td>';

    echo '<td><input id="delete' . $PhonesArray[$i]->getIdPhone() . '" type="button" onclick="deleteButton(' . $PhonesArray[$i]->getIdPhone() . ', ' . $idPerson . ');" value="Delete" ></td>';
    echo "</tr>";
}
echo "</table>";
?>

<!--ADD MORE PHONES-->

<br>
<br>
<di>
    <form name="formInsert" action="../business/InsertPhoneAction.php" method="post" >

        <table border="1" id="tbPhone">
            <tr id="tr0">
                <td>
                    <?php
                    echo '<input id="idPerson" name="idPerson" type="text" value="' . $idPerson . '" >';
                    echo '<input id="namePerson" name="namePerson" type="text" value="' . $name . '" >';
                    ?>

                    <input id="newPhones" name="newPhones" type="number">

                    <input id="newPhone0" name="newPhone0" type="number">
                </td>
                <td>
                    <input id="deletePhone0" type="button" onclick="deletePhone(-1);" value="Delete">
                </td>
            </tr>
        </table>
        <input id="AddPhone" type="button" onclick="addPhone();" value="Add Phone">

        <br>
        <br>
        <div>
            <input type="submit" name="submit" value="Insert Phones">
        </div>

    </form>

</di>

<p><a href="../presentation/ViewClient.php">Back</a></p>
<?php include './footer.php' ?>

<script type="text/javascript">

    var idPhone = 1;
    $('#newPhones').hide();
    $('#idPerson').hide();
    $('#namePerson').hide();

    function editButton(id) {
        $("#phone" + id).removeAttr("readonly");
        $("#edit" + id).hide();
        $("#update" + id).show();
    }

    function updateButton(id, idPerson) {
        if ($("#phone" + id).val() != "") {
            var data = {
                "id": id,
                "idPerson": idPerson,
                "phone": $("#phone" + id).val()
            };

            $.ajax({
                type: "POST",
                url: "../business/UpdatePhoneAction.php",
                data: data,
                success: function (res) {
                    if (res === true) {

                        $("#phone" + id).attr("readonly", "readonly");
                        $("#update" + id).hide();
                        $("#edit" + id).show();
                    } else {
                        alert("Error update");
                    }
                }
            });
        } else {
            alert("Error Update");
        }
    }

    function deleteButton(id, idPerson) {
        var data = {
            "id": id
        };
        $.ajax({
            type: "POST",
            url: "../business/DeletePhoneAction.php",
            data: data,
            success: function (res) {
                if (res == true) {
                    window.location = "./EditPhone.php?id=" + idPerson + "&name= " + $('#namePerson').val();
                } else {
                    alert("Error delete");
                }
            }
        });
    }

    function addPhone() {
        $('#tbPhone tr:last').after('<tr id="tr' + idPhone + '"><td><input id="newPhone' + idPhone + '" name="newPhone' + idPhone + '" type="number"></td> ' + '<td><input id="deletePhone' + idPhone + '" type="button" onclick="deletePhone(' + idPhone + ');" value="Delete">' + '</td></tr>');
        idPhone++;
        $('#newPhones').val(idPhone);
    }

    function deletePhone(id) {
        $("#tr" + id).remove();
    }
    
   

</script>