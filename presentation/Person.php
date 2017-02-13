<?php
include './header.php';
include '../business/PersonBusiness.php';

$personBusiness = new PersonBusiness();
$gender = $personBusiness->GetAllGender();
?>
<div>
    <H1 ALIGN=JUSTIFY> Person Registration </H1>
    <table border='2'>
        <thead>
            <tr>
                <th>Identifier</th>
                <th>Name</th>
                <th>First Surname</th>
                <th>Second Surname</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Phone Reference</th>
                <th>Blood Type</th>
                <th>Status</th>
                <th>Phone</th>
                <th>Family</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody id="tableBodyPerson">
        </tbody>
        <tfoot>
        </tfoot>
    </table>
    <div id="msg"></div>
</div><br>


<div>
    <fieldset>
        <legend>Basic Information</legend>
        <!--FORM-->
        <form name="form" action="../business/CreateNewClientAction.php" method="POST" onsubmit="return valide(this)">
            <!--INFO-->
            <table>
                <!--DNI-->
                <tr>
                    <td>Identify:</td>
                    <td><input type="text" id="dni" name="dni" placeholder="0-0000-000" />*
                        <div id="msgUsuario"></div></td>
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
                    <td><input type="text" id="name" name="name" 
                               pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}"/>*<br/></td>
                </tr>

                <!--FIRST NAME-->
                <tr>
                    <td> First surname:</td>
                    <td><input type="text" id="firstname" name="firstname" 
                               pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}"/>*<br/></td>
                </tr>

                <!--SECOND NAME-->
                <tr>
                    <td>Second surname:</td>
                    <td><input type="text" id="secondname" name="secondname" 
                               pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}"/>*<br/></td>
                </tr>

                <!--USER NAME-->
                <tr>
                    <td>User name:</td>
                    <td><input type="text" id="userName" name="userName" />*<br/>
                        <div id="msgUserName"></div></td>
                </tr>
                <!--PASSWORD-->
                <tr>
                    <td>Password:</td>
                    <td><input type="password" id="password" name="password" />*<br/></td>
                </tr>

                <!--AGE-->
                <tr>
                    <td>Age:</td>
                    <td><input type="number" id="age" name="age" min="0"  />*</td>
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
                    <td><input type="email" id="email" name="email" required placeholder="example@gmail.com"/>*<br/></td>
                </tr>

                <!--Phone reference-->
                <tr>
                    <td>Phone reference:</td>
                    <td><input type="text" id="addPhoneReference" name= "addPhoneReference" type="button">*</td>
                </tr>

                <!--PHONE-->
                <tr>
                    <td>Phone:</td>
                    <td>
                        <table border="1" id="phone">
                            <tr id="tr0">
                                <td>
                                    <input id="phones" name="phones" type="text">
                                    <input id="phone0" name="phone0" type="text">
                                </td>
                                <td>
                                    <input id="deletePhone0" type="button" onclick="deletePhone(-1);" value="Delete">
                                </td>
                            </tr>
                        </table>
                        <input id="AddPhone" type="button" onclick="addPhone();" value="Add Phone">
                    </td>
                </tr>
            </table>

            <!--REGISTRE-->
            <div>
                <div>Required fields(*)</div><br>
                <input type="submit" id="submit" name="submit" value="Register">
                <input type="hidden" id="option" name="option" value="2">
            </div>
            <!--MESSAGE ERROR-->
            <div id="msgError"></div>
        </form>
    </fieldset>


</div>
</div>


<?php include './footer.php' ?>
<script type="text/javascript">
    
</script>

<script>
    
     var availability = true; //Availability of dni/username
     var idPhone = 1;
     
    $(document).ready
    (
        function()
        {
            $("#dni").mask("9-999-999", {placeholder: '0-000-000'}); //placeholder
            $('#addPhoneReference').mask('(000)0000-0000', {placeholder: '(000) 0000-0000'}); //placeholder
            $('#phone0').mask('(000)0000-0000', {placeholder: '(000) 0000-0000'});
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

    // Use to valite the dni
    $('#dni').focusout(function () {
        if ($('#dni').val().length <= 8) {
            $('#msgUsuario').html("Check!! The format is 0-000-000");
        } else{
            $.ajax({
                type: "Post",
                url: "../business/PersonBusinessAction.php",
                data: "option=2"+ "&dni=" + $('#dni').val(),
                beforeSend: function () {
                    $('#msgUsuario').html('');
                },
                success: function (result) {
                    if (result === '1'){
                        $('#msgUsuario').html("It already exists");
                        availability = false;
                    } else {
                        $('#msgUsuario').html("");
                        availability = true;
                    }
                }
            });
        }
    });
    /**
     * Función que nos permite obtener las personas actuales en la base de datos.
     * */
   function getperson()
             {
               var info = "option=1";
                $.ajax
                 (
                   {
                     type: 'POST',
                     url: "../business/PersonBusinessAction.php",
                     data: info,
                     beforeSend: function (before)
                      {
                        $("#msg").html("<p>Wait</p>");
                      },
                     success: function (data)
                      {
                        if (data.toString().length > 0)
                         {
                           var temp = "";
                           var array = data.split(";");
                           for (var i = 0; i < array.length; i++)
                            {
                              var newRow = i + 1;
                              var person = array[i].split(",");
                              temp = temp + '<tr id="td' + newRow + '">';
                              temp = temp +'<td>'+ person[2] + '</td>' +
                                            '<td>' + person[3] + '</td>' +
                                            '<td>' + person[4] + '</td>'+
                                            '<td>' + person[5] + '</td>' +
                                            '<td>' + person[6] + '</td>' +
                                            '<td>' + person[7] + '</td>' +
                                            '<td>' + person[8] + '</td>' +
                                            '<td>' + person[9] + '</td>' +
                                            '<td>' + person[10] + '</td>' +
                                            '<td>' + person[11] + '</td>' +
                                            '<td><a href="../presentation/EditPhone.php?id='+ person[1]+ '&name=' +person[3] + '">Phones</a></td>'+
                                            '<td><a href="../presentation/familyRelationship.php?id=' +  person[1] +'&name=' + person[2]+ '">Familiy</a></td>'+
                                            '<td><a href="../presentation/EditClient.php?id='+ person[1]+  '">Edit</a></td>'+
                                            '</tr>';
                            }
                              $("#tableBodyPerson").html(temp);
                              $("#msg").html("");
                         }else{
                          $("#msg").html("No people to show");
                         }
                       },          
                     error: function ()
                       {
                        $("#msg").html("<p>Error.</p>");
                       }
                    }
                  );
             }//Fin de la función
        }//Fin de la función principal
    );
    
    $('#phones').hide();
    function addPhone() {
        $('#phone tr:last').after('<tr id="tr' + idPhone + '"><td><input id="phone' + idPhone + '" name="phone' + idPhone + '" type="text"></td> ' +
                '<td><input id="deletePhone' + idPhone + '" type="button" onclick="deletePhone(' + idPhone + ');" value="Delete">' +
                '</td></tr>');
        
        $('#phones').val(idPhone);
        $('#phone' + idPhone).mask('(000) 0000-0000', {placeholder: '(000) 0000-0000'});
        idPhone++;
    }

    function deletePhone(id) {
        $("#tr" + id).remove();
    }

    function action() {
        location.href = "../business/CreateNewClientAction.php?phones=" + idPhone + "";
    }
    
     /**
     * Use to validate that the fields are not empty
     * @returns {Boolean} */
    function valide() {
        var ok = false;
        var name = form.name.value;
        var firstname = form.firstname.value;
        var secondname = form.secondname.value;
        var age = form.age.value;
        var email = form.email.value;
        var userName = form.userName.value;
        var password = form.password.value;
        var phoneReference = form.addPhoneReference.value;
        var expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        if (name.length === 0 || firstname.length === 0 || secondname.length === 0 || age.length === 0 ||
                email.length === 0 || userName.length === 0 ||
                password.length === 0) {
            $("#msgError").html("Error:Check the information.Fields empty");
            ok = false;
        } else if (phoneReference.length < 14) {
            $("#msgError").html("Error:Check the phone references. The formart is (000)-0000-0000");
            ok = false;
        } else if (!expr.test(email)) {
            $("#msgError").html("Error: The email " + email + " is incorrect.");
            ok = false;
        }else if(availability===false){
            $("#msgError").html("");
            ok = false; 
        } else {
            ok = true;
            for (var i = 0; i <= idPhone; i++) {
            var idPhone = 'phone' + idPhone;
            alert('phone');
            if (form.idPhone.value.length < 14) {
                 $("#msgError").html("Error:ERROR: Check the phones!!");
                ok = false;
            }
        }
        if (ok === true)
            form.submit();
        }
        return false;
        
    }
</script>

