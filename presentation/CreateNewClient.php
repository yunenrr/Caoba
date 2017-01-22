
<?php
include './header.php';
include '../business/PersonBusiness.php'
?>

<div>
    <H1 ALIGN=JUSTIFY> Register new customer </H1>

    <!--FORM-->
    <form name="formInsert" action="../business/CreateNewClientAction.php" method="post" onsubmit="return validationInsertForm(this);">
        <!--INFO-->
        <table>
            <!--DNI-->
            <tr>
                <td>Identify:</td>
                <td><input type="number" id="dni" name="dni" onKeyUp="comprobar(this.value)" required/>
                    <div id="msgUsuario" style="color: red"></div></td>
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
                <td><input type="number" id="age" name="age" min="0" required/></td>
            </tr>

            <!--GENDER-->
            <tr>
                <td>Gender:</td>
                <td>
                    <input type="radio" id="gender" name="gender"
                    <?php if (isset($gender) && $gender == 0) echo "checked"; ?>
                           value=0 checked>Female
                    <input type="radio" id="gender" name="gender"
                    <?php if (isset($gender) && $gender == 1) echo "checked"; ?>
                           value=1>Male
                    <input type="radio" id="gender" name="gender"
                    <?php if (isset($gender) && $gender == 2) echo "checked"; ?>
                           value=2>Undefined
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
                <td><input type="number" id="addPhoneReference" name= "addPhoneReference" type="button" value=""></td>
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
                success: function (respuesta) {
                    if (respuesta == true) {
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
                success: function (respuesta) {
                    if (respuesta == true) {
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
        dni = document.formInsert.dni.value;
        name = document.formInsert.name.value;
        firstname = document.formInsert.firstname.value;
        secondname = document.formInsert.secondname.value;
        age = document.formInsert.age.value;
        gender = document.formInsert.gender.value;
        email = document.formInsert.email.value;
        address = document.formInsert.address.value;

        if (dni.length == 0 || name.length == 0 || firstname.length == 0 || secondname.length == 0 || age.length == 0 ||
                gender.length == 0 || email.length == 0 || address.length == 0) {
            document.getElementById('errorMsj').innerHTML = "ERROR: Please fill all fields!";
            document.getElementById('errorMsj').style.display = 'block';
            return false;
        } else {
            if (availability == '1') {
                document.getElementById('errorMsj').innerHTML = "ERROR: The DNI is existe";

                return false;
            } else {
                return true;
            }
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
