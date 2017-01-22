
<?php
include './header.php';
include '../business/PersonBusiness.php';

$id = $_GET['id'];
$personBusiness = new PersonBusiness();
$person = $personBusiness->getPerson($id);
?>

<H1 ALIGN=JUSTIFY> Edit customer </H1>

<!--FORM-->
<form  name="formEdit"action="../business/EditClientAction.php" method="post" onsubmit="return validationForm(this);">
    <table>

        <!--DNI-->
        <tr>
            <td>DNI:   </td>
            <td>
                <input readonly="readonly" type="text" id="dni" name="dni"  value=<?php echo $person->getDniPerson() ?> required  /><br/>
            </td>
        </tr>

        <!--NAME-->
        <tr>
            <td>Person name:</td>
            <td>
                <input type="text" id="name" name="name" 
                       pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}"  value=<?php echo $person->getNamePerson() ?> required  /><br/>
            </td>
        </tr>

        <!--FISTNAME-->
        <tr>
            <td>First name:</td>
            <td>
                <input type="text" id="firstname" name="firstname" 
                       pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" value=<?php echo $person->getFirstNamePerson() ?> required /><br/>
            </td>
        </tr>

        <!--SECONDNAME-->
        <tr>
            <td>Second name:</td>
            <td>
                <input type="text" id="secondname" name="secondname" 
                       pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" value=<?php echo $person->getSecondNamePerson() ?> required/><br/>
            </td>
        </tr>

        <!--USER NAME-->
        <tr><td>User name:</td>
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
            <td>
                <input type="number" id="age" name="age" min="0" value=<?php echo $person->getAgePerson() ?> required/>
            </td>
        </tr>

        <!--GENDER-->
        <tr>
            <td>Gender:</td>
            <td>
                <input type="radio" id="gender" name="gender"
                       accept=""<?php if (isset($gender) && $gender == 0) echo "checked"; ?>
                       value=0>Female
                <input type="radio" id="gender" name="gender"
                       accept=""<?php if (isset($gender) && $gender == 1) echo "checked"; ?>
                       value=1>Male
                <input type="radio" id="gender" name="gender"
                       accept=""<?php if (isset($gender) && $gender == 2) echo "checked"; ?>
                       value=1>Undefined
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
            <td>
                <input type="email" id="email" name="email" value=<?php echo $person->getEmailPerson() ?> required/><br/>
            </td>
        </tr>

        <!--Phone reference-->
            <tr>
                <td>Phone reference:</td>
                <td><input type="number" id="addPhoneReference" name= "addPhoneReference" type="button" value=<?php echo $person->getPhoneReferencePerson() ?>  required></td>
            </tr>
        <!--ADDRESS-->
        <tr>
            <td>Address:</td>
            <td>
                <textarea id="address" name="address" rows="5" cols="40" required><?php echo $person->getAddressPerson() ?></textarea>
            </td>
        </tr>
        <!--ID-->
        <tr>
            <td> <input type="hidden" dni ="id" name="id" value=<?php echo $id ?> /><br/>
        </tr>

        <!--REGISTRE-->
        <tr>
            <td><br></td>
            <td>
                <input type="submit" name="submit" value="Edit">
            </td>
        </tr>
    </table>

    <!--MESSAGE ERROR-->
    <div id="errorMsj" style="position:absolute; left:100px; top:600px; 
         width:300px; height:40px; display: none ; border:2px solid red; color:#ffffff; background-color: red; ">ERROR: Please fill all fields!<br></div>
</form>

<?php include './footer.php' ?>

<script type="text/javascript">

    /**
     * Use to validate that the fields are not empty
     * @returns {Boolean}
     */
    function validationForm() {
        name = document.formEdit.name.value;
        firstname = document.formEdit.firstname.value;
        secondname = document.formEdit.secondname.value;
        age = document.formEdit.age.value;
        gender = document.formEdit.gender.value;
        email = document.formEdit.email.value;
        address = document.formEdit.address.value;


        if (name.length == 0 || firstname.length == 0 || secondname.length == 0 || age.length == 0 ||
                gender.length == 0 || email.length == 0 || address.length == 0) {
            document.getElementById('errorMsj').style.display = 'block';
            return false;

        } else {
            return true;
        }
    }
</script>
