<?php include './header.php' ?>
<div>
    <h2>Ingresar Servicio</h2>
    <fieldset>
        <legend>Información Básica:</legend>
        <div>
            <label>Instructor:</label>
            <select id="selInstructor" name="selInstructor"></select>
        </div>
        <div>
            <label>Nombre del servicio:</label>
            <input type="text" id="txtName" name="txtName" maxlength="20" required="" />
            <label>*</label>
        </div>
        <div>
            <label>Descripción:</label>
            <input type="text" id="txtDescription" name="txtDescription" maxlength="50" required="" />
            <label>*</label>
        </div>
        <div>
            <label>Método de pago:</label>
            <table id="tablePaymentMethod" name="tablePaymentMethod"></table>
            <input type="text" class="money" id="txtPrice" name="txtPrice" 
                   maxlength="5" required="" dir="rtl" placeholder="₡"/>
            <select id="selPaymentModule"></select>
            <button id="btnAdd" name="btnAdd">Agregar</button>
            <label>**</label>
        </div>
        <div>
            <label>Cupo:</label>
            <input type="number" id="txtQuota" name="txtQuota" 
                   maxlength="5" min="1" required=""/>
            <label>*</label>
        </div>
        <div>
            <label>Fecha de inicio:</label>
            <input type="text" class="date" id="txtStartDate" name="txtStartDate" required=""/>
            <label>*</label>
        </div>
        <div>
            <label>Periodicidad:</label>
            <select id="selPeriodicity" name="selPeriodicity">
                <option value="1">Mensual</option>
                <option value="6">Semestral</option>
                <option value="12">Anual</option>
            </select>
            <label>*</label>
        </div>
        <div>
            <button id="btnInsert" name="btnInsert">Ingresar Servicio</button>
        </div>
        <div>
            <p>* = Requerido</p>
            <p>** = Debe ingresar mínimo un método de pago.</p>
        </div>
    </fieldset>
    <div id="msg"></div>
</div>
<script src="../js/jsMessage.js" type="text/javascript"></script>
<script src="../js/jsValidation.js" type="text/javascript"></script>
<script src="../js/jsService.js" type="text/javascript"></script>
<?php include './footer.php' ?>
<script type="text/javascript">
    $(document).ready
    (
        function()
        {
            var arrayPaymentModule = "";
            var selectedPaymentModule = "";
            
            getAllPaymentModule();
            getAllInstructor();
            
            $('.money').mask('₡00.000', {reverse: false});
            $('.date').mask('00-00-0000', {placeholder: 'dd-mm-yyyy'});
            $( ".date" ).datepicker({firstDay: 1,dateFormat: 'dd-mm-yy'});
            
            /***************************** FUNCIONES **************************/
            /**
            * Función que nos permite obtener todos los métodos de pago existentes en la base.
            * */
            function getAllPaymentModule()
            {
                var infoData = "option=1";
                $.ajax
                (
                    {
                        type: 'POST',
                        url: "../business/PaymentModuleBusiness.php",
                        data: infoData,
                        beforeSend: function(before)
                        {
                        },
                        success: function(data)
                        {
                            if(data.toString().length > 0)
                            {
                                arrayPaymentModule = data.split(";");
                                var temp = '<option value="0" selected="">Seleccione</option>';
                                
                                for(var i = 0; i < arrayPaymentModule.length; i++)
                                {
                                    var service = arrayPaymentModule[i].split(",");
                                    temp = temp + '<option value="'+service[0]+'">'+service[1]+'</option>';
                                }//Fin del for
                                $("#selPaymentModule").html(temp);
                            }
                            else
                            {
                                $("#msg").html("No existen métodos de pago en la base.");
                            }
                        },
                        error:function()
                        {
                            $("#msg").html("<p>Ocurrió un error al realizar la consulta en la base de datos..</p>");
                        }
                    }
                );
            }//Fin de la función getAllPaymentModule
            
            /**
             * Función que nos permite insertar una nueva fila a la tabla.
             * @param {String} nameTable Corresponde al nombre de la tabla
             * */
            function insertNewRowPaymentMethod(nameTable)
            {
                var newRow = ($("#"+nameTable+" tr").length);
                var temp = "";
                
                if(newRow === 0)
                {  
                    temp = '<tr id="tr'+newRow+'">'+
                        '<td><input type="text" id="txtPrice'+newRow+'" value="'+$("#txtPrice").val() +'" disabled="true" />' +
                        '<td><input type="text" value="'+$("#selPaymentModule option:selected").html() +'" disabled="true" />' +
                        '<input type="hidden" id="txtPaymentModule'+newRow+'" value="'+$("#selPaymentModule").val() +'" /></td>' +
                        '</tr>';
                    $("#"+nameTable).html(temp);
                }
                else
                {
                    var row = $("#tablePaymentMethod tr:last").attr("id");
                    var newRow = parseInt(row.substring(2,row.length)) + 1;
                    temp = '<tr id="tr'+newRow+'">'+
                        '<td><input type="text" id="txtPrice'+newRow+'" value="'+$("#txtPrice").val() +'" disabled="true" />' +
                        '<td><input type="text" value="'+$("#selPaymentModule option:selected").html() +'" disabled="true" />' +
                        '<input type="hidden" id="txtPaymentModule'+newRow+'" value="'+$("#selPaymentModule").val() +'" /></td>' +
                        '</tr>';
                    
                    $("#"+nameTable+" tr:last").after(temp);
                }//Fin del else
            }//Fin de la función
            
            /**
            * Función que valida los campos.
            * @return {boolean} Indicando si está todo bien o no.
            * */
            function validation()
            {
                var flag = true;
                
                //Se pregunta si están vacíos
                if(validateEmptyField($("#txtName").val()) &&
                    validateEmptyField($("#txtDescription").val()) &&
                    validateEmptyField(selectedPaymentModule) &&
                    validateEmptyField($("#txtQuota").val()) &&
                    validateEmptyField($("#txtStartDate").val()))
                {
                    flag = false;
                    $("#msg").html(getErrorMessage(1));
                }//Fin del if
                else
                {
                    //Se valida que la fecha sea valida
                    if(!validateDate($("#txtStartDate").val()))
                    {
                        flag = false;
                        $("#msg").html(getErrorMessage(4));
                    }//Fin del if
                    
                    //Se valida que la cuota sea un número positivo
                    if(parseInt($("#txtQuota").val()) <= 0)
                    {
                        flag = false;
                        $("#msg").html("Ingrese un cupo mayor a cero");
                    }
                }//Fin del else de verificacion de espacios vacios
                
                return flag;
            }//Fin de la función
            
            /**
            * Función que nos permite obtener todos los instructores de la base de datos.
            * */
            function getAllInstructor()
            {
                var infoData = "option=2";
                var arrayAllInstructor = "";
                var temp = "";
                $.ajax
                (
                    {
                        type: 'POST',
                        url: "../business/ServiceBusiness.php",
                        data: infoData,
                        beforeSend: function(before)
                        {
                        },
                        success: function(data)
                        {
                            if(data.toString().length > 0)
                            {
                                arrayAllInstructor = data.split(";");
                                
                                for(var i = 0; i < arrayAllInstructor.length; i++)
                                {
                                    var service = arrayAllInstructor[i].split(",");
                                    temp = temp + '<option value="'+service[0]+'" selected="">'+service[1]+'</option>';
                                }//Fin del for
                                $("#selInstructor").html(temp);
                            }
                            else
                            {
                                $("#msg").html("No existen instructores en la base de datos.");
                            }
                        },
                        error:function()
                        {
                            $("#msg").html("<p>Ocurrió un error al conectarse a la base de datos.</p>");
                        }
                    }
                );
            }//Fin de la función
            
            /***************************** EVENTOS **************************/
            $("#btnAdd").on
            (
                'click',function()
                {   
                    if($("#selPaymentModule").val() !== "0")
                    {
                        //Preguntamos si está vacío
                        if(validateEmptyField($("#txtPrice").val()))
                        {
                            $("#msg").html(getErrorMessage(1));
                        }//Fin del if
                        else
                        {
                            //Preguntamos si es un número
                            if(validateNumberField(getMoneyInt($("#txtPrice").val())))
                            {
                                $("#msg").html(getSuccessfullyInsertedMessage(1));
                                insertNewRowPaymentMethod("tablePaymentMethod");
                                var row = $("#tablePaymentMethod tr:last").attr("id");
                                var newRow = row.substring(2,row.length);
                                var buttons = '<input type="button" value="Delete" class="btnDelete" id="btnDelete'+newRow+'" name="btnDelete'+newRow+'" /></td>';
                                $("#tablePaymentMethod tr:last").append(buttons);
                                selectedPaymentModule = selectedPaymentModule + $("#selPaymentModule").val() + "," + getMoneyInt($("#txtPrice").val()) + ";";
                                $("#selPaymentModule option[value="+$("#selPaymentModule").val()+"]").hide();
                                $("#selPaymentModule").val("0");
                            }//Fin del if
                            else
                            {
                                $("#msg").html(getErrorMessage(2));
                            }//Fin del else
                        }//Fin del else
                    }//Fin del if
                    else
                    {
                        $("#msg").html(getErrorMessage(3));
                    }//Fin del else
                }//Fin de la función del evento
            );//Fin del evento
    
            $("#tablePaymentMethod").on
            (
                'click','input.btnDelete', function() 
                {
                    var row = $(this).attr("id");
                    var currentRow = row.substring(9,row.length);
                    
                    selectedPaymentModule = selectedPaymentModule.substr(0,selectedPaymentModule.length-1);
                    var arrayTemp = selectedPaymentModule.split(";");
                    selectedPaymentModule = "";
                    
                    //Recorremos el arreglo que contiene el conjunto idMétodo de pago - Precio a aplicar
                    for(var i = 0; i < arrayTemp.length; i++)
                    {
                        var arraySecond = arrayTemp[i].split(",");
                        if(arraySecond[0] !== $("#txtPaymentModule"+currentRow).val())
                        {
                            selectedPaymentModule = selectedPaymentModule + arraySecond[0] + "," + arraySecond[1] + ";";
                        }//Fin del if
                    }//Fin del for
                    $("#selPaymentModule option[value="+$("#txtPaymentModule"+currentRow).val()+"]").show();
                    $("#selPaymentModule").val("0");
                    $("#tr"+currentRow).remove();
                    $("#msg").html(getRemoveMessage(1));
                }//Fin de la función del evento
            );//Fin del evento
        
            $("#btnInsert").on
            (
                'click',function()
                {  
                    if(validation())
                    {
                        selectedPaymentModule = selectedPaymentModule.substr(0,selectedPaymentModule.length-1);
                        var infoData = "option=3"+
                                "&selInstructor="+$("#selInstructor").val() +
                                "&txtName="+$("#txtName").val() +
                                "&txtDescription="+$("#txtDescription").val() +
                                "&txtQuota="+$("#txtQuota").val() +
                                "&selPeriodicity="+$("#selPeriodicity").val() +
                                "&txtStartDate="+getDateInvert($("#txtStartDate").val()) +
                                "&paymentMethod="+selectedPaymentModule;
                        $.ajax
                        (
                            {
                                type: 'POST',
                                url: "../business/ServiceBusiness.php",
                                data: infoData,
                                beforeSend: function(before)
                                {
                                    $("#msg").html(getWaitMessage());
                                },
                                success: function(data)
                                {
                                    if(data.toString() === "1")
                                    {
                                        $("#msg").html(getSuccessfullyInsertedMessage(2));
                                    }
                                    else if(data.toString() === "0")
                                    {
                                        $("#msg").html("No se pudo ingresar el servicio.");
                                    }
                                    else if(data.toString() === "2")
                                    {
                                        $("#msg").html("El instructor ya está registrado en este servicio.");
                                    }
                                },
                                error:function()
                                {
                                    $("#msg").html(getErrorMessage(5));
                                }
                            }
                        );
                    }//Fin del if
                }//Fin de la función del evento
            ); //fin del evento
        }//Fin de la función principal
    );
</script>