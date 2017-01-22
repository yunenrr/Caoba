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
            <label>Price:</label>
            <input type="text" id="txtPrice" class="money" name="txtPrice" 
                   maxlength="5" required="" dir="rtl"/>
        </div>
        <div>
            <label>Payment Method:</label>
            <table id="tablePaymentMethod" name="tablePaymentMethod"></table>
            <select id="selPaymentModule"></select>
            <button id="btnAdd" name="btnAdd">Add</button>
        </div>
        <div>
            <label>Quota:</label>
            <input type="number" id="txtQuota" name="txtQuota" 
                   maxlength="5" required="" dir="rtl"/>
        </div>
        <div>
            <label>Start date:</label>
            <input type="text" class="date" id="startDate" name="startDate"/>
        </div>
        <div>
            <label>End date:</label>
            <input type="text" class="date" id="endDate" name="endDate"/>
        </div>
        <div>
            <label>Schedule:</label>
            <table id="tableSchedule" name="tablePaymentMethod"></table>
            <select id="selDay"></select>
            <select id="selScheduleByDay"></select>
            <button id="btnAddSchedule" name="btnAdd">Add</button>
        </div>
        <div>
            <button id="btnUpdate" name="btnUpdate">Update</button>
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
            if ($.getURLParam("id")=== null || $.getURLParam("id").length === 0) 
            {
                document.location.href = "ViewService.php";
            }//Fin del if
            var id = $.getURLParam("id");
            var selectedPaymentModule = "";
            var selectedSchedule = "";
            
            getAllInstructor();
            getCurrentService();
            getCurrentPaymentMethod();
            getCurrentSchedule();
            getAllDay();
            
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
                            $("#msg").html("Wait");
                        },
                        success: function(data)
                        {
                            if(data.toString().length > 0)
                            {
                                var arrayTemp = data.split(",");
                                $("#selInstructor").val(arrayTemp[1]);
                                $("#txtName").val(arrayTemp[2]);
                                $("#txtDescription").val(arrayTemp[3]);
                                $("#txtPrice").val(arrayTemp[4]);
                                $("#txtQuota").val(arrayTemp[5]);
                                $("#startDate").val(getDateInvert(arrayTemp[6]));
                                $("#endDate").val(getDateInvert(arrayTemp[7]));
                                $("#msg").html("");
                                $('.money').unmask().mask('₡00.000', {reverse: false});
                                $('.date').unmask().mask('00-00-0000');
                            }//Fin del if
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
            
            /**
            * Función que nos permite obtener los métodos de pago actuales en la base de datos.
            * */
            function getCurrentPaymentMethod()
            {
               var infoData = "option=10&id="+id;
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
                                var arrayPaymentModule = data.split(";");
                                
                                for(var i = 0; i < arrayPaymentModule.length; i++)
                                {
                                    var service = arrayPaymentModule[i].split(",");
                                    selectedPaymentModule = selectedPaymentModule + service[0] + ",";
                                    insertGUI("1",service[0],service[1]);
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
                            $("#msg").html("<p>Error.</p>");
                        }
                    }
                );
            }//Fin de la función getCurrentPaymentMethod
            
            /**
            * Función que nos permite obtener los horarios actuales en la base de datos,
            * para el actual servicio.
            * */
            function getCurrentSchedule()
            {
               var infoData = "option=11&id="+id;
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
                                var arraySchedule = data.split(";");
                                
                                for(var i = 0; i < arraySchedule.length; i++)
                                {
                                    var service = arraySchedule[i].split(",");
                                    selectedSchedule = selectedSchedule + service[0] + ",";
                                    insertGUI("2",service[0],service[1] +": "+getFormatHour(service[2])+' - '+getFormatHour(service[3]));
                                }//Fin del 
                            }
                        },
                        error:function()
                        {
                            $("#msg").html("<p>Error.</p>");
                        }
                    }
                );
            }//Fin de la función getCurrentPaymentMethod
            
            /**
            * Función que nos retorna la fecha invertida.
            * @param {String} date Corresponde a la fecha tal y como está en el campo de texto.
            * @return {String} Corresponde a la fecha pero en order: yyyy-mm-dd
            * */
            function getDateInvert(date)
            {
                var array = date.split("-");
                var answer = array[2]+"-"+array[1]+"-"+array[0];
                return answer;
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
            
            /**
            * Función que nos permite obtener todos los métodos de pago existentes en la base,
            * y los compara con los que ya teníamos ingresados para el actual servicio.
            * */
            function getAllPaymentModule()
            {
                var infoData = "option=6";
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
                                var arrayPaymentModule = data.split(";");
                                var temp = '<option value="0" selected="">Select</option>';
                                
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
                                $("#msg").html("Don't payment method");
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
                    var newRow = ($("#tablePaymentMethod tr").length);
                    var temp = "";

                    if(newRow === 0)
                    {  
                        temp = '<tr id="tr'+newRow+'">'+
                            '<td><input type="text" value="'+name+'" disabled="true" />' +
                            '<input type="hidden" id="txtPaymentModule'+newRow+'" value="'+id+'" /></td>' +
                            '</tr>';
                        $("#tablePaymentMethod").html(temp);
                    }
                    else
                    {
                        var row = $("#tablePaymentMethod tr:last").attr("id");
                        var newRow = parseInt(row.substring(2,row.length)) + 1;
                        temp = '<tr id="tr'+newRow+'">'+
                            '<td><input type="text" value="'+name +'" disabled="true" />' +
                            '<input type="hidden" id="txtPaymentModule'+newRow+'" value="'+id+'" /></td>' +
                            '</tr>';

                        $("#tablePaymentMethod tr:last").after(temp);
                    }//Fin del else

                    var row = $("#tablePaymentMethod tr:last").attr("id");
                    var newRow = row.substring(2,row.length);
                    var buttons = '<input type="button" value="Delete" class="btnDelete" id="btnDelete'+newRow+'" name="btnDelete'+newRow+'" /></td>';
                    $("#tablePaymentMethod tr:last").append(buttons);
                }//Fin del if
                else
                {
                    var newRow = ($("#tableSchedule tr").length);
                    var temp = "";

                    if(newRow === 0)
                    {  
                        temp = '<tr id="trS'+newRow+'">'+
                            '<td><input type="text" style="max-width:250px;" value="'+name +'" disabled="true" />' +
                            '<input type="hidden" id="txtDay'+newRow+'" value="'+id +'" /></td>' +
                            '</tr>';
                        $("#tableSchedule").html(temp);
                    }
                    else
                    {
                        var row = $("#tableSchedule tr:last").attr("id");
                        var newRow = parseInt(row.substring(3,row.length)) + 1;
                        temp = '<tr id="trS'+newRow+'">'+
                            '<td><input type="text" style="max-width:250px;" value="'+name +'" disabled="true" />' +
                            '<input type="hidden" id="txtDay'+newRow+'" value="'+id +'" /></td>' +
                            '</tr>';

                        $("#tableSchedule tr:last").after(temp);
                    }//Fin del else
                    
                    var row = $("#tableSchedule tr:last").attr("id");
                    var newRow = row.substring(3,row.length);
                    var buttons = '<input type="button" value="Delete" class="btnDelete" id="btnDeleteS'+newRow+'" name="btnDeleteS'+newRow+'" /></td>';
                    $("#tableSchedule tr:last").append(buttons);
                }//Fin del else
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
            * Función que nos permite obtener el formato de la hora.
            * @param {String} idHour Corresponde al identificador de la hora en la base de datos.
            * @return {String} Corresponde a la hora pero con formato, ejmp: 7:00am
            * */
            function getFormatHour(idHour)
            {
                var hour = parseInt(idHour) - 1;
                var answer = "";
                
                if(hour > 12)
                {
                    hour = hour-12;
                    answer = hour + ":00 pm";
                }//Fin del if
                else if (hour === 12){answer = hour + ":00 md";}
                else{answer = hour + ":00 am";}
                return answer;
            }//Fin de la función
            
            /**
            * Función que nos permite obtener todos los días existentes en la base.
            * */
            function getAllDay()
            {
                var infoData = "option=7";
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
                                var arrayTemp = data.split(";");
                                var temp = '<option value="0" selected="">Select</option>';
                                
                                for(var i = 0; i < arrayTemp.length; i++)
                                {
                                    var service = arrayTemp[i].split(",");
                                    temp = temp + '<option value="'+service[0]+'">'+service[1]+'</option>';
                                }//Fin del for
                                $("#selDay").html(temp);
                            }
                            else
                            {
                                $("#msg").html("Don't have day's in the database");
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
            * Funcion que nos permite validar fechas
            * @param {String} date Corresponde a la fecha que se desea validar.
            * @return {Boolean} Indicando si es valida o no la fecha.
            * */
            function validateDate(date)
            {
                var datef = date.split("-");
                var day = datef[0];
                var month = datef[1];
                var year = datef[2];
                var date = new Date(year,month,'0');
                if((day-0)>(date.getDate()-0))
                {
                      return false;
                }
                return true;
            }//Funcion que nos permite validar fechas
            
            /**
            * Función que valida los campos.
            * @return {boolean} Indicando si está todo bien o no.
            * */
            function validation()
            {
                var flag = true;
                
                if(($("#txtName").val().length === 0) ||
                    ($("#txtDescription").val().length === 0) ||
                    ($("#txtPrice").val().length === 0) ||
                    ($("#txtQuota").val().length === 0) ||
                    ($("#startDate").val().length === 0) ||
                    ($("#endDate").val().length === 0))
                {
                    flag = false;
                    $("#msg").html("Leave some blank");
                }//Fin del if de campos en blanco
                else
                {
                    if(validateDate($("#startDate").val()) && validateDate($("#endDate").val()))
                    {
                        if(selectedPaymentModule.length === 0)
                        {
                            flag = false;
                            $("#msg").html("Please select at least one method of payment");
                        }
                        else if(selectedSchedule.length === 0)
                        {
                            flag = false;
                            $("#msg").html("Please select at least one schedule");
                        }
                    }//Fin del if
                    else
                    {
                        flag = false;
                        $("#msg").html("One of the dates entered is incorrect");
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
            /***************************** EVENTOS ****************************/
            $("#selDay").change
            (
                function()
                {
                    if($("#selDay").val() !== "0")
                    {
                        var infoData = "option=8&day="+$("#selDay").val();
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
                                        var arrayTemp = data.split(";");
                                        var temp = '<option value="0" selected="">Select</option>';

                                        for(var i = 0; i < arrayTemp.length; i++)
                                        {
                                            var service = arrayTemp[i].split(",");
                                            temp = temp + '<option value="'+service[0]+'">'+getFormatHour(service[1])+' - '+getFormatHour(service[2])+'</option>';
                                        }//Fin del for
                                        $("#selScheduleByDay").html(temp);
                                    }
                                    else
                                    {
                                        $("#msg").html("Don't have schedule in the database");
                                    }
                                },
                                error:function()
                                {
                                    $("#msg").html("<p>Error.</p>");
                                }
                            }
                        );
                    }//Fin del if diferente a "Seleccione
                    else{$("#selScheduleByDay").html("");}
                }//Fin de la función del evento
            );//Fin del evento
            
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

                    var infoData = "option=12&id="+id +
                            "&paymentMethod="+$("#txtPaymentModule"+currentRow).val();
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
                                if(data.toString().length > 0)
                                {
                                    $("#tr"+currentRow).remove();
                                    $("#msg").html("Payment method successfully deleted");
                                }
                                else
                                {
                                    $("#msg").html("Don't have payment method in the database");
                                }
                            },
                            error:function()
                            {
                                $("#msg").html("<p>Error.</p>");
                            }
                        }
                    );
                }//Fin de la función del evento
            );//Fin del evento
            
            //Evento eliminar horarios
            $("#tableSchedule").on
            (
                'click','input.btnDelete', function() 
                {
                    var row = $(this).attr("id");
                    var currentRow = row.substring(10,row.length);
                    
                    selectedSchedule = selectedSchedule.substr(0,selectedSchedule.length-1);
                    var arrayTemp = selectedSchedule.split(",");
                    selectedSchedule = "";
                    
                    for(var i = 0; i < arrayTemp.length; i++)
                    {
                        if(arrayTemp[i] !== $("#txtDay"+currentRow).val())
                        {
                            selectedSchedule = selectedSchedule + arrayTemp[i] + ",";
                        }//Fin del if
                    }//Fin del for
                    
                    var infoData = "option=14&id="+id +
                            "&idSchedule="+$("#txtDay"+currentRow).val();
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
                                if(data.toString().length > 0)
                                {
                                    $("#trS"+currentRow).remove();
                                    $("#msg").html("Schedule successfully deleted");
                                }
                                else
                                {
                                    $("#msg").html("Don't have schedule in the database");
                                }
                            },
                            error:function()
                            {
                                $("#msg").html("<p>Error.</p>");
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
                        $("#msg").html("");
                        insertGUI("1",$("#selPaymentModule").val(),$("#selPaymentModule option:selected").html());
                        selectedPaymentModule = selectedPaymentModule + $("#selPaymentModule").val() + ",";
                        
                        var infoData = "option=13&id="+id +
                                "&paymentMethod="+$("#selPaymentModule").val();
                        hideOptionSelect("1","selPaymentModule",$("#selPaymentModule").val());
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
                                    if(data.toString().length > 0)
                                    {
                                        $("#msg").html("Payment method successfully added");
                                    }
                                    else
                                    {
                                        $("#msg").html("Don't select schedule");
                                    }
                                },
                                error:function()
                                {
                                    $("#msg").html("<p>Error.</p>");
                                }
                            }
                        );
                    }//Fin del if
                    else
                    {
                        $("#msg").html("Please select an option");
                    }//Fin del else
                }//Fin de la función del evento
            );//Fin del evento
            
            //Evento de agregar horarios
            $("#btnAddSchedule").on
            (
                'click',function()
                {   
                    if(($("#selScheduleByDay").val() !== "0") && ($("#selDay").val() !== "0"))
                    {
                        $("#msg").html("");
                        insertGUI("2",$("#selScheduleByDay").val(),$("#selDay option:selected").html() +': '+$("#selScheduleByDay option:selected").html());
                        selectedSchedule = selectedSchedule + $("#selScheduleByDay").val() + ",";
                        
                        var infoData = "option=15&id="+id +
                                "&idSchedule="+$("#selScheduleByDay").val();
                        hideOptionSelect("1","selScheduleByDay",$("#selScheduleByDay").val());
                        
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
                                    if(data.toString().length > 0)
                                    {
                                        $("#msg").html("Schedule successfully added");
                                    }
                                    else
                                    {
                                        $("#msg").html("Don't select schedule");
                                    }
                                },
                                error:function()
                                {
                                    $("#msg").html("<p>Error.</p>");
                                }
                            }
                        );
                    }//Fin del if
                    else
                    {
                        $("#msg").html("Please select a schedule");
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
                        alert(price);
                        var infoData = "option=5"+
                                "&txtID="+id +
                                "&selInstructor="+$("#selInstructor").val() +
                                "&txtName="+$("#txtName").val() +
                                "&txtDescription="+$("#txtDescription").val() +
                                "&txtPrice="+price +
                                "&txtQuota="+$("#txtQuota").val() +
                                "&startDate="+ getDateInvert($("#startDate").val()) +
                                "&endDate="+ getDateInvert($("#endDate").val());
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
            ); //fin del evento actualizar
        }//Fin de la función principal
    );
</script>