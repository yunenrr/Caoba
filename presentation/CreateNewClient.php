
<?php
include './header.php';
include '../business/PersonBusiness.php';

$personBusiness = new PersonBusiness();
$gender = $personBusiness->GetAllGender();
?>

<div>
    <H2 ALIGN=JUSTIFY> Register new customer </H2>

    <fieldset>
        <!--FORM-->
        <form name="formInsert" action="../business/CreateNewClientAction.php" method="POST" onsubmit="return validationInsertForm(this);">
            <!--INFO-->
            <table>

                <!--DNI-->
                <tr>
                    <td>Identify:</td>
                    <td><input type="number" id="dni" name="dni" required onkeypress="return valideKey(event);"/>
                        <div id="msgUsuario" style="color: red"></div></td>
                </tr>

                <!--Type user-->
                <tr>
                    <td> Type user:</td>
                    <td><select id="userType" name="userType"><option value="0">Client</option><option value="1">Instructor</option>
                            <option value="2">Instructor & Admin</option><option value="3">Admin</option></select></td>
                </tr>

                <!--NAME-->
                <tr>
                    <td>Person name:</td>
                    <td><input type="text" id="name" name="name" required/><br/></td>
                </tr>

                <!--FIRST NAME-->
                <tr>
                    <td>First name:</td>
                    <td><input type="text" id="firstname" name="firstname" required/><br/></td>
                </tr>

                <!--SECOND NAME-->
                <tr>
                    <td>Second name:</td>
                    <td><input type="text" id="secondname" name="secondname" required/><br/></td>
                </tr>

                <!--USER NAME-->
                <tr>
                    <td>User name:</td>
                    <td><input type="text" id="userName" name="userName" required/><br/>
                        <div id="msgUserName" style="color: red"></div></td>
                </tr>
                <!--PASSWORD-->
                <tr>
                    <td>Password:</td>
                    <td><input type="password" id="password" name="password" required/><br/></td>
                </tr>

                <!--AGE-->
                <tr>
                    <td>Age:</td>
                    <td><input type="number" id="age" name="age" min="0" required onkeypress="return valideKey(event);"/></td>
                </tr>

                <!--GENDER-->
                <tr>
                    <td>Gender:</td>
                    <td>
                        <select id="selGender" name="selGender" > 
                            <?php foreach ($gender as $value) { ?>
                                <option value="<?php echo $value->getIdGender(); ?>"><?php echo $value->getNameGender(); ?></option> 
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <!--Blood-->
                <tr>
                    <td>Blood Type:</td>
                    <td><select id="selBlood" name="selBlood"><option value="0-">0-</option><option value="0+">0+</option>
                            <option value="A-">A-</option><option value="A+">A+</option> <option value="B-">B-</option>
                            <option value="B+">B+</option><option value="AB-">AB-</option><option value="AB+">AB+</option> </select></td>
                </tr>

                <!--EMAIL-->
                <tr>
                    <td>Email:</td>
                    <td><input type="email" id="email" name="email" required/><br/></td>
                </tr>

                <!--Phone reference-->
                <tr>
                    <td>Phone reference:</td>
                    <td><input type="number" id="addPhoneReference" name= "addPhoneReference" type="button" onkeypress="return valideKey(event);"></td>
                </tr>

                <!--PHONE-->
                <tr>
                    <td>Phone:</td>
                    <td>
                        <table border="1" id="phone">
                            <tr id="tr0">
                                <td>
                                    <input id="phones" name="phones" type="number">
                                    <input id="phone0" name="phone0" type="number">
                                </td>
                                <td>
                                    <input id="deletePhone0" type="button" onclick="deletePhone(-1);" value="Delete">
                                </td>
                            </tr>
                        </table>
                        <input id="AddPhone" type="button" onclick="addPhone();" value="Add Phone">
                    </td>
                </tr>
                <!--ADDRESS-->
                <tr>
                    <td>Address:</td>
                    <td><textarea id="address" name="address" rows="5" cols="40" required ></textarea></td>
                </tr>
            </table>

            <!--REGISTRE-->
            <div>
                <input type="submit" name="submit" value="Register">
            </div>

        </form>
    </fieldset>

    <!--MESSAGE ERROR-->
    <div id="errorMsj" style="position:absolute; left:450px; top:350px; 
         width:300px; height:40px; display: none ; border:2px solid red; color:#ffffff; background-color: red; ">
        ERROR: Please fill all fields!<br>
    </div>
</div>

<?php include './footer.php' ?>

<!--SCRIPT-->
<script type="text/javascript">
    var availability = '0' //Availability of dni

    // Use to valite the dni
    $('#userName').focusout(function () {
        if ($('#userName').val() != "") {
            $.ajax({
                type: "POST",
                url: "../business/CheckAction.php",
                data: "userName=" + $('#userName').val(),
                beforeSend: function () {
                    $('#msgUserName').html('<img src="../resources/loader.gif"/> Checking');
                },
                success: function (result) {
                    if (result == true) {
                        $('#msgUserName').html("It already exists");
                        availability = '1';
                    } else {
                        $('#msgUserName').html("");
                        availability = '0';
                    }
                }
            });
        }
    });

    // Use to valite the username
    $('#dni').focusout(function () {
        if ($('#dni').val() != "") {
            $.ajax({
                type: "POST",
                url: "../business/CheckAction.php",
                data: "dni=" + $('#dni').val(),
                beforeSend: function () {
                    $('#msgUsuario').html('<img src="../resources/loader.gif"/> Checking');
                },
                success: function (result) {
                    if (result == true) {
                        $('#msgUsuario').html("It already exists");
                        availability = '1';
                    } else {
                        $('#msgUsuario').html("");
                        availability = '0';
                    }
                }
            });
        }
    });


    /**
     * Use to validate that the fields are not empty
     * @returns {Boolean} */
    function validationInsertForm() {
        dniPerson = document.formInsert.dni.value;
        namePerson = document.formInsert.name.value;
        firstnamePerson = document.formInsert.firstname.value;
        secondnamePerson = document.formInsert.secondname.value;
        agePerson = document.formInsert.age.value;
        emailPerson = document.formInsert.email.value;
        addressPerson = document.formInsert.address.value;
        typeUser = document.formInsert.userType.value;
        passwordUser = document.formInsert.password.value;

        if (dniPerson.length === 0 || namePerson.length === 0 || firstnamePerson.length === 0 || secondnamePerson.length === 0
                || agePerson.length === 0 || emailPerson.length === 0 || addressPerson.length === 0 || typeUser.length === 0 || passwordUser.length === 0) {

            document.getElementById('errorMsj').innerHTML = "ERROR: Check the information!!";
            document.getElementById('errorMsj').style.display = 'block';
            return false;
        } else {
            if (availability == '1') {
                document.getElementById('errorMsj').innerHTML = "ERROR:The DNI EXISTS!!";
                return false;
            } else {
                return true;
            }
        }
    }

    function valideKey(evt)
    {
        var code = (evt.which) ? evt.which : evt.keyCode;
        if (code == 8)
        {
            //backspace
            return true;
        } else if (code >= 48 && code <= 57)
        {
            //is a number
            return true;
        } else
        {
            return false;
        }
    }

    var idPhone = 1;
    $('#phones').hide();
    function addPhone() {
        $('#phone tr:last').after('<tr id="tr' + idPhone + '"><td><input id="phone' + idPhone + '" name="phone' + idPhone + '" type="number"></td> ' +
                '<td><input id="deletePhone' + idPhone + '" type="button" onclick="deletePhone(' + idPhone + ');" value="Delete">' +
                '</td></tr>');
        idPhone++;
        $('#phones').val(idPhone);
    }

    function deletePhone(id) {
        $("#tr" + id).remove();
    }

    function action() {
        location.href = "../business/CreateNewClientAction.php?phones=" + idPhone + "";
    }

</script>  
