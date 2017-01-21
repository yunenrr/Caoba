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
                            }
                            else
                            {
                                $("#msg").html("Don't have instructor");
                            }
//                            getAllService();
                              //$("#temp").html(getSelInstructor(0,0));
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
            function getSelInstructor(id,currentRow)
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
        }//Fin de la función principal
    );
</script>