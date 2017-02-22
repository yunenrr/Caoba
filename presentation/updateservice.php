<?php include './header.php' ?>
<div>
    <h2>Actualizar Servicio</h2>
    <fieldset>
        <legend>Información básica</legend>
        <div>
            <label>Instructor:</label>
            <select id="selInstructor" name="selInstructor"></select>
        </div>
        <div>
            <label>Nombre del servicio:</label>
            <input type="text" id="txtName" name="txtName" maxlength="20" required="" />
        </div>
        <div>
            <label>Descripción:</label>
            <input type="text" id="txtDescription" name="txtDescription" maxlength="50" required="" />
        </div>
        <div>
            <label>Métodos de pago:</label>
            <table id="tablePaymentMethod" name="tablePaymentMethod"></table>
            <input type="text" id="txtPrice" class="money" name="txtPrice" 
                   maxlength="5" required="" dir="rtl"/>
            <select id="selPaymentModule"></select>
            <button id="btnAdd" name="btnAdd">Agregar</button>
        </div>
        <div>
            <label>Cupo:</label>
            <input type="number" id="txtQuota" name="txtQuota" 
                   maxlength="5" required="" dir="rtl"/>
        </div>
        <div>
            <button id="btnUpdate" name="btnUpdate">Actualizar</button>
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
            if ($.getURLParam("id")=== null || $.getURLParam("id").length === 0) 
            {
                document.location.href = "viewservice.php";
            }//Fin del if
            var id = $.getURLParam("id");
            var selectedPaymentModule = "";
            $('.money').unmask().mask('₡00.000', {reverse: false});
            getAllInstructor();
            getCurrentService();
            getCurrentPaymentMethod();
            
            /***************************** FUNCIONES **************************/
            /**
             * Función que nos permite obtener la información de un
             * */
            function getCurrentService()
            {
                var infoData = "option=9&id="+id;
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
                            if(data.toString().length > 0)
                            {
                                var arrayTemp = data.split(",");
                                $("#selInstructor").val(arrayTemp[1]);
                                $("#txtName").val(arrayTemp[2]);
                                $("#txtDescription").val(arrayTemp[3]);
                                $("#txtQuota").val(arrayTemp[4]);
                                $("#msg").html("");
                            }//Fin del if
                            else
                            {
                                $("#msg").html("El servicio no existe en la base de datos.");
                            }
                        },
                        error:function()
                        {
                            $("#msg").html(getErrorMessage(5));
                        }
                    }
                );
            }//Fin de la función
            
            /**
            * Función que nos permite obtener los métodos de pago actuales en la base de datos.
            * */
            function getCurrentPaymentMethod()
            {
               var infoData = "option=2&id="+id;
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
                                var arrayPaymentModule = data.split(";");
                                
                                for(var i = 0; i < arrayPaymentModule.length; i++)
                                {
                                    var service = arrayPaymentModule[i].split(",");
                                    selectedPaymentModule = selectedPaymentModule + service[0] + ",";
                                    insertGUI("1",service[0],service[1] + "-" + service[2]);
                                }//Fin del for
                                getAllPaymentModule();
                            }
                            else
                            {
                                getAllPaymentModule();
                            }
                        },
                        error:function()
                        {
                            $("#msg").html(getErrorMessage(5));
                        }
                    }
                );
            }//Fin de la función getCurrentPaymentMethod
            
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
                                $("#msg").html("No hay instructores en la base de datos.");
                            }
                        },
                        error:function()
                        {
                            $("#msg").html(getErrorMessage(5));
                        }
                    }
                );
            }//Fin de la función
            
            /**
            * Función que nos permite obtener todos los métodos de pago existentes en la base,
            * y los compara con los que ya teníamos ingresados para el actual servicio.
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
                                var arrayPaymentModule = data.split(";");
                                var temp = '<option value="0" selected="">Seleccione</option>';
                                
                                for(var i = 0; i < arrayPaymentModule.length; i++)
                                {
                                    var service = arrayPaymentModule[i].split(",");
                                    temp = temp + '<option value="'+service[0]+'">'+service[1]+'</option>';
                                }//Fin del for
                                $("#selPaymentModule").html(temp);
                                
                                selectedPaymentModule = selectedPaymentModule.substr(0,selectedPaymentModule.length-1);
                                var arrayTemp = selectedPaymentModule.split(",");
                                selectedPaymentModule = "";

                                for(var i = 0; i < arrayTemp.length; i++)
                                {
                                    hideOptionSelect("1","selPaymentModule",arrayTemp[i]);
                                    selectedPaymentModule = selectedPaymentModule + arrayTemp[i] + ",";
                                }//Fin del for
                            }//Fin del if
                            else
                            {
                                $("#msg").html("No existen métodos de pago para el servicio.");
                            }
                        },
                        error:function()
                        {
                            $("#msg").html(getErrorMessage(5));
                        }
                    }
                );
            }//Fin de la función getAllPaymentModule
            
            /**
            * Función que nos permite insertar métodos de pago enla respectiva tabla.
            * @param {String} option Indicando si es en la tabla de horario o método de pago.
            * @param {String} id Corresponde al identificador del método de pago.
            * @param {String} name Corresponde al nombre del método de pago
            * */
            function insertGUI(option,id,name)
            {
                //Insertar método de pago
                if(option === "1")
                {
                    var content = name.split("-");
                    var newRow = ($("#tablePaymentMethod tr").length);
                    var temp = "";

                    if(newRow === 0)
                    {  
                        temp = '<tr id="tr'+newRow+'">'+
                            '<td><input type="text" id="txtPrice'+newRow+'" value="'+content[1] +'" class="money" disabled="true" />' +
                            '<td><input type="text" value="'+content[0]+'" disabled="true" />' +
                            '<input type="hidden" id="txtPaymentModule'+newRow+'" value="'+id+'" /></td>' +
                            '</tr>';
                        $("#tablePaymentMethod").html(temp);
                    }
                    else
                    {
                        var row = $("#tablePaymentMethod tr:last").attr("id");
                        var newRow = parseInt(row.substring(2,row.length)) + 1;
                        temp = '<tr id="tr'+newRow+'">'+
                            '<td><input type="text" id="txtPrice'+newRow+'" value="'+content[1] +'" class="money" disabled="true" />' +
                            '<td><input type="text" value="'+content[0] +'" disabled="true" />' +
                            '<input type="hidden" id="txtPaymentModule'+newRow+'" value="'+id+'" /></td>' +
                            '</tr>';

                        $("#tablePaymentMethod tr:last").after(temp);
                    }//Fin del else

                    var row = $("#tablePaymentMethod tr:last").attr("id");
                    var newRow = row.substring(2,row.length);
                    var buttons = '<input type="button" value="Delete" class="btnDelete" id="btnDelete'+newRow+'" name="btnDelete'+newRow+'" /></td>';
                    $("#tablePaymentMethod tr:last").append(buttons);
                    $('.money').unmask().mask('₡00.000', {reverse: false});
                }//Fin del if
            }//Fin de la función insertPaymentMethodGUI
            
            /**
             * Función que nos permite ocultar/mostrar opciones de un select.
             * @param {String} type Corresponde a un valor (1/0) indicando si tenemos que ocultar/mostrar
             * @param {String} select Corresponde al nombre del select.
             * @param {String} value Corresponde al valor de la opción.
             * */
            function hideOptionSelect(type,select,value)
            {
                //Ocultar
                if(type === "1")
                {
                    $("#"+select+" option[value="+value+"]").hide();
                    $("#"+select).val("0");
                }//Fin del if
                else //Mostrar
                {
                    $("#"+select+" option[value="+value+"]").show();
                    $("#"+select).val("0");
                }//Fin del else
            }//Fin de la función hideOptionSelect
            
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
                    validateEmptyField($("#txtQuota").val()))
                {
                    flag = false;
                    $("#msg").html(getErrorMessage(1));
                }//Fin del if
                
                return flag;
            }//Fin de la función
            
            /***************************** EVENTOS ****************************/
            //Evento del eliminar método de pago
            $("#tablePaymentMethod").on
            (
                'click','input.btnDelete', function() 
                {
                    var row = $(this).attr("id");
                    var currentRow = row.substring(9,row.length);
                    
                    selectedPaymentModule = selectedPaymentModule.substr(0,selectedPaymentModule.length-1);
                    var arrayTemp = selectedPaymentModule.split(",");
                    selectedPaymentModule = "";
                    
                    for(var i = 0; i < arrayTemp.length; i++)
                    {
                        if(arrayTemp[i] !== $("#txtPaymentModule"+currentRow).val())
                        {
                            selectedPaymentModule = selectedPaymentModule + arrayTemp[i] + ",";
                        }//Fin del if
                    }//Fin del for
                    hideOptionSelect("2","selPaymentModule",$("#txtPaymentModule"+currentRow).val());

                    var infoData = "option=3&id="+id +
                            "&paymentMethod="+$("#txtPaymentModule"+currentRow).val();
                    $.ajax
                    (
                        {
                            type: 'POST',
                            url: "../business/PaymentModuleBusiness.php",
                            data: infoData,
                            beforeSend: function(before)
                            {
                                $("#msg").html(getWaitMessage());
                            },
                            success: function(data)
                            {
                                if(data.toString().length > 0)
                                {
                                    $("#tr"+currentRow).remove();
                                    $("#msg").html(getRemoveMessage(1));
                                }
                                else
                                {
                                    $("#msg").html(getErrorMessage(5));
                                }
                            },
                            error:function()
                            {
                                $("#msg").html(getErrorMessage(5));
                            }
                        }
                    );
                }//Fin de la función del evento
            );//Fin del evento
            
            //Evento del agregar métodos de pago
            $("#btnAdd").on
            (
                'click',function()
                {   
                    if($("#selPaymentModule").val() !== "0")
                    {
                        insertGUI("1",$("#selPaymentModule").val(),$("#selPaymentModule option:selected").html() + "-"+$("#txtPrice").val());
                        selectedPaymentModule = selectedPaymentModule + $("#selPaymentModule").val() + ",";
                        
                        var infoData = "option=4&id="+id +
                                "&paymentMethod="+$("#selPaymentModule").val() + "," + getMoneyInt($("#txtPrice").val());
                        hideOptionSelect("1","selPaymentModule",$("#selPaymentModule").val());
                        $.ajax
                        (
                            {
                                type: 'POST',
                                url: "../business/PaymentModuleBusiness.php",
                                data: infoData,
                                beforeSend: function(before)
                                {
                                    $("#msg").html(getWaitMessage());
                                },
                                success: function(data)
                                {
                                    if(data.toString().length > 0)
                                    {
                                        $("#msg").html(getSuccessfullyInsertedMessage(1));
                                    }
                                    else
                                    {
                                        $("#msg").html(getErrorMessage(5));
                                    }
                                },
                                error:function()
                                {
                                    $("#msg").html(getErrorMessage(5));
                                }
                            }
                        );
                    }//Fin del if
                    else
                    {
                        $("#msg").html(getErrorMessage(3));
                    }//Fin del else
                }//Fin de la función del evento
            );//Fin del evento
            
            //Evento de actualizar
            $("#btnUpdate").on
            (
                'click',function()
                {  
                    if(validation())
                    {
                        var price = getMoneyInt($("#txtPrice").val().toString());
                        var infoData = "option=5"+
                                "&txtID="+id +
                                "&selInstructor="+$("#selInstructor").val() +
                                "&txtName="+$("#txtName").val() +
                                "&txtDescription="+$("#txtDescription").val() +
                                "&txtPrice="+price +
                                "&txtQuota="+$("#txtQuota").val();
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
                                    if(data.toString() !== "0")
                                    {
                                        $("#msg").html(getSuccessfullyInsertedMessage(2));
                                    }
                                    else
                                    {
                                        $("#msg").html(getErrorMessage(5));
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
            ); //fin del evento actualizar
        }//Fin de la función principal
    );
</script>