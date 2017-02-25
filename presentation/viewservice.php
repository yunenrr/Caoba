<?php include './header.php' ?>
<div>
    <h2>Todos los servicios</h2>
    <div>
        <label>Ver por estado:</label>
        <select id="selState" name="selState">
            <option value="0">Todos</option>
            <option value="1">Activos</option>
            <option value="2">Inactivos</option>
        </select>
    </div>
    <fieldset>
        <legend>Información básica:</legend>
        <table>
            <thead>
                <tr>
                    <th>Nombre:</th>
                    <th>Estado:</th>
                    <th>Actualizar información:</th>
                    <th>Renovar/Cancelar servicio:</th>
                </tr>
            </thead>
            <tbody id="tableBodyService"></tbody>
        </table>
    </fieldset>
    <div id="msg"></div>
</div>
<script src="../js/jsMessage.js" type="text/javascript"></script>
<?php include './footer.php' ?>
<script type="text/javascript">
    $(document).ready
    (
        function()
        {
            getAllService();
            /****************************** Funciones ************************************/
            /**
             * Función que nos permite obtener todos los servicios
             * */
            function getAllService()
            {
                var infoData = "option=1";
                
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
                                $("#msg").html("");
                                getServiceByState(data);
                            }
                            else
                            {
                                $("#msg").html("No existen servicios en la base de datos.");
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
            * Función que llena la tabla con base en la opción seleccionada en el select.
            * @param {String} data Array que contiene la información de los servicios.
            * */
            function getServiceByState(data)
            {
                var currentValue = $("#selState").val();
                
                var temp = "";
                var array = data.split(";");
                
                //Obtenemos todos
                if(currentValue === "0")
                {
                    for(var i = 0; i < array.length; i++)
                    {
                        var newRow = i + 1;
                        var service = array[i].split(",");

                        temp = temp + '<tr id="tr'+newRow+'">';
                        temp = temp + '<td><input type="text" id="txtName'+newRow+'" name="txtName'+newRow+'" value="'+service[1]+'" disabled=""/><input type="hidden" id="txtID'+newRow+'" name="txtID'+newRow+'" value="'+service[0]+'"/></td>' +
                        '<td><input type="text" id="txtState'+newRow+'" name="txtState'+newRow+'" value="'+((parseInt(service[2]) > 0) ? "Active" : "Inactive")+'" disabled=""/></td>' +
                        '<td><input type="button" value="Actualizar" class="btnUpdate" id="btnUpdate'+newRow+'" name="btnUpdate'+newRow+'" />'+
                        ((parseInt(service[2]) > 0) ? '<td><input type="button" value="Cancelar" class="btnCancel" id="btnCancel'+newRow+'" name="btnCancel'+newRow+'" />':'<td><input type="button" value="Renovar" class="btnRenew" id="btnRenew'+newRow+'" name="btnRenew'+newRow+'" />')+
                        '</tr>';
                    }//Fin del for
                }//Fin del if
                else if(currentValue === "1") //Obtenemos los activos
                {
                    for(var i = 0; i < array.length; i++)
                    {
                        var newRow = i + 1;
                        var service = array[i].split(",");
                        
                        if(parseInt(service[2]) > 0)
                        {
                            temp = temp + '<tr id="tr'+newRow+'">';
                            temp = temp + '<td><input type="text" id="txtName'+newRow+'" name="txtName'+newRow+'" value="'+service[1]+'" disabled=""/><input type="hidden" id="txtID'+newRow+'" name="txtID'+newRow+'" value="'+service[0]+'"/></td>' +
                            '<td><input type="text" id="txtState'+newRow+'" name="txtState'+newRow+'" value="Active" disabled=""/></td>' +
                            '<td><input type="button" value="Actualizar" class="btnUpdate" id="btnUpdate'+newRow+'" name="btnUpdate'+newRow+'" />'+
                            '<td><input type="button" value="Cancelar" class="btnCancel" id="btnCancel'+newRow+'" name="btnCancel'+newRow+'" />'+
                            '</tr>';
                        }//Fin del if
                    }//Fin del for
                }//Fin del else if
                else
                {
                    for(var i = 0; i < array.length; i++)
                    {
                        var newRow = i + 1;
                        var service = array[i].split(",");
                        
                        if(parseInt(service[2]) < 0)
                        {
                            temp = temp + '<tr id="tr'+newRow+'">';
                            temp = temp + '<td><input type="text" id="txtName'+newRow+'" name="txtName'+newRow+'" value="'+service[1]+'" disabled=""/><input type="hidden" id="txtID'+newRow+'" name="txtID'+newRow+'" value="'+service[0]+'"/></td>' +
                            '<td><input type="text" id="txtState'+newRow+'" name="txtState'+newRow+'" value="Inactive" disabled=""/></td>' +
                            '<td><input type="button" value="Actualizar" class="btnUpdate" id="btnUpdate'+newRow+'" name="btnUpdate'+newRow+'" />'+
                            '<td><input type="button" value="Renovar" class="btnRenew" id="btnRenew'+newRow+'" name="btnRenew'+newRow+'" />' +
                            '</tr>';
                        }//Fin del if
                    }//Fin del for
                }//Fin del else
                
                $("#tableBodyService").html(temp);
                $("#msg").html("");
            }//Fin de la función
            
            /****************************** Eventos ************************************/
            $("#tableBodyService").on
            (
                'click','input.btnUpdate', function() 
                {
                    var row = $(this).attr("id");
                    var currentRow = row.substring(9,row.length);
                    document.location.href = "updateservice.php?id="+$("#txtID"+currentRow).val();
                }//Fin de la función
            );//Fin del evento
    
            $("#tableBodyService").on
            (
                'click','input.btnRenew', function() 
                {
                    var row = $(this).attr("id");
                    var currentRow = row.substring(8,row.length);
                    document.location.href = "renewservice.php?id="+$("#txtID"+currentRow).val();
                }//Fin de la función
            );//Fin del evento
            
            $("#tableBodyService").on
            (
                'click','input.btnCancel', function() 
                {
                    var row = $(this).attr("id");
                    var currentRow = row.substring(9,row.length);
                    document.location.href = "cancelservice.php?id="+$("#txtID"+currentRow).val();
                }//Fin de la función
            );//Fin del evento
    
            $("#selState").change
            (
                function()
                {
                    getAllService();
                }//Fin de la función del evento del select
            );//Fin del evento del select
        }//Fin de la función principal
    );//Fin del evento ready
</script>