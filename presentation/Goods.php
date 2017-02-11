<?php 
include './header.php';
include '../business/InventoryBusiness.php';

session_start();
if (!isset($_SESSION['id'])) {
    header("location: ./Home.php");
}
$inventoryBusiness= new InventoryBusiness();
$active= $inventoryBusiness->getAllInventory();
?>

<h2>Equipment</h2>
<fieldset>
    <legend>New Equipment</legend>
<div>
    <table>
        <thead>
            <tr>
                <th>Code active</th>
                <th>Name active</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Date registration</th>
                <th>Location</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody id="tableBodyInventory"> 
        </tbody>
        <tfoot>
            <tr><td><div>Required fields(*)</div></td></tr>
            <tr>
                <td><input type="button" value="Insert" id="btnInsert" name="btnInsert" /></td>
            </tr>
        </tfoot>
    </table>
    <div id="msg"></div>
</fieldset><br><br>

<h2>Delete equipment</h2>
<div>
        <table>
             <thead>
            <tr>
                <th>Code active</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody id="tableBodyActive">
            <td><select id="selActive" name="selActive" > 
                        <?php foreach ($active as $value) { 
                            if($value->getQuantityInventory()>0){?>
                            <option value="<?php echo $value->getIdInventory(); ?>"><?php echo $value->getCodeActiveInventory(); ?></option> 
                        <?php }} ?>
                </select></td>
                <td><input id="deleteQuantity" name="deleteQuantity"  type="number" min="1" required=""/>*</td>
                <td><input type="button" value="Delete" id="btnDelete" name="btnDelete" onclick="delete()"/></td>
        </tbody>
        </table>
    <div id="msgDelete"></div>
</div>

<?php include './footer.php' ?>
<script>
    $(document).ready
    (
        function()
        {
            getCurrentInventory();
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
                        '<td><input type="text" id="txtCode'+newRow+'" name="txtCode'+newRow+'" />*<input type="hidden" id="txtID'+newRow+'" name="txtID'+newRow+'" /></td>' +
                        '<td><input type="text" id="txtName'+newRow+'" name="txtName'+newRow+'" />*</td>' +
                        '<td><input type="number" id="txtQuantity'+newRow+'" name="txtQuantity'+newRow+'" />*</td>' +
                        '<td><input type="text" id="txtPrice'+newRow+'" name="txtPrice'+newRow+'" />*</td>'+
                        '<td><input type="date" id="txtDate'+newRow+'" name="txtDate'+newRow+'" />*</td>'+
                        '<td><input type="text" id="txtLocation'+newRow+'" name="txtLocation'+newRow+'"/>*</td>'+
                        '</tr>';
                    $("#"+nameTable).html(temp);
                }
                else
                {
                    var row = $("#tableBodyInventory tr:last").attr("id");
                    var newRow = parseInt(row.substring(2,row.length)) + 1;
                    temp = '<tr id="tr'+newRow+'">'+
                        '<td><input type="text" id="txtCode'+newRow+'" name="txtCode'+newRow+'" />*<input type="hidden" id="txtID'+newRow+'" name="txtID'+newRow+'" /></td>' +
                        '<td><input type="text" id="txtName'+newRow+'" name="txtName'+newRow+'" />*</td>' +
                        '<td><input type="number" id="txtQuantity'+newRow+'" name="txtQuantity'+newRow+'" />*</td>' +
                        '<td><input type="text" id="txtPrice'+newRow+'" name="txtPrice'+newRow+'" />*</td>'+
                        '<td><input type="date" id="txtDate'+newRow+'" name="txtDate'+newRow+'" />*</td>'+
                        '<td><input type="text" id="txtLocation'+newRow+'" name="txtLocation'+newRow+'" />*</td>'+
                        '</tr>';
                    $("#"+nameTable+" tr:last").after(temp);
                }//Fin del else
            }//Fin de la función
            
             /**
            * Esta función nos permite poder obtener todos  los registros de inventario 
            * que se encuentra en la base de datos.
            * */
            function getCurrentInventory()
            {
                var infoData = "option=1";
                $.ajax
                (
                    {
                        type: 'POST',
                        url: "../business/InventoryAction.php",
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
                                    '<td><input type="text" id="txtCode'+newRow+'" name="txtCode'+newRow+'" value="'+person[1]+'"/><input type="hidden" id="txtID'+newRow+'" name="txtID'+newRow+'" value="'+person[0]+'"/>*</td>' +
                                    '<td><input type="text" id="txtName'+newRow+'" name="txtName'+newRow+'" value="'+person[2]+'"/>*</td>' +
                                    '<td><input type="number" id="txtQuantity'+newRow+'" name="txtQuantity'+newRow+'" value="'+person[3]+'"/>*</td>' +
                                    '<td><input type="number" id="txtPrice'+newRow+'" name="txtPrice'+newRow+'" value="'+person[4]+'"/>*</td>'+
                                    '<td><input type="date" id="txtDate'+newRow+'" name="txtDate'+newRow+'" value="'+person[5]+'" />*</td>'+
                                    '<td><input type="text" id="txtLocation'+newRow+'" name="txtLocation'+newRow+'" value="'+person[6]+'"/>*</td>'+
                                    '<td><input type="button" value="Update" class="btnUpdate" id="btnUpdate'+newRow+'" name="btnUpdate'+newRow+'" />'+
                                    '</tr>';
                                }
                                $("#tableBodyInventory").html(temp);
                                insertNewRow("tableBodyInventory");
                                $("#msg").html("");
                            }
                            else
                            {
                                insertNewRow("tableBodyInventory");
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
                
                if(($("#txtCode"+positionToValidate).val().length === 0) ||
                    ($("#txtName"+positionToValidate).val().length === 0) ||
                    ($("#txtQuantity"+positionToValidate).val().length === 0) ||
                    ($("#txtPrice"+positionToValidate).val().length === 0) ||
                    ($("#txtDate"+positionToValidate).val().length === 0))
                {
                    flag = false;
                }
                
                return flag;
            }//Fin de la función
            
            /**
            * Esta función nos permite poder eliminar la información de un respectivo inventario
            * */
            function deleteInventory()
            {   
                if($(deleteQuantity).val().length ===0){
                      $("#msgDelete").html("<p>Error!! Enter the quantity.</p>"); 
                    }else if($(deleteQuantity).val()< 0){
                     $("#msgDelete").html("<p>Error!! Enter the positive number.</p>");
                    }else if($(selActive).val().length===0){
                        $("#msgDelete").html("<p>Error!!</p>");
                    }else{
                        $("#msgDelete").html("");
                
                        var infoData = "option=3"+"&txtID="+$(selActive).val()+"&txtQuantity="+$(deleteQuantity).val();
                        
                        $.ajax 
                        (
                            {
                        type: 'POST',
                        url: "../business/InventoryAction.php",
                        data: infoData,
                        beforeSend: function(before)
                        {
                            $("#msgDelete").html("<p>Wait.</p>");
                        },
                        success: function(data)
                        {
                            if(data.toString() === "1")
                            {
                                $("#msgDelete").html("<p>Success.</p>");
                                getCurrentInventory();
                            }
                            else
                            {
                                $("#msgDelete").html("<p>"+data+".</p>");
                            }
                        },
                        error:function()
                        {
                            $("#msgDelete").html("<p>Error.</p>");
                        }
                    }
                );
            }
            }//Fin de la función
            
            /**
            * Esta función nos permite poder actualizar la información de un inventario.
            * @param {int} currentRow Corresponde a la fila que deseamos actualizar.
            * */
            function updateInventory(currentRow)
            {
                if(validation(currentRow))
                {
                    var infoData = "option=4"+
                            "&txtCode="+$("#txtCode"+currentRow).val() +
                            "&txtName="+$("#txtName"+currentRow).val() +
                            "&txtQuantity="+$("#txtQuantity"+currentRow).val() +
                            "&txtPrice="+$("#txtPrice"+currentRow).val() +
                            "&txtDate="+$("#txtDate"+currentRow).val() +
                            "&txtLocation="+$("#txtLocation"+currentRow).val() +
                            "&txtID="+$("#txtID"+currentRow).val();
                    $.ajax
                    (
                        {
                            type: 'POST',
                            url: "../business/InventoryAction.php",
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
                    var row = $("#tableBodyInventory tr:last").attr("id");
                    var newRow = row.substring(2,row.length);
                    
                    if(validation(newRow))
                    {
                        var buttons = '<td><input type="button" value="Update" class="btnUpdate" id="btnUpdate'+newRow+'" name="btnUpdate'+newRow+'" />'+
                            '<input type="button" value="Delete" class="btnDelete" id="btnDelete'+newRow+'" name="btnDelete'+newRow+'" /></td>';
                        $("#tableBodyInventory tr:last").append(buttons);
                        
                        var infoData = "option=2"+
                                "&txtCode="+$("#txtCode"+newRow).val() +
                                "&txtName="+$("#txtName"+newRow).val() +
                                "&txtQuantity="+$("#txtQuantity"+newRow).val() +
                                "&txtPrice="+$("#txtPrice"+newRow).val() +
                                "&txtDate="+$("#txtDate"+newRow).val() +
                                "&txtLocation="+$("#txtLocation"+newRow).val();
                        $.ajax
                        (
                            {
                                type: 'POST',
                                url: "../business/InventoryAction.php",
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
                                        insertNewRow("tableBodyInventory");
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
            $("#tableBodyInventory").on
            (
                'click','input.btnUpdate', function() 
                {
                    var row = $(this).attr("id");
                    var currentRow = row.substring(9,row.length);
                    updateInventory(currentRow);
                }
            );
            $("#btnDelete").on
           (
             'click', function ()
               {
                 deleteInventory();      
               }//fin del else
            );
        }//Fin de la función principal
    );
</script>
    