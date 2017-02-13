<?php
include './header.php';
include_once '../data/CampusData.php';
include '../business/InventoryBusiness.php';
?>
<h2>Wastes</h2>
<div>
    <table border='1'>
        <thead>
            <tr>
                <th>Brand</th>
                <th>Model</th>
                <th>Series</th>
                <th>Quantity </th>
                <th>Buy date </th>
                <th>voice number </th>
                <th>Provider </th>
                <th>Price </th>
                <th>Buyer </th>
                <th>Payment Type </th>
            </tr>
        </thead>
        <tbody id="tableBodyShow"> 
        </tbody>
        <tfoot>
        </tfoot>
    </table>
</div>
<div id="msg"></div><br><br>

<div>
    <fieldset>
    <table>
        <thead>
            <tr>
                <th>By status</th>
                <th>Goods</th>
                <th>Quantity</th>
                
            </tr>
        </thead>
        <tbody id="tableBodyRepair"> 
        <th><select name="status" id='status'>
                <option value="1">Functionary</option>
         <option value="2">Repair</option>
         <option value="4">Damage in use</option>
         <option value="6">Donated</option>
        
        </select></th>
        <th><div id="select"></div></th>
        <th><input type="number" id="txtQuantity" min="0">*</th>
        <th><input type="button" id="btnWast" name="btnWast" value="Insert" onclick="validation()"></th>
        </tbody>
        <tfoot>
        </tfoot>
    </table>
 </fieldset>
</div>
<div id="msgError"></div><br><br>

<?php include './footer.php' ?>
<script>
    $(document).ready
      (
        function ()
          {
              
            getCurrentRepair();
            var arrayInventory;
                
                $('select#status').on('change',function(){
                    var valor = $(this).val();
                     getGoods(valor);
                });
                $("#tableBodyShow").on
            (
               'click', 'input.btnRepaired', function ()
                    {
                      var row = $(this).attr("id");
                      var currentRow = parseInt(row.substring(11, row.length));
                      
                       if($("#txtQuantity"+currentRow).val().length===0){
                            $("#msg").html("<p>Insert the quantity</p>");
                       }else if($("#txtQuantity"+currentRow).val()>$("#txtQuantitystar"+currentRow).val()){
                           $("#msg").html("<p>ERROR: Amount exceeded!</p>");
                       }else if($("#txtQuantity"+currentRow).val()<0){
                           $("#msg").html("<p>ERROR: ENTER A MAJOR AMOUNT!</p>");
                       }else{
                           repaired(currentRow);
                       }
                    }
            );
             }//Fin de la función principal
          );
          
                /**
               * Esta función nos permite poder obtener todos  los registros de inventario 
               * que se encuentra en la base de datos.
               * */
               function getCurrentRepair()
                {
                  var infoData = "option=1&status=3";
                    $.ajax
                       (
                         {
                           type: 'POST',
                           url: "../business/InventoryAction.php",
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
                                  var goods = array[i].split(",");
                                                            
                                  temp = temp + '<tr id="tr' + newRow + '">' +
                                         '<td>' + goods[1] + '<input type="hidden" id="txtID' + newRow + '" name="txtID' + newRow + '" value="' + goods[0] + '"/></td>' +
                                          '<td>' + goods[2] + '</td>'+
                                          '<td>' + goods[3] + '</td>'+
                                          '<td>' + goods[4] + '</td>'+
                                          '<td>' + goods[5] + '</td>'+
                                          '<td>' + goods[6] + '</td>'+
                                          '<td>' + goods[7] + '</td>'+
                                          '<td>' + goods[8] + '</td>'+
                                          '<td>' + goods[9] + '</td>'+
                                          '<td>' + goods[10] + '</td>'+
                                          '</tr>';
                                   }
                                      $("#tableBodyShow").html(temp);
                                      $("#msg").html("");
                              } else{
                                     $("#msg").html("");
                                   }
                          },
                         error: function ()
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
           function validation()
            {
              if (($("#txtQuantity").val().length === 0))
                 {
                   $("#msgError").html("<p>Insert the quantity</p>");
                  }else{ 
                      insert();
                  }
            }//Fin de la función
            
            /**
            * 
             * @returns {undefined}             */
            function insert(){
              var infoData = "option=2&status=3"+
                              "&txtIdInventory="+$("#selInformation").val()+
                              "&txtQuantity="+$("#txtQuantity").val();
                    $.ajax
                       (
                         {
                           type: 'POST',
                           url: "../business/InventoryAction.php",
                           data: infoData,
                           beforeSend: function (before)
                           {
                            $("#msgError").html("<p>Wait.</p>");
                           },
                          success: function (data)
                           {
                             if (data==='1')
                           {
                             $("#msgError").html("<p>Sucess.</p>");
                             getCurrentRepair();
                            } else{
                                $("#msgError").html("<p>Error.</p>");
                             }
                          },
                         error: function ()
                           {
                             $("#msgError").html("<p>Error.</p>");
                           }
                        }
                     );
            }
               
      /**
            * 
             * @returns {undefined}             
             * */
            function repaired(currentRow){
            
              var infoData = "option=3&status=3"+
                              "&txtIdInventory="+$("#txtID"+currentRow).val()+
                              "&txtQuantity="+$("#txtQuantity"+currentRow).val();
                    $.ajax
                       (
                         {
                           type: 'POST',
                           url: "../business/InventoryAction.php",
                           data: infoData,
                           beforeSend: function (before)
                           {
                            $("#msg").html("<p>Wait.</p>");
                           },
                          success: function (data)
                           {
                             if (data==='1')
                           {
                             $("#msg").html("<p>Sucess.</p>");
                             getCurrentRepair();
                            } else{
                                $("#msg").html("<p>Error.</p>");
                             }
                          },
                         error: function ()
                           {
                             $("#msg").html("<p>Error.</p>");
                           }
                           
                        }
                     );
            }
            
            function getGoods(status)
             {
               
              var infoData = "option=4&status="+status;
                $.ajax
                  (
                    {
                      type: 'POST',
                      url: "../business/InventoryAction.php",
                      data: infoData,
                      beforeSend: function (before)
                        {
                          $("#msg").html("<p>.</p>");
                        },
                      success: function (data)
                        {
                          if (data.toString().length > 0)
                            {
                              arrayInventory = data.split(";");
                              $("#msgError").html("");
                              getSelect();
                            } else
                               {
                                 $("#select").html('');
                                 $("#msgError").html("Don't have goods to show");
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
                * Función que nos permite obtener el select de las miembros que componen a la familia.
                 * @param {type} currentRow
                 * @returns {String}                 
                 * */
              function getSelect()
                {
                 var temp = '<select id="selInformation'  + '" name="selInformation'  + '">';
                 for (var i = 0; i < arrayInventory.length; i++)
                   {
                       var relative = arrayInventory[i].split(",");
                        temp = temp + '<option value="' + relative[0] + '" selected="">'+' Brand:' + relative[1] +' Model:' + relative[2] +' Series:' + relative[3] + '</option>';
                        
                    }//Fin del for
                   $("#select").html(temp);
                }//Fin de la función
</script>

