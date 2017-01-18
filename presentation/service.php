<?php include './header.php' ?>
<div>
    <table>
        <thead>
            <tr>
                <th>Instructor</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quota</th>
                <th>Update/Delete</th>
            </tr>
        </thead>
        <tbody id="tableBodyService">
        </tbody>
        <tfoot>
            <tr>
                <td><input type="button" value="Insert" id="btnInsert" name="btnInsert" /></td>
            </tr>
        </tfoot>
    </table>
    <div id="msg"></div>
</div>
<?php include './footer.php' ?>
<script type="text/javascript">
    $(document).ready
    (
        function()
        {
            var arrayAllInstructor = "";
            getAllInstructor();
            /****************************** Eventos ************************************/
            $("#btnInsert").on
            (
                'click',function()
                {
                    var row = $("#tableBodyService tr:last").attr("id");
                    var newRow = row.substring(2,row.length);
                    if(validation(newRow))
                    {
                        var buttons = '<td><input type="button" value="Update" class="btnUpdate" id="btnUpdate'+newRow+'" name="btnUpdate'+newRow+'" />'+
                            '<input type="button" value="Delete" class="btnDelete" id="btnDelete'+newRow+'" name="btnDelete'+newRow+'" /></td>';
                        $("#tableBodyService tr:last").append(buttons);
                        
                        var infoData = "option=3"+
                                "&selInstructor="+$("#selInstructor"+newRow).val() +
                                "&txtName="+$("#txtName"+newRow).val() +
                                "&txtDescription="+$("#txtDescription"+newRow).val() +
                                "&txtPrice="+$("#txtPrice"+newRow).val() +
                                "&txtQuota="+$("#txtQuota"+newRow).val();
                        
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
                                        $("#txtID"+newRow).val(data);
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
                        
                        insertNewRow("tableBodyService");
                    }//Fin del if de validaciones
                    else{$("#msg").html("<p>Please, check the information.</p>");}
                }
            );
    
            $(".btnUpdate").on
            (
                'click',function()
                {
                    var row = $(this).attr("id");
                    var currentRow = row.substring(9,row.length);
                    updateService(currentRow);
                }
            );
    
            $(".btnDelete").on
            (
                'click',function()
                {
                    var row = $(this).attr("id");
                    var currentRow = row.substring(9,row.length);
                    deleteService(currentRow);
                }
            );
    
            $("#tableBodyService").on
            (
                'click','input.btnUpdate', function() 
                {
                    var row = $(this).attr("id");
                    var currentRow = row.substring(9,row.length);
                    updateService(currentRow);
                }
            );
            
            $("#tableBodyService").on
            (
                'click','input.btnDelete', function() 
                {
                    var row = $(this).attr("id");
                    var currentRow = row.substring(9,row.length);
                    deleteService(currentRow);
                }
            );
    
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
                                    var service = array[i].split(",");
                                    
                                    temp = temp + '<tr id="tr'+newRow+'">';
                                    temp = temp + '<td>' + getSelInstructor(service[1],newRow) + '</td>';
                                    temp = temp + '<td><input type="text" id="txtName'+newRow+'" name="txtName'+newRow+'" value="'+service[2]+'"/><input type="hidden" id="txtID'+newRow+'" name="txtID'+newRow+'" value="'+service[0]+'"/></td>' +
                                    '<td><input type="text" id="txtDescription'+newRow+'" name="txtDescription'+newRow+'" value="'+service[3]+'"/></td>' +
                                    '<td><input type="number" id="txtPrice'+newRow+'" name="txtPrice'+newRow+'" value="'+service[4]+'"/></td>'+
                                    '<td><input type="number" id="txtQuota'+newRow+'" name="txtQuota'+newRow+'" value="'+service[5]+'" /></td>'+
                                    '<td><input type="button" value="Update" class="btnUpdate" id="btnUpdate'+newRow+'" name="btnUpdate'+newRow+'" />'+
                                    '<input type="button" value="Delete" class="btnDelete" id="btnDelete'+newRow+'" name="btnDelete'+newRow+'" /></td>'+
                                    '</tr>';
                                }
                                $("#tableBodyService").html(temp);
                                insertNewRow("tableBodyService");
                                $("#msg").html("");
                            }
                            else
                            {
                                insertNewRow("tableBodyService");
                                $("#msg").html("");
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
            * Función que nos permite obtener todos los instructores de la base de datos.
            * */
            function getAllInstructor()
            {
                var infoData = "option=2";
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
                                arrayAllInstructor = data.split(";");
                            }
                            else
                            {
                                $("#msg").html("Don't have instructor");
                            }
                            getAllService();
                        },
                        error:function()
                        {
                            $("#msg").html("<p>Error.</p>");
                        }
                    }
                );
            }//Fin del if
            
            /**
            * Función que nos permite obtener el select de instructores.
            * @param {int} id Corresponde al id del instructor actual.
            * @param {int} currentRow Corresponde a la posición en la tabla.
            * */
            function getSelInstructor(id,currentRow)
            {
                var temp = '<select id="selInstructor'+currentRow+'" name="selInstructor'+currentRow+'">';
                
                for(var i = 0; i < arrayAllInstructor.length; i++)
                {
                    var service = arrayAllInstructor[i].split(",");
                    
                    if(service[0] === id)
                    {
                        temp = temp + '<option value="'+service[0]+'" selected="">'+service[1]+'</option>';
                    }
                    else
                    {
                        temp = temp + '<option value="'+service[0]+'">'+service[1]+'</option>';
                    }
                }//Fin del for
                return temp;
            }//Fin de la función
            
            /**
             * Función que nos permite insertar una nueva fila a la tabla.
             * @param {String} nameTable Corresponde al nombre de la tabla
             * */
            function insertNewRow(nameTable)
            {
                var newRow = ($("#"+nameTable+" tr").length);
                
                if(newRow === 0)
                {
                    $("#"+nameTable).html
                    (
                        '<tr id="tr'+newRow+'">'+
                        '<td>' + getSelInstructor(0,newRow) + '</td>' +
                        '<td><input type="text" id="txtName'+newRow+'" name="txtName'+newRow+'" /><input type="hidden" id="txtID'+newRow+'" name="txtID'+newRow+'"/></td>' +
                        '<td><input type="text" id="txtDescription'+newRow+'" name="txtDescription'+newRow+'"/></td>' +
                        '<td><input type="number" id="txtPrice'+newRow+'" name="txtPrice'+newRow+'" /></td>'+
                        '<td><input type="number" id="txtQuota'+newRow+'" name="txtQuota'+newRow+'" /></td>'+
                        '</tr>'
                    );
                }
                else
                {
                    var row = $("#tableBodyService tr:last").attr("id");
                    var newRow = parseInt(row.substring(2,row.length)) + 1;
                    $("#"+nameTable+" tr:last").after
                    (
                        '<tr id="tr'+newRow+'">'+
                        '<td>' + getSelInstructor(0,newRow) + '</td>' +
                        '<td><input type="text" id="txtName'+newRow+'" name="txtName'+newRow+'" /><input type="hidden" id="txtID'+newRow+'" name="txtID'+newRow+'"/></td>' +
                        '<td><input type="text" id="txtDescription'+newRow+'" name="txtDescription'+newRow+'"/></td>' +
                        '<td><input type="number" id="txtPrice'+newRow+'" name="txtPrice'+newRow+'" /></td>'+
                        '<td><input type="number" id="txtQuota'+newRow+'" name="txtQuota'+newRow+'" /></td>'+
                        '</tr>'
                    );
                }
            }//Fin de la función
            
            /**
            * Función que valida los campos.
            * @param {String} positionToValidate Corresponde a la posición en la tabla.
            * @return {boolean} Indicando si está todo bien o no.
            * */
            function validation(positionToValidate)
            {
                var flag = true;
                
                if(($("#txtName"+positionToValidate).val().length === 0) ||
                    ($("#txtDescription"+positionToValidate).val().length === 0) ||
                    ($("#txtPrice"+positionToValidate).val().length === 0) ||
                    ($("#txtQuota"+positionToValidate).val().length === 0))
                {
                    flag = false;
                }
                
                return flag;
            }//Fin de la función
            
            /**
            * Función que nos permite eliminar servicios.
            * @param {int} currentRow Corresponde a la fila que deseamos eliminar
            * */
            function deleteService(currentRow)
            {   
                var infoData = "option=4"+
                        "&txtID="+$("#txtID"+currentRow).val();
                        
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
            * Funcion que nos permite actualizar la informacion de un instructor.
            * @param {int} currentRow Corresponde a la fila que deseamos actualizar.
            * */
            function updateService(currentRow)
            {
                if(validation(currentRow))
                {
                    var infoData = "option=5"+
                            "&txtID="+$("#txtID"+currentRow).val() +
                            "&selInstructor="+$("#selInstructor"+currentRow).val() +
                            "&txtName="+$("#txtName"+currentRow).val() +
                            "&txtDescription="+$("#txtDescription"+currentRow).val() +
                            "&txtPrice="+$("#txtPrice"+currentRow).val() +
                            "&txtQuota="+$("#txtQuota"+currentRow).val();
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
                }
                else
                {
                    $("#msg").html("<p>Please, check the information.</p>");
                }
            }//Fin de la función
        }//Fin de la función principal
    );///Fin del $(document).ready
</script>