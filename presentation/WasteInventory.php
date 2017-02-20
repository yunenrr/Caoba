<?php
include './header.php';
?>
<h2>Equipamiento de desecho</h2>

<div>Seleccione un estado <select name="status" id='status'>
        <option value="0">SELECCIONE</option>
        <option value="1">Funcionamiento</option>
        <option value="2">Reparación</option>
        <option value="4">Dañado en uso</option>
        <option value="6">Donado</option>
    </select><br><br><br>

</div>
<div>
    <table  id="paymentTable" border="1px" cellpadding="10px" >
    </table>
    <div id="msg"></div>
</div><br><br>

<?php
include './footer.php';
?>

<script type="text/javascript">
    var status = 0;
    $(document).ready(
            function test()
            {


                $('select#status').on('change', function () {
                    status = $(this).val();
                    returnAll(status);
                });
            }
    );
    function returnAll(status) {
        $("#paymentTable").empty();
        $.ajax({
            type: 'POST',
            url: "../business/ReturnAllBuyAction.php",
            data: "status=" + status,
            success: function (data) {
                if (data.length === 2) {
                    $("#msg").html("<h2>Nothing to show!!</h2>");
                } else {
                    var instructor = JSON.parse(data);

                    var temp = '<tr>' +
                            '<td><strong>Marca</strong></td>' +
                            '<td><strong>Modelo</strong></td>' +
                            '<td><strong>Cantidad</strong></td>' +
                            '<td><strong>Num factura</strong></td>' +
                            '<td><strong>Proveedor</strong></td>' +
                            '<td><strong>Precio</strong></td>' +
                            '<td><strong>Tipo de pago</strong></td>' +
                            '<td><strong>Comprador</strong></td>' +
                            '<td><strong>Series</strong></td>' +
                            '<td><strong>Fecha de compra</strong></td>' +
//                '<td><strong>Campus gym</strong></td>' +
                            '<td><strong>Cantidad dañada</strong></td>' +
                            '</tr>';
                    $("#paymentTable").append(temp);

                    $.each(instructor, function (i, item) {
                        $("#msg").html("");
                        insertNewRow(item);
                    });
                }
            },
            error: function () {
            }
        }
        );
    }

    function update(idInventory, id) {
        var min = parseInt($("#quantity" + id).val());
        var max = parseInt($("#qu" + id).val());
        if (isNaN($('#quantity' + id).val())) {
            $("#msg").html("<p>La cantidad dañada debe ser un número!!!!</p>");
        } else if ($('#quantity' + id).val() === '') {
            $("#msg").html("<p>Ingrese la cantidad dañada!!!!</p>");
        } else if (min > max) {
            $("#msg").html("<p>El máximo es: " + max + "!!!</p>");
        } else {
            waste(idInventory, id);
        }


    }
    function insertNewRow(buy) {

        var pay = '';
        if (buy.paymentbuy === 0) {
            var pay = "Cash"
        } else {
            var pay = "Credit"
        }
        var temp = '<tr  id="' + buy.idbuy + '">' +
                '<td>' +
                '<input id="bra' + buy.idbuy + '" value="' + buy.brandbuy + '" readonly/>' +
                '</td>' +
                '<td>' +
                '<input id="mo' + buy.idbuy + '" value="' + buy.modelbuy + '" readonly/>' +
                '</td>' +
                '<td>' +
                '<input id="qu' + buy.idbuy + '" value="' + buy.quantityinventory + '" readonly/>' +
                '</td>' +
                '<td>' +
                '<input id="in' + buy.idbuy + '" value="' + buy.invoicenumberbuy + '" readonly/>' +
                '</td>' +
                '<td>' +
                '<input id="pro' + buy.idbuy + '" value="' + buy.providerbuy + '" readonly/>' +
                '</td>' +
                '<td>' +
                '<input id="pri' + buy.idbuy + '" value="' + '$' + buy.pricebuy + '" readonly/>' +
                '</td>' +
                '<td>' +
                '<input id="pay' + buy.idbuy + '" value="' + pay + '" readonly/>' +
                '</td>' +
                '<td>' +
                '<input id="bayer' + buy.idbuy + '" value="' + buy.buyerbuy + '" readonly/>' +
                '</td>' +
                '<td>' +
                '<input id="ser' + buy.idbuy + '" value="' + buy.seriesbuy + '" readonly/>' +
                '</td>' +
                '<td>' +
                '<input id="date' + buy.idbuy + '" value="' + buy.buydatebuy + '" readonly/>' +
                '</td>' +
//                '<td>' +
//                '<input id="hu' + '" value="' + 888 + '" readonly/>' +
//                '</td>' +
                '<td>' +
                '<INPUT id="quantity' + buy.idbuy + '" type="text" STYLE= "background-color: #F6D8CE;" " placeholder="Cantidad dañada" maxlength="' + buy.quantitybuy + '">' +
                '</td>' +
                '<td>' +
                '<input id="update' + buy.idbuy + '" type="button" onclick="update(' + buy.idinventory + ',' + buy.idbuy + ');" value="    Dañado    "/>' +
                '</td>' +
                '</tr>';
        $("#paymentTable").append(temp);
    }


    function waste(idInventory, id) {
        var qu = parseInt($("#quantity" + id).val());
        var infodata = "status=3&idInventory=" + idInventory + "&quantity=" + qu + "&id=" + id + "&option=3" + "";

        $.ajax({
            type: 'POST',
            url: "../business/InventoryAction.php",
            data: infodata,
            success: function (data) {
                $("#msg").html("<p>Success!!!!</p>");
                returnAll(status);
            },
            error: function (data) {
                $("#msg").html("<p>Error!!!!</p>");
            }
        });
    }//Fin de la función

</script>

