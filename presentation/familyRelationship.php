<?php include './header.php';
if (isset($_GET['id'])){
$idPerson = $_GET['id'];
$namePerson = $_GET['name'];
}else{
   header('Location: ViewClient.php');
}
    ?>
<div>
    <fieldset>
        <legend><?php echo $namePerson?>'s family</legend>
        <div id="tree"></div>       
        </fieldset><br><br>
    
    
    <table border>
        <thead>
            <tr>
                <th>Family identify</th>
                <th>Name of relative</th>
                <th>FirstName of relative</th>
                <th>SecondName of relative</th>
                <th>Family relationship</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody id="tableBodyFamilytshow">
        </tbody>
        <tfoot>
        </tfoot>
    </table>
    <br><br>
    <table>
        <thead>
            <tr>
                <th>Name of relative</th><th></th>
                <th>Family relationship</th>
            </tr>
        </thead>
        <tbody id="tableBodyFamily">
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
        function ()
            {
             var arrayAllPerson = "";
             var arrayAllRelationShip = "";
             
             TreeFamily();
             getAllRelationship();
             getAllPerson();
//             getFamily();
             
 /****************************** Eventos ************************************/
 
         $("#tableBodyFamilytshow").on
            (
               'click', 'input.deleteDiet', function ()
                    {
                      var row = $(this).attr("id");
                      var currentRow = parseInt(row.substring(10, row.length));
                      deleteFamily(currentRow);
                    }
            );
                    
         $("#btnInsert").on
           (
             'click', function ()
               {
                var row = $("#tableBodyFamily tr:last").attr("id");
                var newRow = parseInt(row.substring(2, row.length));
             
                     var infoData = "option=1"+ "&idPerson="+<?php echo $idPerson ?>+
                     "&selFamilyParenting=" + $("#selPerson"+0).val()+
                     "&selRelationShip=" + $("#selRelationShip"+0).val();
                    $.ajax
                    (
                      {
                        type: 'POST',
                        url: "../business/FamilyParentingAction.php",
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
                              getFamily();
                            } else{
                             $("#msg").html("<p>Already admitted as a relative.</p>");}
                         },
                        error: function ()
                         {
                           $("#msg").html("<p>Error.</p>");
                         }
                        }
                    );
                }
                            
                        );
                    $("#tableBodyFamily").on
                            (
                              'click', 'input.btnDelete', function ()
                                {
                                  var row = $(this).attr("id");
                                  var currentRow = parseInt(row.substring(9, row.length))+1;
                                    $("#tr" + currentRow).remove();
                                 }
                            );
    /****************************** Funciones ************************************/
            /**
             * Función que nos permite obtener todas los familiares del cliente
             * */
            function getFamily()
             {
               var infoData = "option=4"+ "&idPerson="+<?php echo $idPerson ?> ;
                $.ajax
                 (
                   {
                     type: 'POST',
                     url: "../business/FamilyParentingAction.php",
                     data: infoData,
                     beforeSend: function (before)
                      {
                        $("#msg").html("<p>Wait.</p>");
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
                              var service = array[i].split(",");
                              temp = temp + '<tr id="tr' + newRow + '">';
                              temp = temp +'<td><input type="text" id="txtFamilyDNI' + newRow + '" name="txtFamilyDNI' + newRow + '" value="' + service[1] + '"  readonly=”readonly” /></td>' +
                                            '<td><input type="text" id="txtName' + newRow + '" name="txtName' + newRow + '" value="' + service[2] + '"  readonly=”readonly” /><input type="hidden" id="txtID' + newRow + '" name="txtID' + newRow + '" value="' + service[0] + '"/></td>' +
                                            '<td><input type="text" id="txtDescription' + newRow + '" name="txtDescription' + newRow + '" value="' + service[3] + '"readonly=”readonly/></td>'+
                                            '<td><input type="text" id="txtDay' + newRow + '" name="txtDay' + newRow + '" value="' + service[4] + '"  readonly=”readonly” /></td>' +
                                            '<td><input type="text" id="txtHour' + newRow + '" name="txtHour' + newRow + '" value="' + service[5] + '"  readonly=”readonly” /></td>' +
                                            '<td><input type="button" value="Delete" class="deleteDiet" id="deleteDiet'+service[0]+'" name="deleteDiet'+service[0]+'"  readonly=”readonly”/></td>'+
                                            '</tr>';
                            }
                              $("#tableBodyFamilytshow").html(temp);
                              TreeFamily();
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
             * Función que nos permite obtener todos los la comida de la base de datos.
            * */
            function getAllPerson()
             {
              var infoData = "option=2";
                $.ajax
                  (
                    {
                      type: 'POST',
                      url: "../business/FamilyParentingAction.php",
                      data: infoData,
                      beforeSend: function (before)
                        {
                          $("#msg").html("");
                        },
                      success: function (data)
                        {
                          if (data.toString().length > 0)
                            {
                              arrayAllPerson = data.split(";");
                            } else
                               {
                                 $("#msg").html("Don't have Person to show");
                               }
                            insertNewRow("tableBodyFamily");
                        },
                       error: function ()
                         {
                           $("#msg").html("<p>Error.</p>");
                         }
                    }
                  );
             }//Fin del if
             
             /**
             * Función que nos permite obtener todos los la comida de la base de datos.
            * */
            function getAllRelationship()
             {
              var infoData = "option=3";
                $.ajax
                  (
                    {
                      type: 'POST',
                      url: "../business/FamilyParentingAction.php",
                      data: infoData,
                      beforeSend: function (before)
                        {
                          $("#msg").html("<p>.</p>");
                        },
                      success: function (data)
                        {
                          if (data.toString().length > 0)
                            {
                              arrayAllRelationShip = data.split(";");
                            } else
                               {
                                 $("#msg").html("Don't have relationship to show");
                               }
                        },
                       error: function ()
                         {
                           $("#msg").html("<p>Error.</p>");
                         }
                    }
                  );
             }//Fin del if

             /**
              * Función que nos permite obtener el select de personas .
              * @param {int} currentRow Corresponde a la posición en la tabla.
              * */
              function getSelPerson( currentRow)
                {
                 var temp = '<select id="selPerson' + currentRow + '" name="selPerson' + currentRow + '">';
                 for (var i = 0; i < arrayAllPerson.length; i++)
                   {
                       var family = arrayAllPerson[i].split(",");
                       if (family[0]!= <?php echo $idPerson ?>)
                        {
                            temp = temp + '<option value="' + family[0] + '" selected="">' + family[1] + '</option>';
                        }
                    }//Fin del for
                    return temp;
                }//Fin de la función
                
                /**
                * Función que nos permite obtener el select de las miembros que componen a la familia.
                 * @param {type} currentRow
                 * @returns {String}                 
                 * */
              function getSelRelationship(currentRow)
                {
                 var temp = '<select id="selRelationShip' + currentRow + '" name="selRelationShip' + currentRow + '">';
                 for (var i = 0; i < arrayAllRelationShip.length; i++)
                   {
                       var relative = arrayAllRelationShip[i].split(",");
                        temp = temp + '<option value="' + relative[0] + '" selected="">' + relative[1] + '</option>';
                        
                    }//Fin del for
                    return temp;
                }//Fin de la función

                /**
                 * Función que nos permite insertar una nueva fila a la tabla.
                 * @param {String} nameTable Corresponde al nombre de la tabla
                 * */
                 function insertNewRow(nameTable)
                   {
                     var newRow = ($("#" + nameTable + " tr").length);
                                $("#" + nameTable).html
                                    (
                                    '<tr id="tr' + newRow + '">' +
                                    '<td>' + getSelPerson(newRow) + '</td>'+ '<td></td>'+
                                    '<td>' + getSelRelationship (newRow) + '</td>' +
                                    '<td><input type="hidden" id="txtID' + newRow + '" name="txtID' + newRow + '"/></td>'+
                                    '</tr>'
                                    );
                    }//Fin de la función                       
                    
            /**
            * Función que nos permite eliminar un mienmbro del grupo familiar.
            * @param {int} currentRow Corresponde a la fila que deseamos eliminar
            * */
            function deleteFamily(currentRow)
            {   
                var infoData = "option=5"+
                        "&txtID="+currentRow;
                $.ajax
                (
                    {
                        type: 'POST',
                        url: "../business/FamilyParentingAction.php",
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
                                getFamily();
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
            
            function TreeFamily()
             {
               var infoData = "option=6"+ "&idPerson="+<?php echo $idPerson ?> ;
                $.ajax
                 (
                   {
                     type: 'POST',
                     url: "../business/FamilyParentingAction.php",
                     data: infoData,
                     beforeSend: function (before)
                      {
                        $("#msg").html("<p>.</p>");
                      },
                     success: function (data)
                      {
                        if (data.toString().length > 0)
                         {
                           
                              $("#tree").html(data);
                         }
                       },          
                     error: function ()
                       {
                        $("#msg").html("<p>Error.</p>");
                       }
                    }
                  );
             }//Fin de la función
            }
        );
    
                                                            
</script>


