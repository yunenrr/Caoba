<?php include './header.php' ?>
<div>
    <table>
        <thead>
            <tr>
                <th>Identifier</th>
                <th>Name</th>
                <th>First Surname</th>
                <th>Second Surname</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone Reference</th>
                <th>Blood Type</th>
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
            var arrayAllGender = "";
            getAllGender();
            
            
            
            /************************ FUNCIONES *******************************/
            /**
             * Funciób que nos permite obtener todos los géneros existentes en la base para almacenarlos en un array.
             * @return {Array} Corresponde a un arreglo con los géneros.
             * */
            function getAllGender()
            {
                var infoData = "option=5";
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
                                arrayAllGender = data.split(";");
                                getCurrentInstructor();
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
            * Función que nos permite obtener el select de los géneros
            * @param {int} id Corresponde al id del género actual.
            * @param {int} currentRow Corresponde a la posición en la tabla.
            * */
            function getSelGender(id,currentRow)
            {
                var temp = '<select id="selGender'+currentRow+'" name="selGender'+currentRow+'">';
                
                for(var i = 0; i < arrayAllGender.length; i++)
                {
                    var service = arrayAllGender[i].split(",");
                    
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
                                    temp = temp + '<td>' + getSelGender(person[6],newRow) + '</td>';
                                    temp = temp +'<td><input type="email" id="txtEmail'+newRow+'" name="txtEmail'+newRow+'" value="'+person[7]+'"/></td>'+
                                    '<td><input type="text" id="txtAddress'+newRow+'" name="txtAddress'+newRow+'" value="'+person[8]+'"/></td>'+
                                    '<td><input type="number" id="txtPhoneReference'+newRow+'" name="txtPhoneReference'+newRow+'" value="'+person[9]+'"/></td>'+
                                    '<td><input type="text" id="txtBloodType'+newRow+'" name="txtBloodType'+newRow+'" value="'+person[10]+'"/></td>'+
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
            }//Fin de la función getCurrentInstructor
            
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
                        '<td><input type="text" id="txtDNI'+newRow+'" name="txtDNI'+newRow+'" /><input type="hidden" id="txtID'+newRow+'" name="txtID'+newRow+'" /></td>' +
                        '<td><input type="text" id="txtName'+newRow+'" name="txtName'+newRow+'" /></td>' +
                        '<td><input type="text" id="txtFirstSurname'+newRow+'" name="txtFirstSurname'+newRow+'" /></td>' +
                        '<td><input type="text" id="txtSecondSurname'+newRow+'" name="txtSecondSurname'+newRow+'" /></td>'+
                        '<td><input type="number" id="txtAge'+newRow+'" name="txtAge'+newRow+'" /></td>';
                        temp = temp + '<td>' + getSelGender(0,newRow) + '</td>';
                        temp = temp + '<td><input type="email" id="txtEmail'+newRow+'" name="txtEmail'+newRow+'" /></td>'+
                        '<td><input type="text" id="txtAddress'+newRow+'" name="txtAddress'+newRow+'" /></td>'+
                        '<td><input type="number" id="txtPhoneReference'+newRow+'" name="txtPhoneReference'+newRow+'"/></td>'+
                        '<td><input type="text" id="txtBloodType'+newRow+'" name="txtBloodType'+newRow+'" /></td>'+
                        '</tr>';
                    $("#"+nameTable).html(temp);
                }
                else
                {
                    var row = $("#tableBodyInstructor tr:last").attr("id");
                    var newRow = parseInt(row.substring(2,row.length)) + 1;
                    temp = '<tr id="tr'+newRow+'">'+
                        '<td><input type="text" id="txtDNI'+newRow+'" name="txtDNI'+newRow+'" /><input type="hidden" id="txtID'+newRow+'" name="txtID'+newRow+'" /></td>' +
                        '<td><input type="text" id="txtName'+newRow+'" name="txtName'+newRow+'" /></td>' +
                        '<td><input type="text" id="txtFirstSurname'+newRow+'" name="txtFirstSurname'+newRow+'" /></td>' +
                        '<td><input type="text" id="txtSecondSurname'+newRow+'" name="txtSecondSurname'+newRow+'" /></td>'+
                        '<td><input type="number" id="txtAge'+newRow+'" name="txtAge'+newRow+'" /></td>';
                        temp = temp + '<td>' + getSelGender(0,newRow) + '</td>';
                        temp = temp + '<td><input type="email" id="txtEmail'+newRow+'" name="txtEmail'+newRow+'" /></td>'+
                        '<td><input type="text" id="txtAddress'+newRow+'" name="txtAddress'+newRow+'" /></td>'+
                        '<td><input type="number" id="txtPhoneReference'+newRow+'" name="txtPhoneReference'+newRow+'"/></td>'+
                        '<td><input type="text" id="txtBloodType'+newRow+'" name="txtBloodType'+newRow+'" /></td>'+
                        '</tr>';
                    
                    $("#"+nameTable+" tr:last").after(temp);
                }//Fin del else
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
                    ($("#txtAddress"+positionToValidate).val().length === 0) ||
                    ($("#txtPhoneReference"+positionToValidate).val().length === 0) ||
                    ($("#txtBloodType"+positionToValidate).val().length === 0))
                {
                    flag = false;
                }
                
                return flag;
            }//Fin de la función
            
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
                            "&txtID="+$("#txtID"+currentRow).val()+
                            "&txtPhoneReference="+$("#txtPhoneReference"+currentRow).val()+
                            "&txtBloodType="+$("#txtBloodType"+currentRow).val();
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
            
            /************************ EVENTOS *******************************/
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
                                "&selGender="+$("#selGender"+newRow).val()+
                                "&txtPhoneReference="+$("#txtPhoneReference"+newRow).val()+
                                "&txtBloodType="+$("#txtBloodType"+newRow).val();
                        
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
        }//Fin de la función principal
    );
</script>