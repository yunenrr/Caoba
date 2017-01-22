<?php include './header.php' ?>
<div>
    <h2>All Service</h2>
    <fieldset>
        <legend>Basic Information</legend>
        <table>
            <thead>
                <tr>
                    <th>Name:</th>
                    <th>Update/Delete</th>
                </tr>
            </thead>
            <tbody id="tableBodyService"></tbody>
        </table>
    </fieldset>
    <div id="msg"></div>
</div>
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
                                    temp = temp + '<td><input type="text" id="txtName'+newRow+'" name="txtName'+newRow+'" value="'+service[2]+'" disabled=""/><input type="hidden" id="txtID'+newRow+'" name="txtID'+newRow+'" value="'+service[0]+'"/></td>' +
                                    '<td><input type="button" value="Update" class="btnUpdate" id="btnUpdate'+newRow+'" name="btnUpdate'+newRow+'" />'+
                                    '<input type="button" value="Delete" class="btnDelete" id="btnDelete'+newRow+'" name="btnDelete'+newRow+'" /></td>'+
                                    '</tr>';
                                }
                                $("#tableBodyService").html(temp);
                                $("#msg").html("");
                            }
                            else
                            {
                                $("#msg").html("Don't have service");
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
            
            /****************************** Eventos ************************************/
            $("#tableBodyService").on
            (
                'click','input.btnDelete', function() 
                {
                    var row = $(this).attr("id");
                    var currentRow = row.substring(9,row.length);
                    deleteService(currentRow);
                }//Fin de la función
            );//Fin del evento
            
            $("#tableBodyService").on
            (
                'click','input.btnUpdate', function() 
                {
                    var row = $(this).attr("id");
                    var currentRow = row.substring(9,row.length);
                    document.location.href = "UpdateService.php?id="+$("#txtID"+currentRow).val();
                }//Fin de la función
            );//Fin del evento
        }//Fin de la función principal
    );//Fin del evento ready
</script>