
<?php
include './header.php';
include '../business/PersonBusiness.php';
include '../business/UserBusiness.php';
include '../business/PersonStateBusiness.php';
$id = $_GET['id'];

$personBusiness = new PersonBusiness();
$userBusiness = new UserBusiness();
$person = $personBusiness->getPerson($id);
$user = $userBusiness->getUserByIdPerson($id);
$gender = $personBusiness->GetAllGender();

$personStateBusiness = new personStateBusiness();
$state;

if ($personStateBusiness->getPersonStateBusiness($person->getDniPerson()) == "1") {
    $state = "Active";
} else {
    $state = "Inactive";
}
?>

<H2 ALIGN=JUSTIFY> Edit customer </H2>

<fieldset>
    <LEGEND>Basic Information</LEGEND>
    <!--FORM-->
    <form  name="formEdit"action="../business/EditClientAction.php" method="post" onsubmit="return validationForm(this);">
        <table>

            <!--DNI-->
            <tr>
                <td>DNI:</td>
                <td>
                    <input id="dni" name="dni"  readonly="readonly" type="text"  value=<?php echo $person->getDniPerson() ?> /><br/>
                </td>
            </tr>

            <!--NAME-->
            <tr>
                <td>Person name:</td>
                <td>
                    <input type="text" id="name" name="name" 
                           pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}"  value=<?php echo $person->getNamePerson() ?> required  />*<br/>
                </td>
            </tr>

            <!--FISTNAME-->
            <tr>
                <td>First surname:</td>
                <td>
                    <input type="text" id="firstname" name="firstname" 
                           pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" value=<?php echo $person->getFirstNamePerson() ?> required />*<br/>
                </td>
            </tr>

            <!--SECONDNAME-->
            <tr>
                <td>Second surname:</td>
                <td>
                    <input type="text" id="secondname" name="secondname" 
                           pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" value=<?php echo $person->getSecondNamePerson() ?> required/>*<br/>
                </td>
            </tr>
            <!--USER NAME-->
            <tr>
                <td>User name:</td>
                <td><input type="text" id="userName" name="userName"  value=<?php echo $user->getUserNameUser()?> />*<br/>
                    <div id="msgUserName"></div></td>
            </tr>
            <!--PASSWORD-->
            <tr>
                <td>Password:</td>
                <td><input type="password" id="password" name="password"  value=<?php echo $user->getPassUser() ?> required/>*<br/></td>
            </tr>
            <!--AGE-->
            <tr>
                <td>Age:</td>
                <td><input type="number" id="age" name="age" min="0" value=<?php echo $person->getAgePerson() ?> required/>*</td>
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
                <td><input type="email" id="email" name="email" value=<?php echo $person->getEmailPerson() ?> required/>*<br/></td>
            </tr>

            <!--Phone reference-->
            <tr>
                <td>Phone reference:</td>
                <td><input type="text" id="addPhoneReference" name= "addPhoneReference" type="button" value=<?php echo $person->getPhoneReferencePerson() ?>  required onkeypress="return valideKey(event);">*</td>
            </tr>
            <!--ADDRESS-->
            <tr>
                <td>Status:</td>
                <td>
                    <label id="status" > <?=$state; ?> </label>
                    
                    <input type="button"  name="id" onclick="<?='update(' . $person->getDniPerson() . ')' ?>" value=Change /> 
                    
                </td>
            </tr>
            <!--ID-->
            <tr><td> <input type="hidden" dni ="id" name="id" value=<?php echo $id ?>/> <br/></tr>

            <!--REGISTRE-->
            <tr>
                <td>Required fields(*)</td>
                <td><br></td>
                <td><input type="submit" name="submit" value="Edit"></td>
            </tr>
        </table>

        <!--MESSAGE ERROR-->
        <div id="msgError"></div>
    </form>
</fieldset>

<?php include './footer.php' ?>

<script type="text/javascript">
    
    
    var availability = true; //Availability of dni/username
     var idPhone = 1;
     
    $(document).ready
    (
        function()
        {
            $('#addPhoneReference').mask('(000)0000-0000', {placeholder: '(000) 0000-0000'}); //placeholder
            getperson(); 
            
             // Use to valite the dni
    $('#userName').focusout(function () {
        if ($('#userName').val() !== "") {
            $.ajax({
                type: "POST",
                url: "../business/PersonBusinessAction.php",
                data: "option=3&userName=" + $('#userName').val(),
                beforeSend: function () {
                    $('#msgUserName').html('');
                },
                success: function (result) {
                    if (result === '1') {
                        $('#msgUserName').html("It already exists");
                        availability = false;
                    } else {
                        $('#msgUserName').html("");
                        availability = true;
                    }
                }
            });
        }
    });
        }//Fin de la función principal
    );

                    /**
                     * Use to validate that the fields are not empty
                     * @returns {Boolean}
                     */
                    function validationForm() {
                        var name = formEdit.name.value;
                        var firstname = formEdit.firstname.value;
                        var secondname = formEdit.secondname.value;
                        var age = formEdit.age.value;
                        var email = formEdit.email.value;
                        var userName = formEdit.userName.value;
                        var password = formEdit.password.value;
                        var phoneReference = formEdit.addPhoneReference.value;
                        var expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

                        if (name.length === 0 || firstname.length === 0 || secondname.length === 0 || age.length === 0 ||
                                email.length === 0 || userName.length === 0 ||
                                password.length === 0) {
                            $("#msgError").html("Error:Check the information.Fields empty");
                        } else if (phoneReference.length < 14) {
                            $("#msgError").html("Error:Check the phone references. The formart is (000)-0000-0000");
                        } else if (!expr.test(email)) {
                            $("#msgError").html("Error: The email " + email + " is incorrect.");
                        }else if(availability===false){
                            $("#msgError").html("");
                        } else {
                            form.submit();
                        }
                        return false;
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

</script>
