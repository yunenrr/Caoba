<?php
include './header.php';
?>
<h2></h2>
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
                    <td><input type="button" value="Guardar" id="btnInsert" name="btnInsert" /></td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div>Campos requeridos(*)</div></td>
</fieldset>
<div id="msg"></div>

<?php include './footer.php' ?>
<script>
    $(document).ready
    (
        function()
        {
            getCurrentNeighborhood();
            /**
             * Función que nos permite insertar una nueva fila a la tabla.
             * @param {String} nameTable Corresponde al nombre de la tabla
             * */
            function insertNewRow(nameTable)
            {
                var newRow = ($("#"+nameTable+" tr").length);
                var temp = "";
                
                if(newRow === 0)
                {  
                    temp = '<tr id="tr'+newRow+'">'+
                        '<td><input type="text" id="txtNeighborhood'+newRow+'" name="txtNeighborhood'+newRow+'" />*<input type="hidden" id="txtID'+newRow+'" name="txtID'+newRow+'" /></td>' +
                        '</tr>';
                    $("#"+nameTable).html(temp);
                }
                else
                {
                    var row = $("#tableBodyNeighborhood tr:last").attr("id");
                    var newRow = parseInt(row.substring(2,row.length)) + 1;
                    temp = '<tr id="tr'+newRow+'">'+
                        '<td><input type="text" id="txtNeighborhood'+newRow+'" name="txtNeighborhood'+newRow+'" />*<input type="hidden" id="txtID'+newRow+'" name="txtID'+newRow+'" /></td>' +
                        '</tr>';
                    $("#"+nameTable+" tr:last").after(temp);
                }//Fin del else
            }//Fin de la función
            
             /**
            * Esta función nos permite poder obtener todos  los registros de inventario 
            * que se encuentra en la base de datos.
            * */
            function getCurrentNeighborhood()
            {
                var infoData = "option=1";
                $.ajax
                (
                    {
                        type: 'POST',
                        url: "../business/AddressBusinessAction.php",
                        data: infoData,
                        beforeSend: function(before)
                        {
                            $("#msg").html("<p>Wait.</p>");
                        },
                        success: function(data)
                        {
                            if(data.toString().length > 0)
                            {
                                var temp = "";
                                var array = data.split(";");
                                
                                for(var i = 0; i < array.length; i++)
                                {
                                    var newRow = i + 1;
                                    var person = array[i].split(",");
                                    
                                    temp = temp + '<tr id="tr'+newRow+'">'+
                                    '<td><input type="text" id="txtNeighborhood'+newRow+'" name="txtNeighborhood'+newRow+'" value="'+person[1]+'"/><input type="hidden" id="txtID'+newRow+'" name="txtID'+newRow+'" value="'+person[0]+'"/>*</td>' +
                                    '<td><input type="button" value="Actualizar" class="btnUpdate" id="btnUpdate'+newRow+'" name="btnUpdate'+newRow+'" />'+
                                    '<input type="button" value="Elimiar" class="btnDelete" id="btnDelete'+newRow+'" name="btnDelete'+newRow+'" /></td>'+
                                    '</tr>';
                                }
                                $("#tableBodyNeighborhood").html(temp);
                                insertNewRow("tableBodyNeighborhood");
                                $("#msg").html("");
                            }
                            else
                            {
                                insertNewRow("tableBodyNeighborhood");
                                $("#msg").html("");
                            }
                        },
                        error:function()
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
                
                if(($("#txtNeighborhood"+positionToValidate).val().length === 0)) 
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
                var infoData = "option=4"+
                                "&txtID="+$("#txtID"+currentRow).val();
                    $.ajax
                    (
                        {
                            type: 'POST',
                            url: "../business/AddressBusinessAction.php",
                            data: infoData,
                            beforeSend: function(before)
                            {
                                $("#msg").html("<p>Wait.</p>");
                            },
                            success: function(data)
                            {
                                if(data.toString() !== "0")
                                {
                                    $("#msg").html("<p>Success delete.</p>");
                                    $("#tr"+currentRow).remove();
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
            }//Fin de la función
            
            /**
            * Esta función nos permite poder actualizar la información de un inventario.
            * @param {int} currentRow Corresponde a la fila que deseamos actualizar.
            * */
            function updateAddress(currentRow)
            {
                if(validation(currentRow))
                {
                    var infoData = "option=3"+
                            "&txtNeighborhood="+$("#txtNeighborhood"+currentRow).val() +
                            "&txtID="+$("#txtID"+currentRow).val();
                    $.ajax
                    (
                        {
                            type: 'POST',
                            url: "../business/AddressBusinessAction.php",
                            data: infoData,
                            beforeSend: function(before)
                            {
                                $("#msg").html("<p>Wait.</p>");
                            },
                            success: function(data)
                            {
                                if(data.toString() !== "0")
                                {
                                    $("#msg").html("<p>Success update.</p>");
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
                }
                else
                {
                    $("#msg").html("<p>Please, check the information.</p>");
                }
            }//Fin de la función
            
            /************************ EVENTOS *******************************/
            $("#btnInsert").on
            (
                'click',function()
                {
                    var row = $("#tableBodyNeighborhood tr:last").attr("id");
                    var newRow = row.substring(2,row.length);
                    
                    if(validation(newRow))
                    {
                        var buttons = '<td><input type="button" value="Update" class="btnUpdate" id="btnUpdate'+newRow+'" name="btnUpdate'+newRow+'" />'+
                            '<input type="button" value="Delete" class="btnDelete" id="btnDelete'+newRow+'" name="btnDelete'+newRow+'" /></td>';
                        $("#tableBodyNeighborhood tr:last").append(buttons);
                        
                        var infoData = "option=2"+
                                "&txtNeighborhood="+$("#txtNeighborhood"+newRow).val();
                        $.ajax
                        (
                            {
                                type: 'POST',
                                url: "../business/AddressBusinessAction.php",
                                data: infoData,
                                beforeSend: function(before)
                                {
                                    $("#msg").html("<p>Wait.</p>");
                                },
                                success: function(data)
                                {
                                    if(data.toString() === "1")
                                    {
                                        $("#msg").html("<p>Success insert.</p>");
                                        $("#txtID"+newRow).val(data);
                                        insertNewRow("tableBodyNeighborhood");
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
                    }//
                    else{$("#msg").html("<p>Please, check the information.</p>");}
                }
            );
            $("#tableBodyNeighborhood").on
            (
                'click','input.btnUpdate', function() 
                {
                    var row = $(this).attr("id");
                    var currentRow = row.substring(9,row.length);
                    updateAddress(currentRow);
                }
            );
            $("#tableBodyNeighborhood").on
                    (
                        'click','input.btnDelete', function() 
                        {
                            var row = $(this).attr("id");
                            var currentRow = row.substring(9,row.length);
                            deleteAddress(currentRow);
                        }
                    );
        }//Fin de la función principal
    );
</script>
