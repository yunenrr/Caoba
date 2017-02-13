<?php
include './header.php';
?>
<h2></h2>
<fieldset>
    <legend>Donated goods</legend>
    <div>
        <table>
            <thead>
                <tr>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Quantity</th>
                    <th>Donated date</th>
                    <th>Provider</th>
                    <th>Location in the gym</th>
                    <th>Update</th>
                </tr>
            </thead>
            <tbody id="tableBodyBuy"> 
            </tbody>
            <tfoot>
                <tr><td><div>Required fields(*)</div></td></tr>
                <tr>
                    <td><input type="button" value="Insert" id="btnInsert" name="btnInsert" /></td>
                </tr>
            </tfoot>
        </table>
    </div>
</fieldset>
<div id="msg"></div>

<?php include './footer.php' ?>
<script>
    $(document).ready
            (
              function ()
                  {
                    getCurrentDonated();
                    var allCampus="";
                        
                   /**
                    * Función que nos permite obtener todos las dietas del cliente
                    * @returns {undefined}
                    */
                    function getAllCampus(){

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
                                        } else{
                                                $("#msg").html("Don't have food");
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
                        function insertNewRow(nameTable)
                        {
                            var newRow = ($("#" + nameTable + " tr").length);
                            var temp = "";

                            if (newRow === 0)
                            {
                                temp = '<tr id="tr' + newRow + '">' +
                                        '<td><input type="text" id="txtBrand' + newRow + '" name="txtBrand' + newRow + '" />*<input type="hidden" id="txtID' + newRow + '" name="txtID' + newRow + '" /></td>' +
                                        '<td><input type="text" id="txtModel' + newRow + '" name="txtModel' + newRow + '" />*</td>'+
                                        '<td><input type="text" id="txtQuantity' + newRow + '" name="txtQuantity' + newRow + '" />*</td>'+
                                        '<td><input type="text" id="txtDate' + newRow + '" name="txtDate' + newRow + '" />*</td>'+
                                        '<td><input type="text" id="txtProvider' + newRow + '" name="txtProvider' + newRow + '" />*</td>'+
                                        '</tr>';
                                $("#" + nameTable).html(temp);
                            } else
                            {
                                var row = $("#tableBodyBuy tr:last").attr("id");
                                var newRow = parseInt(row.substring(2, row.length)) + 1;
                                temp = '<tr id="tr' + newRow + '">' +
                                        '<td><input type="text" id="txtBrand' + newRow + '" name="txtBrand' + newRow + '" />*<input type="hidden" id="txtID' + newRow + '" name="txtID' + newRow + '" /></td>' +
                                        '<td><input type="text" id="txtModel' + newRow + '" name="txtModel' + newRow + '" />*</td>'+
                                        '<td><input type="text" id="txtQuantity' + newRow + '" name="txtQuantity' + newRow + '" />*</td>'+
                                        '<td><input type="text" id="txtDate' + newRow + '" name="txtDate' + newRow + '" />*</td>'+
                                        '<td><input type="text" id="txtProvider' + newRow + '" name="txtProvider' + newRow + '" />*</td>'+
                                        '</tr>';
                                $("#" + nameTable + " tr:last").after(temp);
                            }//Fin del else
                        }//Fin de la función

                        /**
                         * Esta función nos permite poder obtener todos  los registros de inventario 
                         * que se encuentra en la base de datos.
                         * */
                        function getCurrentDonated()
                        {
                            var infoData = "option=1";
                            $.ajax
                                    (
                                            {
                                                type: 'POST',
                                                url: "../business/BuyBusinessAction.php",
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
                                                            var person = array[i].split(",");
                                                            
                                                            temp = temp + '<tr id="tr' + newRow + '">' +
                                                                    '<td><input type="text" id="txtBrand' + newRow + '" name="txtBrand' + newRow + '" value="' + person[1] + '"/>*<input type="hidden" id="txtID' + newRow + '" name="txtID' + newRow + '" value="' + person[0] + '"/></td>' +
                                                                    '<td><input type="text" id="txtModel' + newRow + '" name="txtModel' + newRow + '" value="' + person[2] + '"/>*</td>'+
                                                                    '<td><input type="text" id="txtQuantity' + newRow + '" name="txtQuantity' + newRow + '" value="' + person[3] + '"/>*</td>'+
                                                                    '<td><input type="text" id="txtdate' + newRow + '" name="txtdate' + newRow + '" value="' + person[4] + '"/>*</td>'+
                                                                    '<td><input type="text" id="txtProvide' + newRow + '" name="txtProvide' + newRow + '" value="' + person[6] + '"/></td>'+
                                                                    '<td><input type="button" value="Update" class="btnUpdate" id="btnUpdate' + newRow + '" name="btnUpdate' + newRow + '" /></td>' +
                                                                    '</tr>';
                                                        }
                                                        $("#tableBodyBuy").html(temp);
                                                        insertNewRow("tableBodyBuy");
                                                        $("#msg").html("");
                                                    } else
                                                    {
                                                        insertNewRow("tableBodyBuy");
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
                        function validation(positionToValidate)
                        {
                            var flag = true;

                            if (($("#txtNeighborhood" + positionToValidate).val().length === 0))
                            {
                                flag = false;
                            }

                            return flag;
                        }//Fin de la función

                        /**
                         * Esta función nos permite poder eliminar la información del barrio
                         * @param {type} currentRow
                         * @returns {undefined}             
                         * */
                        function deleteAddress(currentRow)
                        {
                            var infoData = "option=4" +
                                    "&txtID=" + $("#txtID" + currentRow).val();
                            $.ajax
                                    (
                                            {
                                                type: 'POST',
                                                url: "../business/AddressBusinessAction.php",
                                                data: infoData,
                                                beforeSend: function (before)
                                                {
                                                    $("#msg").html("<p>Wait.</p>");
                                                },
                                                success: function (data)
                                                {
                                                    if (data.toString() !== "0")
                                                    {
                                                        $("#msg").html("<p>Success delete.</p>");
                                                        $("#tr" + currentRow).remove();
                                                    } else
                                                    {
                                                        $("#msg").html("<p>Error.</p>");
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
                         * Esta función nos permite poder actualizar la información de un inventario.
                         * @param {int} currentRow Corresponde a la fila que deseamos actualizar.
                         * */
                        function updateAddress(currentRow)
                        {
                            if (validation(currentRow))
                            {
                                var infoData = "option=3" +
                                        "&txtNeighborhood=" + $("#txtNeighborhood" + currentRow).val() +
                                        "&txtID=" + $("#txtID" + currentRow).val();
                                $.ajax
                                        (
                                                {
                                                    type: 'POST',
                                                    url: "../business/AddressBusinessAction.php",
                                                    data: infoData,
                                                    beforeSend: function (before)
                                                    {
                                                        $("#msg").html("<p>Wait.</p>");
                                                    },
                                                    success: function (data)
                                                    {
                                                        if (data.toString() !== "0")
                                                        {
                                                            $("#msg").html("<p>Success update.</p>");
                                                        } else
                                                        {
                                                            $("#msg").html("<p>Error.</p>");
                                                        }
                                                    },
                                                    error: function ()
                                                    {
                                                        $("#msg").html("<p>Error.</p>");
                                                    }
                                                }
                                        );
                            } else
                            {
                                $("#msg").html("<p>Please, check the information.</p>");
                            }
                        }//Fin de la función

                        /************************ EVENTOS *******************************/
                        $("#btnInsert").on
                                (
                                        'click', function ()
                                        {
                                            var row = $("#tableBodyBuy tr:last").attr("id");
                                            var newRow = row.substring(2, row.length);

                                            if (validation(newRow))
                                            {
                                                var buttons = '<td><input type="button" value="Update" class="btnUpdate" id="btnUpdate' + newRow + '" name="btnUpdate' + newRow + '" />' +
                                                        '<input type="button" value="Delete" class="btnDelete" id="btnDelete' + newRow + '" name="btnDelete' + newRow + '" /></td>';
                                                $("#tableBodyBuy tr:last").append(buttons);

                                                var infoData = "option=2" +
                                                        "&txtNeighborhood=" + $("#txtNeighborhood" + newRow).val();
                                                $.ajax
                                                        (
                                                                {
                                                                    type: 'POST',
                                                                    url: "../business/AddressBusinessAction.php",
                                                                    data: infoData,
                                                                    beforeSend: function (before)
                                                                    {
                                                                        $("#msg").html("<p>Wait.</p>");
                                                                    },
                                                                    success: function (data)
                                                                    {
                                                                        if (data.toString() === "1")
                                                                        {
                                                                            $("#msg").html("<p>Success insert.</p>");
                                                                            $("#txtID" + newRow).val(data);
                                                                            insertNewRow("tableBodyBuy");
                                                                        } else
                                                                        {
                                                                            $("#msg").html("<p>Error.</p>");
                                                                        }
                                                                    },
                                                                    error: function ()
                                                                    {
                                                                        $("#msg").html("<p>Error.</p>");
                                                                    }
                                                                }
                                                        );
                                            }//
                                            else {
                                                $("#msg").html("<p>Please, check the information.</p>");
                                            }
                                        }
                                );
                        $("#tableBodyBuy").on
                                (
                                        'click', 'input.btnUpdate', function ()
                                        {
                                            var row = $(this).attr("id");
                                            var currentRow = row.substring(9, row.length);
                                            updateAddress(currentRow);
                                        }
                                );
                        $("#tableBodyBuy").on
                                (
                                        'click', 'input.btnDelete', function ()
                                        {
                                            var row = $(this).attr("id");
                                            var currentRow = row.substring(9, row.length);
                                            deleteAddress(currentRow);
                                        }
                                );
                    }//Fin de la función principal
            );
</script>

