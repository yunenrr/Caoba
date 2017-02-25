<?php
include './header.php';
include '../business/PersonBusiness.php';
include '../business/AddressBusiness.php';
include '../data/PaymentModuleData.php';

//session_start();
//if (!isset($_SESSION['id'])) {
//    header("location: ./Home.php");
//   
//}

$personBusiness = new PersonBusiness();
$neighborhoodBusiness = new AddressBussiness();
$paymentModuleData=new PaymentModuleData();

$gender = $personBusiness->GetAllGender();
$neighborhood = $neighborhoodBusiness->getAllAddress();
$pay= $paymentModuleData->getAllPaymentModule();

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
        <form id="form" name="form" action="../business/CreateNewClientAction.php" method="POST" onsubmit="return valide(this)">
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
                    <td>Género:</td>
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
              
                    <tr id='payType'>
                    <td>Tipo de pago:</td>
                    <td>
                        <select id="selPay" name="selPay" > 
                            <?php foreach ($pay as $value) { ?>
                                <option value="<?php echo $value->getIdPaymentModule(); ?>"><?php echo $value->getNamePaymentModule(); ?></option> 
                            <?php } ?>
                        </select>
                    </td>
                </tr>

                <!--FECHA PAGO-->
                <tr id='payDate'>
                    <td>Fecha de pago :</td>
                    <td><input type="text" id="payDay" name="payDay" />*</td>
                </tr>
                <!--EMAIL-->
                <tr>
                    <td>Correo:</td>
                    <td><input type="email" id="email" name="email" required placeholder="example@gmail.com"/>*<br/>
                        <div id="msgUserName"></div></td>
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
<div id="qr"></div>
<a href="#" onclick="barrio()">Ingresar barrio</a>
<div id="barrio">
    <fieldset>
        <legend>Barrios</legend>
        <div>
            <table  border="1px" cellpadding="8px">
                <thead>
                    <tr>
                        <th>Barrio</th>
                        <th>Actualizar/Eliminar</th>
                    </tr>
                </thead>
                <tbody id="tableBodyNeighborhood"> 
                </tbody>
                <tfoot>
                    <tr>
                        <td><input type="button" value="Guardar" id="btnInsert" name="btnInsert" />
                            <input type="button" value="Ocultar formulario" id="btnOcultar" name="btnOcultar" onclick="esconderForm();"/></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div>Campos requeridos(*)</div></td>
    </fieldset>
    <div id="msg"></div>
</div>
<?php include './footer.php' ?>
<script type="text/javascript" src="../js/qrcode.js"></script>
<script>

    var availabilityDNI = false; //Availability of dni/username
    var availabilityUser = false;
    var idPhone = 1;

    $(document).ready
            (
                    function ()
                    {
                        getCurrentNeighborhood();
                        document.getElementById('barrio').style.display = 'none';
                         //document.getElementById('payDate').style.display = 'none';
                         //document.getElementById('payType').style.display = 'none';
                        //**************************Mask******************************************
                        $("#dni").mask("9-9999-9999", {placeholder: '0-0000-0000'}); //placeholder
                        $('#addPhoneReference').mask('(000)0000-0000', {placeholder: '(000) 0000-0000'}); //placeholder
                        $('#phone0').mask('(000)0000-0000', {placeholder: '(000) 0000-0000'});
                        $('#birthday').mask('00/00/0000', {placeholder: 'dd/mm/yyyy'});
                        $('#startDay').mask('00/00/0000', {placeholder: 'dd/mm/yyyy'});
                        $('#payDay').mask('00/00/0000', {placeholder: 'dd/mm/yyyy'});
                        getperson();


                        $('#userType').on('change', function () {
                            if($('#userType').val()==='0'){
                                $('#payDate').show();
                                 $('#payType').show();
                                qr();
                            }else{
                                $('#payDate').hide();
                                 $('#payType').hide();
                                 $('#qr').html("");
                            }
                            
                        });
                
                        $(function () {
                            $("#birthday").datepicker();
                            $("#startDay").datepicker();
                            $("#payDay").datepicker();
                        });



                        // Use to valite the username
                        $('#email').focusout(function () {
                            if ($('#email').val() !== "") {
                                $.ajax({
                                    type: "POST",
                                    url: "../business/PersonBusinessAction.php",
                                    data: "option=3&userName=" + $('#email').val(),
                                    beforeSend: function () {
                                        $('#msgUserName').html('');
                                    },
                                    success: function (result) {
                                        if (result === '1') {
                                            $('#msgUserName').html("ERROR!! Ya existe!");
                                            availabilityUser = false;
                                        } else {
                                            $('#msgUserName').html("");
                                            availabilityUser = true;
                                        }
                                    }
                                });
                            }
                        });

                        // Use to valite the dni
                        $('#dni').focusout(function () {
                            if ($('#dni').val().length <= 10) {
                                $('#msgUsuario').html("Error!! El formato es 0-0000-0000");
                            } else {
                                $.ajax({
                                    type: "Post",
                                    url: "../business/PersonBusinessAction.php",
                                    data: "option=2" + "&dni=" + $('#dni').val(),
                                    beforeSend: function () {
                                        $('#msgUsuario').html('');
                                    },
                                    success: function (result) {
                                        if (result === '1') {
                                            $('#msgUsuario').html("Error! Ya existe!");
                                            availabilityDNI = false;
                                        } else {
                                            $('#msgUsuario').html("");
                                            availabilityDNI = true;
                                            
                                           if($('#userType').val()==='0'){
                                            update_qrcode();   
                                           }else{
                                               $('#qr').html('');
                                           }
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
                                                            temp = temp + '<td>' + person[2] + '</td>' +
                                                                    '<td>' + person[3] + '</td>' +
                                                                    '<td>' + person[4] + '</td>' +
                                                                    '<td>' + person[5] + '</td>' +
                                                                    '<td>' + CalculateAge(person[6]) + '</td>' +
                                                                    '<td>' + person[7] + '</td>' +
                                                                    '<td>' + person[8] + '</td>' +
                                                                    '<td>' + person[9] + '</td>' +
                                                                    '<td>' + person[10] + '</td>' +
                                                                    '<td>' + person[11] + '</td>' +
                                                                    '<td>' + person[12] + '</td>' +
                                                                    '<td><a href="../presentation/EditPhone.php?id=' + person[1] + '&name=' + person[3] + '">Teléfonos</a></td>' +
                                                                    '<td><a href="../presentation/Routine.php?id=' + person[1] + '&name=' + person[3] + '">Rutinas</a></td>' +
                                                                    '<td><a href="../presentation/diet.php?id=' + person[1] + '&name=' + person[3] + '">Dieta</a></td>' +
                                                                    '<td><a href="../presentation/MeasurementView.php?id=' + person[1] + '">Medida</a></td>' +
                                                                    '<td><a href="../presentation/conditionSet.php?id=' + person[1] + '&name=' + person[3] + '">Condición</a></td>' +
                                                                    '<td><a href="../presentation/EditClient.php?id=' + person[1] + '">Actualizar</a></td>' +
                                                                    '</tr>';
                                                        }
                                                        $("#tableBodyPerson").html(temp);
                                                        $("#msg").html("");
                                                    } else {
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


                        //*************************Barrio**********************************

                        /************************ EVENTOS *******************************/
                        $("#btnInsert").on
                                (
                                        'click', function ()
                                        {
                                            var row = $("#tableBodyNeighborhood tr:last").attr("id");
                                            var newRow = row.substring(2, row.length);

                                            if (validation(newRow))
                                            {
                                                var buttons = '<td><input type="button" value="Update" class="btnUpdate" id="btnUpdate' + newRow + '" name="btnUpdate' + newRow + '" />' +
                                                        '<input type="button" value="Delete" class="btnDelete" id="btnDelete' + newRow + '" name="btnDelete' + newRow + '" /></td>';
                                                $("#tableBodyNeighborhood tr:last").append(buttons);

                                                var infoData = "option=2" +
                                                        "&txtNeighborhood=" + $("#txtNeighborhood" + newRow).val();
                                                $.ajax
                                                        (
                                                                {
                                                                    type: 'POST',
                                                                    url: "../business/AddressBusinessAction.php",
                                                                    data: infoData,
                                                                    beforeSend: function (before)
                                                                    {
                                                                        $("#msg").html("<p>Wait.</p>");
                                                                    },
                                                                    success: function (data)
                                                                    {
                                                                        if (data.toString() === "1")
                                                                        {
                                                                            $("#msg").html("<p>Success insert.</p>");
                                                                            $("#txtID" + newRow).val(data);
                                                                            insertNewRow("tableBodyNeighborhood");
                                                                            getCurrentNeighborhood();
                                                                        } else
                                                                        {
                                                                            $("#msg").html("<p>Error.</p>");
                                                                        }
                                                                    },
                                                                    error: function ()
                                                                    {
                                                                        $("#msg").html("<p>Error.</p>");
                                                                    }
                                                                }
                                                        );
                                            }//
                                            else {
                                                $("#msg").html("<p>Please, check the information.</p>");
                                            }
                                        }
                                );
                        $("#tableBodyNeighborhood").on
                                (
                                        'click', 'input.btnUpdate', function ()
                                        {
                                            var row = $(this).attr("id");
                                            var currentRow = row.substring(9, row.length);
                                            updateAddress(currentRow);
                                            getCurrentNeighborhood();
                                        }
                                );
                        $("#tableBodyNeighborhood").on
                                (
                                        'click', 'input.btnDelete', function ()
                                        {
                                            var row = $(this).attr("id");
                                            var currentRow = row.substring(9, row.length);
                                            deleteAddress(currentRow);
                                            getCurrentNeighborhood();
                                        }
                                );




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
        var password = form.password.value;
        var phoneReference = form.addPhoneReference.value;
        var startDay = form.startDay.value;
        var expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;


        if (name.length === 0 || firstname.length === 0 || secondname.length === 0 || birthday.length === 0 ||
                email.length === 0 || password.length === 0 || startDay === 0) {

            $("#msgError").html("Error:Revise la Información.Campos vacios");
            ok = false;
        } else if (phoneReference.length < 14) {
            $("#msgError").html("Error:Revise el teléfono de referencia. El formato es (000)-0000-0000");
            ok = false;
        } else if (birthday.length < 10) {
            $("#msgError").html("Error:Revise la fecha de nacimiento.El formato es dd-mm-yyyy");
            ok = false;
        } else if (startDay.length < 10) {
            $("#msgError").html("Error:Revise la fecha de ingreso. El formato es dd-mm-yyyy");
            ok = false;
        } else if (!expr.test(email)) {
            $("#msgError").html("Error: El correo " + email + " está incorrecto.");
            ok = false;
        } else if (availabilityDNI === false || availabilityUser === false) {
            $("#msgError").html("");
            ok = false;
        } else {
            ok = true;
            for (var i = 0; i <= idPhone; i++) {
                var idPhone = 'phone' + idPhone;
                if (form.idPhone.value.length < 14) {
                    $("#msgError").html("Error:ERROR: Revise los teléfonos ingresados!!");
                    ok = false;
                }
            }
            if (ok === true){
               if($('#userType').val()==='0'){
                     sendCodeQR();
                }
            form.submit();
        }
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

        if (ahora_mes < (mes - 1)) {
            edad--;
        }
        if (((mes - 1) === ahora_mes) && (ahora_dia < dia)) {
            edad--;
        }
        if (edad > 1900) {
            edad -= 1900;
        }

        return edad;
    }

    /**
     * Función que nos permite insertar una nueva fila a la tabla.
     * @param {String} nameTable Corresponde al nombre de la tabla
     * */
    function insertNewRow(nameTable)
    {
        var newRow = ($("#" + nameTable + " tr").length);
        var temp = "";

        if (newRow === 0)
        {
            temp = '<tr id="tr' + newRow + '">' +
                    '<td><input type="text" id="txtNeighborhood' + newRow + '" name="txtNeighborhood' + newRow + '" />*<input type="hidden" id="txtID' + newRow + '" name="txtID' + newRow + '" /></td>' +
                    '</tr>';
            $("#" + nameTable).html(temp);
        } else
        {
            var row = $("#tableBodyNeighborhood tr:last").attr("id");
            var newRow = parseInt(row.substring(2, row.length)) + 1;
            temp = '<tr id="tr' + newRow + '">' +
                    '<td><input type="text" id="txtNeighborhood' + newRow + '" name="txtNeighborhood' + newRow + '" />*<input type="hidden" id="txtID' + newRow + '" name="txtID' + newRow + '" /></td>' +
                    '</tr>';
            $("#" + nameTable + " tr:last").after(temp);
        }//Fin del else
    }//Fin de la función

    /**
     * Esta función nos permite poder obtener todos  los registros de inventario 
     * que se encuentra en la base de datos.
     * */
    function getCurrentNeighborhood()
    {
        var infoData = "option=1";
        clearSelect();

        $.ajax
                (
                        {
                            type: 'POST',
                            url: "../business/AddressBusinessAction.php",
                            data: infoData,
                            beforeSend: function (before)
                            {
                                $("#msg").html("<p>Wait.</p>");
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
                                        var neighborhood = array[i].split(",");

                                        temp = temp + '<tr id="tr' + newRow + '">' +
                                                '<td><input type="text" id="txtNeighborhood' + newRow + '" name="txtNeighborhood' + newRow + '" value="' + neighborhood[1] + '"/><input type="hidden" id="txtID' + newRow + '" name="txtID' + newRow + '" value="' + neighborhood[0] + '"/>*</td>' +
                                                '<td><input type="button" value="Actualizar" class="btnUpdate" id="btnUpdate' + newRow + '" name="btnUpdate' + newRow + '" />' +
                                                '<input type="button" value="Elimiar" class="btnDelete" id="btnDelete' + newRow + '" name="btnDelete' + newRow + '" /></td>' +
                                                '</tr>';
                                        document.getElementById("selNeighborhood").options[document.getElementById("selNeighborhood").options.length] = new Option(neighborhood[1], neighborhood[0]);
                                    }
                                    $("#tableBodyNeighborhood").html(temp);
                                    insertNewRow("tableBodyNeighborhood");
                                    $("#msg").html("");
                                } else
                                {
                                    insertNewRow("tableBodyNeighborhood");
                                    $("#msg").html("");
                                }
                            },
                            error: function ()
                            {
                                $("#msg").html("<p>Error.</p>");
                            }
                        }
                );
    }

    /**
     * Función que valida los campos.
     * @param {String} positionToValidate Corresponde a la posición en la tabla.
     * @return {boolean} Indicando si está todo bien o no.
     * */
    function validation(positionToValidate)
    {
        var flag = true;

        if (($("#txtNeighborhood" + positionToValidate).val().length === 0))
        {
            flag = false;
        }

        return flag;
    }//Fin de la función

    /**
     * Esta función nos permite poder eliminar la información del barrio
     * @param {type} currentRow
     * @returns {undefined}             
     * */
    function deleteAddress(currentRow)
    {
        var infoData = "option=4" +
                "&txtID=" + $("#txtID" + currentRow).val();
        $.ajax
                (
                        {
                            type: 'POST',
                            url: "../business/AddressBusinessAction.php",
                            data: infoData,
                            beforeSend: function (before)
                            {
                                $("#msg").html("<p>Wait.</p>");
                            },
                            success: function (data)
                            {
                                if (data.toString() !== "0")
                                {
                                    $("#msg").html("<p>Success delete.</p>");
                                    $("#tr" + currentRow).remove();
                                } else
                                {
                                    $("#msg").html("<p>Error.</p>");
                                }
                            },
                            error: function ()
                            {
                                $("#msg").html("<p>Error.</p>");
                            }
                        }
                );
    }//Fin de la función

    /**
     * Esta función nos permite poder actualizar la información de un inventario.
     * @param {int} currentRow Corresponde a la fila que deseamos actualizar.
     * */
    function updateAddress(currentRow)
    {
        if (validation(currentRow))
        {
            var infoData = "option=3" +
                    "&txtNeighborhood=" + $("#txtNeighborhood" + currentRow).val() +
                    "&txtID=" + $("#txtID" + currentRow).val();
            $.ajax
                    (
                            {
                                type: 'POST',
                                url: "../business/AddressBusinessAction.php",
                                data: infoData,
                                beforeSend: function (before)
                                {
                                    $("#msg").html("<p>Wait.</p>");
                                },
                                success: function (data)
                                {
                                    if (data.toString() !== "0")
                                    {
                                        $("#msg").html("<p>Success update.</p>");
                                    } else
                                    {
                                        $("#msg").html("<p>Error.</p>");
                                    }
                                },
                                error: function ()
                                {
                                    $("#msg").html("<p>Error.</p>");
                                }
                            }
                    );
        } else
        {
            $("#msg").html("<p>Please, check the information.</p>");
        }
    }//Fin de la función

    function barrio() {
        document.getElementById('barrio').style.display = 'block';
    }
    function clearSelect() {
        document.getElementById("selNeighborhood").options.length = 0;
    }
    function esconderForm() {
        document.getElementById('barrio').style.display = 'none';
    }
     function qr() {
     if($('#dni').val().length <= 10 || $('#userType').val()!=='0'){
         $("#qr").html("");
     }else{
         update_qrcode();
     }
    }
    var update_qrcode = function () {
        var temp=$('#dni').val();
        
        var text =temp.
                replace(/^[\s\u3000]+|[\s\u3000]+$/g, '');
         document.getElementById('qr').innerHTML = create_qrcodeImg(text);
    };
    
    function sendCodeQR(){
        var temp=$('#dni').val();
        var correo=$('#email').val();
        
        var text =temp.
                replace(/^[\s\u3000]+|[\s\u3000]+$/g, '');
         var img = create_qrcode(text);
         $.ajax({
               type: 'Post',
               url: "../Business/EmailAction.php",
               data: "option=2&email=" +correo+"&codigo="+img,
               success: function (data) {
                   alert(data);
                },
             });
    }
</script>

<!--../resources/loader.gif-->
