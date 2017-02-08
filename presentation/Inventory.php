<?php include './header.php' ?>
<div>
    <table border="2">
        <h2>Gym Inventory</h2>
        <thead>
            <tr>
                <th>Code active</th>
                <th>Name active</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Date</th>
                <th>Location</th>
            </tr>
        </thead>
        <tbody id="tableBodyInventory"> 
        </tbody>
        <tfoot>
        </tfoot>
    </table>
    <div id="msg"></div>
</div>
<?php include './footer.php' ?>
<script>
    $(document).ready
            (
              function ()
               {
                   getperson();
                   
      /**
     * Función que nos permite obtener las personas actuales en la base de datos.
     * */
   function getperson()
             {
               var info = "option=1";
                $.ajax
                 (
                   {
                     type: 'POST',
                     url: "../business/InventoryAction.php",
                     data: info,
                     beforeSend: function (before)
                      {
                        $("#msg").html("<p>Wait</p>");
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
                              var person = array[i].split(",");
                              temp = temp + '<tr id="td' + newRow + '">';
                              temp = temp +'<td>'+ person[1] + '</td>' +
                                            '<td>' + person[2] + '</td>' +
                                            '<td>₡' + person[3] + '</td>'+
                                            '<td>' + person[4] + '</td>' +
                                            '<td>' + person[5] + '</td>' +
                                            '<td>' + person[6] + '</td>' +
                                            '</tr>';
                            }
                              $("#tableBodyInventory").html(temp);
                              $("#msg").html("");
                         }else{
                          $("#msg").html("No goods to show");
                         }
                       },          
                     error: function ()
                       {
                        $("#msg").html("<p>Error.</p>");
                       }
                    }
                  );
             }//Fin de la función
        }//Fin de la función principal
    ); 
</script>