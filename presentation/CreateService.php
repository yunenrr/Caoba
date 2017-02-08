<?php include './header.php' ?>
<div>
    <h2>Register Service</h2>
    <fieldset>
        <legend>Basic Information</legend>
        <div>
            <label>Instructor:</label>
            <select id="selInstructor" name="selInstructor"></select>
        </div>
        <div>
            <label>Name:</label>
            <input type="text" id="txtName" name="txtName" maxlength="20" required="" />
        </div>
        <div>
            <label>Description:</label>
            <input type="text" id="txtDescription" name="txtDescription" maxlength="50" required="" />
        </div>
        <div>
            <label>Payment Method:</label>
            <table id="tablePaymentMethod" name="tablePaymentMethod"></table>
            <input type="text" class="money" id="txtPrice" name="txtPrice" 
                   maxlength="5" required="" dir="rtl"/>
            <select id="selPaymentModule"></select>
            <button id="btnAdd" name="btnAdd">Add</button>
        </div>
        <div>
            <label>Quota:</label>
            <input type="number" id="txtQuota" name="txtQuota" 
                   maxlength="5" required="" dir="rtl"/>
        </div>
        <div>
            <label>Periodicity:</label>
            <select id="selPeriodicity" name="selPeriodicity">
                <option value="1">Monthly</option>
                <option value="6">Biannual</option>
                <option value="12">Annual</option>
            </select>
        </div>
        <div>
            <button id="btnInsert" name="btnInsert">Insert</button>
        </div>
    </fieldset>
    <div id="msg"></div>
</div>
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
                                var temp = '<option value="0" selected="">Select</option>';
                                
                                for(var i = 0; i < arrayPaymentModule.length; i++)
                                {
                                    var service = arrayPaymentModule[i].split(",");
                                    temp = temp + '<option value="'+service[0]+'">'+service[1]+'</option>';
                                }//Fin del for
                                $("#selPaymentModule").html(temp);
                            }
                            else
                            {
                                $("#msg").html("Don't have instructor");
                            }
                        },
                        error:function()
                        {
                            $("#msg").html("<p>Error.</p>");
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
                
                if(($("#txtName").val().length === 0) ||
                    ($("#txtDescription").val().length === 0) ||
                    ($("#txtQuota").val().length === 0))
                {
                    flag = false;
                    $("#msg").html("Leave some blank");
                }//Fin del if de campos en blanco
                else
                {
                    if(selectedPaymentModule.length === 0)
                    {
                        flag = false;
                        $("#msg").html("Please select at least one method of payment");
                    }
                }//Fin del else de campos en blanco
                
                return flag;
            }//Fin de la función
            
            /**
            * Función que nos permite obtener el entero del precio.
            * @param {String} money Corresponde al String del precio.
            * @return {String} Corresponde al precio, pero sin puntos ni símbolo de colón.
            * */
            function getMoneyInt(money)
            {
                var moneyInt = "";
                var moneyWithOutColon = money.substring(1,money.lenght);
                var arrayMoney = moneyWithOutColon.split(".");
                
                for(var i = 0; i < arrayMoney.length;i++)
                {
                    moneyInt = moneyInt + arrayMoney[i];
                }
                
                return moneyInt;
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
                                $("#msg").html("Don't have instructor");
                            }
                        },
                        error:function()
                        {
                            $("#msg").html("<p>Error.</p>");
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
                        $("#msg").html("");
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
                        $("#msg").html("Please select an option");
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
                                "&paymentMethod="+selectedPaymentModule;
                        $.ajax
                        (
                            {
                                type: 'POST',
                                url: "../business/ServiceBusiness.php",
                                data: infoData,
                                beforeSend: function(before)
                                {
                                    $("#msg").html("<p>Wait.</p>");
                                },
                                success: function(data)
                                {
                                    if(data.toString() !== "0")
                                    {
                                        $("#msg").html("<p>Success.</p>");
                                    }
                                    else
                                    {
                                        $("#msg").html("<p>Error.</p>");
                                    }
                                },
                                error:function()
                                {
                                    $("#msg").html("<p>Error.</p>");
                                }
                            }
                        );
                    }//Fin del if
                }//Fin de la función del evento
            ); //fin del evento
        }//Fin de la función principal
    );
</script>