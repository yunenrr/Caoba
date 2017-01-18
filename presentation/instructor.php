<?php include './header.php' ?>
<div>
    <table>
        <thead>
            <tr>
                <th>DNI</th>
                <th>Name</th>
                <th>First Surname</th>
                <th>Second Surname</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Address</th>
                <th>Update/Delete</th>
            </tr>
        </thead>
        <tbody id="tableBodyInstructor">
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
<script>
    $(document).ready
    (
        function()
        {
            getCurrentInstructor();
            
            $("#btnInsert").on
            (
                'click',function()
                {
                    var row = $("#tableBodyInstructor tr:last").attr("id");
                    var newRow = row.substring(2,row.length);
                    
                    if(validation(newRow))
                    {
                        var buttons = '<td><input type="button" value="Update" class="btnUpdate" id="btnUpdate'+newRow+'" name="btnUpdate'+newRow+'" />'+
                            '<input type="button" value="Delete" class="btnDelete" id="btnDelete'+newRow+'" name="btnDelete'+newRow+'" /></td>';
                        $("#tableBodyInstructor tr:last").append(buttons);
                        
                        var infoData = "option=1"+
                                "&txtDNI="+$("#txtDNI"+newRow).val() +
                                "&txtName="+$("#txtName"+newRow).val() +
                                "&txtFirstSurname="+$("#txtFirstSurname"+newRow).val() +
                                "&txtSecondSurname="+$("#txtSecondSurname"+newRow).val() +
                                "&txtAge="+$("#txtAge"+newRow).val() +
                                "&txtEmail="+$("#txtEmail"+newRow).val() +
                                "&txtAddress="+$("#txtAddress"+newRow).val()+
                                "&selGender="+$("#selGender"+newRow).val();
                        
                        $.ajax
                        (
                            {
                                type: 'POST',
                                url: "../business/InstructorBusiness.php",
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
                        
                        insertNewRow("tableBodyInstructor");
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
                    updateInstructor(currentRow);
                }
            );
    
            $(".btnDelete").on
            (
                'click',function()
                {
                    var row = $(this).attr("id");
                    var currentRow = row.substring(9,row.length);
                    deleteInstructor(currentRow);
                }
            );
    
            $("#tableBodyInstructor").on
            (
                'click','input.btnUpdate', function() 
                {
                    var row = $(this).attr("id");
                    var currentRow = row.substring(9,row.length);
                    updateInstructor(currentRow);
                }
            );
            
            $("#tableBodyInstructor").on
            (
                'click','input.btnDelete', function() 
                {
                    var row = $(this).attr("id");
                    var currentRow = row.substring(9,row.length);
                    deleteInstructor(currentRow);
                }
            );
            
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
                        '<td><input type="text" id="txtDNI'+newRow+'" name="txtDNI'+newRow+'" /><input type="hidden" id="txtID'+newRow+'" name="txtID'+newRow+'" /></td>' +
                        '<td><input type="text" id="txtName'+newRow+'" name="txtName'+newRow+'" /></td>' +
                        '<td><input type="text" id="txtFirstSurname'+newRow+'" name="txtFirstSurname'+newRow+'" /></td>' +
                        '<td><input type="text" id="txtSecondSurname'+newRow+'" name="txtSecondSurname'+newRow+'" /></td>'+
                        '<td><input type="number" id="txtAge'+newRow+'" name="txtAge'+newRow+'" /></td>'+
                        '<td><select id="selGender'+newRow+'" name="selGender'+newRow+'"><option value="M">M</option><option value="F">F</option></select></td>'+
                        '<td><input type="email" id="txtEmail'+newRow+'" name="txtEmail'+newRow+'" /></td>'+
                        '<td><input type="text" id="txtAddress'+newRow+'" name="txtAddress'+newRow+'" /></td>'+
                        '</tr>'
                    );
                }
                else
                {
                    var row = $("#tableBodyInstructor tr:last").attr("id");
                    var newRow = parseInt(row.substring(2,row.length)) + 1;
                    $("#"+nameTable+" tr:last").after
                    (
                        '<tr id="tr'+newRow+'">'+
                        '<td><input type="text" id="txtDNI'+newRow+'" name="txtDNI'+newRow+'" /><input type="hidden" id="txtID'+newRow+'" name="txtID'+newRow+'" /></td>' +
                        '<td><input type="text" id="txtName'+newRow+'" name="txtName'+newRow+'" /></td>' +
                        '<td><input type="text" id="txtFirstSurname'+newRow+'" name="txtFirstSurname'+newRow+'" /></td>' +
                        '<td><input type="text" id="txtSecondSurname'+newRow+'" name="txtSecondSurname'+newRow+'" /></td>'+
                        '<td><input type="number" id="txtAge'+newRow+'" name="txtAge'+newRow+'" /></td>'+
                        '<td><select id="selGender'+newRow+'" name="selGender'+newRow+'"><option value="M">M</option><option value="F">F</option></select></td>'+
                        '<td><input type="email" id="txtEmail'+newRow+'" name="txtEmail'+newRow+'" /></td>'+
                        '<td><input type="text" id="txtAddress'+newRow+'" name="txtAddress'+newRow+'" /></td>'+
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
                
                if(($("#txtDNI"+positionToValidate).val().length === 0) ||
                    ($("#txtName"+positionToValidate).val().length === 0) ||
                    ($("#txtFirstSurname"+positionToValidate).val().length === 0) ||
                    ($("#txtSecondSurname"+positionToValidate).val().length === 0) ||
                    ($("#txtAge"+positionToValidate).val().length === 0) ||
                    ($("#txtEmail"+positionToValidate).val().length === 0) ||
                    ($("#txtAddress"+positionToValidate).val().length === 0))
                {
                    flag = false;
                }
                
                return flag;
            }//Fin de la función
            
            /**
            * Función que nos permite obtener los instructores actuales en la base de datos.
            * */
            function getCurrentInstructor()
            {
                var infoData = "option=2";
                $.ajax
                (
                    {
                        type: 'POST',
                        url: "../business/InstructorBusiness.php",
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
                                    '<td><input type="text" id="txtDNI'+newRow+'" name="txtDNI'+newRow+'" value="'+person[1]+'"/><input type="hidden" id="txtID'+newRow+'" name="txtID'+newRow+'" value="'+person[0]+'"/></td>' +
                                    '<td><input type="text" id="txtName'+newRow+'" name="txtName'+newRow+'" value="'+person[2]+'"/></td>' +
                                    '<td><input type="text" id="txtFirstSurname'+newRow+'" name="txtFirstSurname'+newRow+'" value="'+person[3]+'"/></td>' +
                                    '<td><input type="text" id="txtSecondSurname'+newRow+'" name="txtSecondSurname'+newRow+'" value="'+person[4]+'"/></td>'+
                                    '<td><input type="number" id="txtAge'+newRow+'" name="txtAge'+newRow+'" value="'+person[5]+'" /></td>';
                                    
                                    if(person[6] === "0")
                                    {temp = temp + '<td><select id="selGender'+newRow+'" name="selGender'+newRow+'"><option value="M">M</option><option value="F" selected="true">F</option></select></td>';}
                                    else{temp = temp + '<td><select id="selGender'+newRow+'" name="selGender'+newRow+'" value="'+person[6]+'"><option value="M" selected="true">M</option><option value="F">F</option></select></td>';}
                                    
                                    temp = temp +'<td><input type="email" id="txtEmail'+newRow+'" name="txtEmail'+newRow+'" value="'+person[7]+'"/></td>'+
                                    '<td><input type="text" id="txtAddress'+newRow+'" name="txtAddress'+newRow+'" value="'+person[8]+'"/></td>'+
                                    '<td><input type="button" value="Update" class="btnUpdate" id="btnUpdate'+newRow+'" name="btnUpdate'+newRow+'" />'+
                                    '<input type="button" value="Delete" class="btnDelete" id="btnDelete'+newRow+'" name="btnDelete'+newRow+'" /></td>'+
                                    '</tr>';
                                }
                                $("#tableBodyInstructor").html(temp);
                                insertNewRow("tableBodyInstructor");
                                $("#msg").html("");
                            }
                            else
                            {
                                insertNewRow("tableBodyInstructor");
                                $("#msg").html("");
                            }
                        },
                        error:function()
                        {
                            $("#msg").html("<p>Error.</p>");
                        }
                    }
                );
            };
            
            /**
            * Función que nos permite eliminar instructores.
            * @param {int} currentRow Corresponde a la fila que deseamos eliminar
            * */
            function deleteInstructor(currentRow)
            {   
                var infoData = "option=3"+
                        "&txtID="+$("#txtID"+currentRow).val();
                        
                $.ajax
                (
                    {
                        type: 'POST',
                        url: "../business/InstructorBusiness.php",
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
            function updateInstructor(currentRow)
            {
                if(validation(currentRow))
                {
                    var infoData = "option=4"+
                            "&txtDNI="+$("#txtDNI"+currentRow).val() +
                            "&txtName="+$("#txtName"+currentRow).val() +
                            "&txtFirstSurname="+$("#txtFirstSurname"+currentRow).val() +
                            "&txtSecondSurname="+$("#txtSecondSurname"+currentRow).val() +
                            "&txtAge="+$("#txtAge"+currentRow).val() +
                            "&txtEmail="+$("#txtEmail"+currentRow).val() +
                            "&txtAddress="+$("#txtAddress"+currentRow).val()+
                            "&selGender="+$("#selGender"+currentRow).val()+
                            "&txtID="+$("#txtID"+currentRow).val();
                    $.ajax
                    (
                        {
                            type: 'POST',
                            url: "../business/InstructorBusiness.php",
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
        }
    );
</script>