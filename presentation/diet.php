<?php
include './header.php';
if (isset($_GET['id'])) {
    $idPerson = $_GET['id'];
    $namePerson = $_GET['name'];
} else {
    header('Location: ViewClient.php');
}
?>
<div>
    <table border>
        <thead>
            <tr>
                <th>Food</th>
                <th>Name</th>
                <th>Description</th>
                <th>Day</th>
                <th>Hour</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody id="tableBodyDietshow">
        </tbody>
        <tfoot>
            <tr></tr>
        </tfoot>
    </table>

    <br><br>
     <H2 ALIGN=JUSTIFY> Assign diet to <?php echo $namePerson ?></H2>

    <fieldset>
    <table>
        <thead>
            <tr>
                <th>Food</th>
                <th>Name</th>
                <th>Description</th>
                <th>Day</th>
                <th>Hour</th>
            </tr>
        </thead>
        <tbody id="tableBodyDiet">
        </tbody>
        <tfoot>
            <tr>
                <td><input type="button" value="Insert more Food" id="btnInsertFood" name="btnInsertFood" />
                    <input type="button" value="Insert" id="btnInsert" name="btnInsert" /></td>
            </tr>
        </tfoot>
    </table>
     </fieldset>
    <div id="msg"></div>
</div>

<?php include './footer.php' ?>
<script type="text/javascript">
    $(document).ready
        (
        function ()
            {
             var arrayAllFood = "";
             getAllFood();
             getDiet();
             
 /****************************** Eventos ************************************/
         $("#btnInsertFood").on
           (
             'click', function ()
              {
                var row = $("#tableBodyDiet tr:last").attr("id");
                var newRow = row.substring(2, row.length);
                insertNewRowFood("tableBodyDiet");
                var buttons = '<input type="button" value="Delete" class="btnDelete" id="btnDelete' + newRow + '" name="btnDelete' + newRow + '" /></td>';
                $("#tableBodyDiet tr:last").append(buttons);
                }
            );
         $("#btnInsert").on
           (
             'click', function ()
               {
                var row = $("#tableBodyDiet tr:last").attr("id");
                var newRow = parseInt(row.substring(2, row.length));
             
                 var food="";
                 for (var i = 1; i < newRow+1; i++)
                 {
                    food= food+"&"+i+"=" + $("#selFood" + i).val();
                 }
                
                if (validation(0))
                  {
                     var infoData = "option=1"+ "&idPerson="+<?php echo $idPerson ?>+
                     "&quantityFood="+ newRow+
                     "&txtName=" + $("#txtName" + 0).val() +
                     "&txtDescription=" + $("#txtDescription" + 0).val() +
                     "&txtDay=" + $("#txtDay" + 0).val() +
                     "&txtHour=" + $("#txtHour" + 0).val()+
                     "&selFood=" + $("#selFood"+0).val() + food;
                    $.ajax
                    (
                      {
                        type: 'POST',
                        url: "../business/DietAction.php",
                        data: infoData,
                        beforeSend: function (before)
                         {
                           $("#msg").html("<p>Wait.</p>");
                         },
                        success: function (data)
                         {
                           if (data.toString() !== "0"){
                             $("#msg").html("<p>Success.</p>");
                             $("#txtID" + newRow).val(data);
                              getDiet();
                            } else{
                             $("#msg").html("<p>Error.</p>");}
                         },
                        error: function ()
                         {
                           $("#msg").html("<p>Error.</p>");
                         }
                        }
                    );
                      }//Fin del if de validaciones
                        else {$("#msg").html("<p>Please, check the information.</p>");}
                }
                            
                        );
                    $("#tableBodyDiet").on
                            (
                              'click', 'input.btnDelete', function ()
                                {
                                  var row = $(this).attr("id");
                                  var currentRow = parseInt(row.substring(9, row.length))+1;
                                    $("#tr" + currentRow).remove();
                                 }
                            );
                    
                     $("#tableBodyDietshow").on
                            (
                              'click', 'input.deleteDiet', function ()
                                {
                                  var row = $(this).attr("id");
                                  var currentRow = parseInt(row.substring(10, row.length));
                                    deleteDiet(currentRow);
                                 }
                            );
    /****************************** Funciones ************************************/
            /**
             * Función que nos permite obtener todos las dietas del cliente
             * */
            function getDiet()
             {
               var infoData = "option=3"+ "&idPerson="+<?php echo $idPerson ?> ;
                $.ajax
                 (
                   {
                     type: 'POST',
                     url: "../business/DietAction.php",
                     data: infoData,
                     beforeSend: function (before)
                      {
                        $("#msg").html("<p>.</p>");
                      },
                     success: function (data)
                      {
                        if (data.toString().length > 0)
                         {
                           var temp = "";
                           var array = data.split(";");
                           for (var i = 0; i < array.length; i++)
                            {
                              var newRow = i + 1;
                              var diet = array[i].split(",");
                              temp = temp + '<tr id="td' + newRow + '">';
                              temp = temp +'<td><textarea id="txtFood' + newRow + '" name="txtFood' + newRow + '"  rows="5" cols="40" readonly=”readonly” >' + diet[1] + '</textarea></td>' +
                                            '<td><input type="text" id="txtName' + newRow + '" name="txtName' + newRow + '" value="' + diet[2] + '"readonly=”readonly”/><input type="hidden" id="txtID' + newRow + '" name="txtID' + newRow + '" value="' + diet[0] + '"/></td>' +
                                            '<td><input type="text" id="txtDescription' + newRow + '" name="txtDescription' + newRow + '" value="' + diet[3] + '"readonly=”readonly”/></td>'+
                                            '<td><input type="text" id="txtDay' + newRow + '" name="txtDay' + newRow + '" value="' + diet[4] + '"readonly=”readonly”/></td>' +
                                            '<td><input type="number" id="txtHour' + newRow + '" name="txtHour' + newRow + '" value="' + diet[5] + '" readonly=”readonly”/></td>' +
                                            '<td><input type="button" value="Delete" class="deleteDiet" id="deleteDiet'+diet[0]+'" name="deleteDiet'+diet[0]+'"readonly=”readonly” /></td>'+
                                            '</tr>';
                            }
                              $("#tableBodyDietshow").html(temp);
                              $("#msg").html("");
                         }
                       },          
                     error: function ()
                       {
                        $("#msg").html("<p>Error.</p>");
                       }
                    }
                  );
             }//Fin de la función

            /**
             * Función que nos permite obtener todos los la food de la base de datos.
            * */
            function getAllFood()
             {
              var infoData = "option=2";
                $.ajax
                  (
                    {
                      type: 'POST',
                      url: "../business/DietAction.php",
                      data: infoData,
                      beforeSend: function (before)
                        {
                          $("#msg").html("<p>Wait.</p>");
                        },
                      success: function (data)
                        {
                          if (data.toString().length > 0)
                            {
                              arrayAllFood = data.split(";");
                            } else
                               {
                                 $("#msg").html("Don't have food");
                               }
                            insertRow("tableBodyDiet");
                        },
                       error: function ()
                         {
                           $("#msg").html("<p>Error.</p>");
                         }
                    }
                  );
             }//Fin del if

             /**
              * Función que nos permite obtener el select de comidas.
              * @param {int} currentRow Corresponde a la posición en la tabla.
              * */
              function getSelFood(id, currentRow)
                {
                 var temp = '<select id="selFood' + currentRow + '" name="selFood' + currentRow + '">';
                 for (var i = 0; i < arrayAllFood.length; i++)
                   {
                       var diet = arrayAllFood[i].split(",");
                       if (diet[0] === id)
                        {
                            temp = temp + '<option value="' + diet[0] + '" selected="">' + diet[1] + '</option>';
                        } else
                           {
                             temp = temp + '<option value="' + diet[0] + '">' + diet[1] + '</option>';
                            }
                    }//Fin del for
                    return temp;
                }//Fin de la función

                /**
                 * Función que nos permite insertar una nueva fila a la tabla.
                 * @param {String} nameTable Corresponde al nombre de la tabla
                 * */
                 function insertRow(nameTable)
                   {
                     var newRow = ($("#" + nameTable + " tr").length);
                        
                                $("#" + nameTable).html
                                    (
                                    '<tr id="tr' + newRow + '">' +
                                    '<td>' + getSelFood(0, newRow) + '</td>' +
                                    '<td><input type="text" id="txtName' + newRow + '" name="txtName' + newRow + '" /><input type="hidden" id="txtID' + newRow + '" name="txtID' + newRow + '"/></td>' +
                                    '<td><input type="text" id="txtDescription' + newRow + '" name="txtDescription' + newRow + '"/></td>' +
                                    '<td><select id="txtDay' + newRow + '" name="txtDay' + newRow + '">'+'<option value="Monday">Monday</option><option value="Tuesday">Tuesday</option><option value="Wednesday">Wednesday</option> <option value = "Thursday"> Thursday </option> <option value="Friday">Friday</option ><option value="Saturday">Saturday</option><option value = "Sunday"> Sunday </option> </select></td>' +
                                    '<td> <input type = "number" id = "txtHour' + newRow + '" name = "txtHour' + newRow + '" /> </td>' +
                                    '</tr>'
                                    );
                            getSelFood
                    }//Fin de la función
                                            
                 /**
                  * Función que valida los campos.
                  * @param {String} positionToValidate Corresponde a la posición en la tabla.
                  * @return {boolean} Indicando si está todo bien o no.
                  * */
                  function validation(positionToValidate)
                    {
                        var flag = true;
                        if (($("#txtName" + positionToValidate).val().length === 0) ||
                           ($("#txtDescription" + positionToValidate).val().length === 0) ||
                           ($("#txtDay" + positionToValidate).val().length === 0) ||
                            ($("#txtHour" + positionToValidate).val().length === 0))
                            {
                                flag = false;
                            }
                                            
                      return flag;
                   }//Fin de la función                                             
                                                                    
                /**
                 * Función que nos permite insertar una nueva fila de food a la tabla.
                 * @param {String} nameTable Corresponde al nombre de la tabla
                 * */
                function insertNewRowFood(nameTable)
                    {
                       var newRow = ($("#" + nameTable + " tr").length);
                       var row = $("#tableBodyDiet tr:last").attr("id");
                       var newRow = parseInt(row.substring(2, row.length)) + 1;
                            $("#" + nameTable + " tr:last").after
                               (
                                 '<tr id="tr' + newRow + '">' +
                                 '<td>' + getSelFood(0, newRow) + '</td>' +
                                 '</tr>'
                                );
                    }//Fin de la función
                    
            /**
            * Función que nos permite eliminar dietas.
            * @param {int} currentRow Corresponde a la fila que deseamos eliminar
            * */
            function deleteDiet(currentRow)
            {   
                var infoData = "option=4"+
                        "&txtID="+currentRow;
                $.ajax
                (
                    {
                        type: 'POST',
                        url: "../business/DietAction.php",
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
                                $("#td"+currentRow).remove();
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
            getDiet();
            }//Fin de la función
            }
        );
    
                                                            
</script>





