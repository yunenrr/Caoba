<?php
include './header.php';
include '../business/PersonBusiness.php';
include '../business/AddressBusiness.php';

session_start();
if (!isset($_SESSION['id'])) {
    header("location: ./Home.php");
}

$personBusiness = new PersonBusiness();
$neighborhoodBusiness= new AddressBussiness();
$gender = $personBusiness->GetAllGender();
$neighborhood= $neighborhoodBusiness->getAllAddress();
?>
<div>
    <H1 ALIGN=JUSTIFY>Registro </H1>
    <table border='1'>
        <thead>
            <tr>
                <th>Cédula</th>
                <th>Nombre</th>
                <th>Primer apellido</th>
                <th>Segundo apellido</th>
                <th>Edad</th>
                <th>Género</th>
                <th>Correo</th>
                <th>Teléfono de referencia</th>
                <th>Tipo de sangre</th>
                <th>Estado</th>
                <th>Barrio</th>
                <th>Teléfono</th>
                <th>Rutinas</th>
                <th>Dieta</th>
                <th>Medidas</th>
                <th>Condición</th>
                <th>Actualizar</th>
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
        <legend>Infomación Personal</legend>
        <!--FORM-->
        <form name="form" action="../business/CreateNewClientAction.php" method="POST" onsubmit="return valide(this)">
            <!--INFO-->
            <table  border="1px" cellpadding="8px">
                <!--DNI-->
                <tr>
                    <td>Cédula:</td>
                    <td><input type="text" id="dni" name="dni" placeholder="0-0000-000" />*
                        <div id="msgUsuario"></div></td>
                </tr>

                <!--Type user-->
                <tr>
                    <td> Tipo de usuario:</td>
                    <td><select id="userType" name="userType"><option value="0">Client</option><option value="1">Instructor</option>
                            <option value="2">Instructor & Admin</option><option value="3">Admin</option></select></td>
                </tr>

                <!--NAME-->
                <tr>
                    <td>Nombre:</td>
                    <td><input type="text" id="name" name="name" 
                               pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}"/>*<br/></td>
                </tr>

                <!--FIRST NAME-->
                <tr>
                    <td> Primer Apellido:</td>
                    <td><input type="text" id="firstname" name="firstname" 
                               pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}"/>*<br/></td>
                </tr>

                <!--SECOND NAME-->
                <tr>
                    <td>Segundo Apellido:</td>
                    <td><input type="text" id="secondname" name="secondname" 
                               pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}"/>*<br/></td>
                </tr>

                <!--USER NAME-->
                <tr>
                    <td>Nombre de usuario:</td>
                    <td><input type="text" id="userName" name="userName" />*<br/>
                        <div id="msgUserName"></div></td>
                </tr>
                <!--PASSWORD-->
                <tr>
                    <td>Contraseña:</td>
                    <td><input type="password" id="password" name="password" />*<br/></td>
                </tr>

                <!--Birthday-->
                <tr>
                    <td>Fecha de nacimiento:</td>
                    <td><input type="text" id="birthday" name="birthday" />*</td>
                </tr>
                
                <!--StartDate-->
                <tr>
                    <td>Fecha de ingreso :</td>
                    <td><input type="text" id="startDay" name="startDay" />*</td>
                </tr>
                <!--GENDER-->
                <tr>
                    <td>Genero:</td>
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
                    <td>Tipo de sangre:</td>
                    <td><select id="selBlood" name="selBlood"><option value="0-">0-</option><option value="0+">0+</option>
                            <option value="A-">A-</option><option value="A+">A+</option> <option value="B-">B-</option>
                            <option value="B+">B+</option><option value="AB-">AB-</option><option value="AB+">AB+</option> </select></td>
                </tr>
                <!--NEIGHBORHOOD-->
                <tr>
                    <td>Barrio:</td>
                    <td>
                        <select id="selNeighborhood" name="selNeighborhood" > 
                            <?php foreach ($neighborhood as $value) { ?>
                                <option value="<?php echo $value->getIdAddress(); ?>"><?php echo $value->getNeighborhoodAddresss(); ?></option> 
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <!--EMAIL-->
                <tr>
                    <td>Correo:</td>
                    <td><input type="email" id="email" name="email" required placeholder="example@gmail.com"/>*<br/></td>
                </tr>

                <!--Phone reference-->
                <tr>
                    <td>Teléfono de referencia:</td>
                    <td><input type="text" id="addPhoneReference" name= "addPhoneReference" type="button">*</td>
                </tr>

                <!--PHONE-->
                <tr>
                    <td>Teléfono:</td>
                    <td>
                        <table border="1" id="phone">
                            <tr id="tr0">
                                <td>
                                    <input id="phones" name="phones" type="text">
                                    <input id="phone0" name="phone0" type="text">
                                </td>
                                <td>
                                    <input id="deletePhone0" type="button" onclick="deletePhone(-1);" value="Eliminar">
                                </td>
                            </tr>
                        </table>
                        <input id="AddPhone" type="button" onclick="addPhone();" value="Agregar teléfono">
                    </td>
                </tr>
            </table>

            <!--REGISTRE-->
            <div>
                <div>Campos obligatorios(*)</div><br>
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
     CalculateAge('1992-11-');
     
    $(document).ready
    (
        function()
        {
            //**************************Mask******************************************
            $("#dni").mask("9-999-999", {placeholder: '0-000-000'}); //placeholder
            $('#addPhoneReference').mask('(000)0000-0000', {placeholder: '(000) 0000-0000'}); //placeholder
            $('#phone0').mask('(000)0000-0000', {placeholder: '(000) 0000-0000'});
            $('#birthday').mask('0000-00-00', {placeholder: 'yyyy-mm-dd'});
            $('#startDay').mask('0000-00-00', {placeholder: 'yyyy-mm-dd'});
            getperson();  
            
    // Use to valite the username
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
                        $('#msgUserName').html("ERROR!! Ya existe!");
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
            $('#msgUsuario').html("Error!! El formato es 0-000-000");
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
                        $('#msgUsuario').html("Error! Ya existe!");
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
                                            '<td>' + CalculateAge(person[6]) + '</td>' +
                                            '<td>' + person[7] + '</td>' +
                                            '<td>' + person[8] + '</td>' +
                                            '<td>' + person[9] + '</td>' +
                                            '<td>' + person[10] + '</td>' +
                                            '<td>' + person[11] + '</td>' +
                                            '<td>' + person[12] + '</td>' +
                                            '<td><a href="../presentation/EditPhone.php?id='+ person[1]+ '&name=' +person[3] + '">Teléfonos</a></td>'+
                                            '<td><a href="../presentation/Routine.php?id=' +  person[1] +'&name=' + person[3]+ '">Rutinas</a></td>'+
                                            '<td><a href="../presentation/diet.php?id=' +  person[1] +'&name=' + person[3]+ '">Dieta</a></td>'+
                                            '<td><a href="../presentation/MeasurementView.php?id=' +  person[1] + '">Medida</a></td>'+
                                            '<td><a href="../presentation/conditionSet.php?id=' +  person[1] +'&name=' + person[3]+ '">Condición</a></td>'+
                                            '<td><a href="../presentation/EditClient.php?id='+ person[1]+  '">Actualizar</a></td>'+
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
        var birthday = form.birthday.value;
        var email = form.email.value;
        var userName = form.userName.value;
        var password = form.password.value;
        var phoneReference = form.addPhoneReference.value;
        var startDay = form.startDay.value;
        var expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        if (name.length === 0 || firstname.length === 0 || secondname.length === 0 || birthday.length === 0 ||
                email.length === 0 || userName.length === 0 ||
                password.length === 0 || startDay===0) {
            
            $("#msgError").html("Error:Revise la Información.Campos vacios");
            ok = false;
        } else if (phoneReference.length < 14) {
            $("#msgError").html("Error:Revise el teléfono de referencia. El formato es (000)-0000-0000");
            ok = false;
        }else if (birthday.length < 10) {
            $("#msgError").html("Error:Revise la fecha de nacimiento.El formato es aaa-mm-dd");
            ok = false;
        }else if (startDay.length < 10) {
            $("#msgError").html("Error:Revise la fecha de ingreso. El formato es aaa-mm-dd");
            ok = false;
        }
        else if (!expr.test(email)) {
            $("#msgError").html("Error: El correo " + email + " está incorrecto.");
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
                 $("#msgError").html("Error:ERROR: Revise los teléfonos ingresados!!");
                ok = false;
            }
        }
        if (ok === true)
            form.submit();
        }
        return false;
        
    }
    /**
     * Método utilizado para calcular la edad de una persona apartir de su fecha de nacimiento.
     * @param {type} date
     * @returns {Number}
     */
    function CalculateAge(date) {
   	//calculo la fecha que recibo 
   	//La descompongo en un array 
   	var array_fecha = date.split("-");
   	 
        var dia = array_fecha[2];
        var mes = array_fecha[1];
        var ano = array_fecha[0];

        fecha_hoy = new Date();
        ahora_ano = fecha_hoy.getYear();
        ahora_mes = fecha_hoy.getMonth();
        ahora_dia = fecha_hoy.getDate();
        edad = (ahora_ano + 1900) - ano;

        if ( ahora_mes < (mes - 1)){
          edad--;
        }
        if (((mes - 1) === ahora_mes) && (ahora_dia < dia)){ 
          edad--;
        }
        if (edad > 1900){
            edad -= 1900;
        }

        return edad;
}
</script>


