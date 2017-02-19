<?php
include './header.php';
?>
<h2>Activos para reparar</h2>

<div>Seleccione a estado <select name="status" id='status'>
        <option value="0">SELECCIONE</option>
        <option value="1">Funcionamiento</option>
        <!--<option value="2">Reparación</option>-->
        <option value="4">Dañados en uso</option>
        <option value="6">Donados</option>
    </select><br><br><br>

</div>
<div>
    <table  id="repairTable" border="1px" cellpadding="10px" >
    </table>
    <div id="msg"></div>
</div><br><br>


<h2>Activos en reparación</h2>
<div>
    <table  id="RepairedTable" border="1px" cellpadding="10px" >
    </table>
    <div id="msgRecover"></div>
</div>

<?php
include './footer.php';
?>

<script type="text/javascript">
    var status = 0;
    $(document).ready(
            function test()
            {
                returnAllStole();

                $('select#status').on('change', function () {
                    status = $(this).val();
                    returnAll(status);
                });
            }
    );
    function returnAll(status) {
        $("#repairTable").empty();
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
                            '<td><strong>Num de factura</strong></td>' +
                            '<td><strong>Proveedor</strong></td>' +
                            '<td><strong>Precio</strong></td>' +
                            '<td><strong>Tipo de pagoo</strong></td>' +
                            '<td><strong>Comprador</strong></td>' +
                            '<td><strong>Series</strong></td>' +
                            '<td><strong>Fecha de compra</strong></td>' +
                            '<td><strong>Cantidad a reparar</strong></td>' +
                            '</tr>';
                    $("#repairTable").append(temp);

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
    function returnAllStole() {
        $("#RepairedTable").empty();
        $.ajax({
            type: 'POST',
            url: "../business/ReturnAllBuyAction.php",
            data: "status=2",
            success: function (data) {
                if (data.length === 2) {
                    $("#msgStole").html("<h2>Nothing to show!!</h2>");
                } else {
                    var instructor = JSON.parse(data);

                    var temp = '<tr>' +
                            '<td><strong>Marca</strong></td>' +
                            '<td><strong>Modelo</strong></td>' +
                            '<td><strong>Cantidad</strong></td>' +
                            '<td><strong>Num de factura</strong></td>' +
                            '<td><strong>Proveedor</strong></td>' +
                            '<td><strong>Precio</strong></td>' +
                            '<td><strong>Tipo de pago</strong></td>' +
                            '<td><strong>Comprador</strong></td>' +
                            '<td><strong>Series</strong></td>' +
                            '<td><strong>Fecha de compra</strong></td>' +
                            '<td><strong>Cantidad reparada</strong></td>' +
                            '</tr>';
                    $("#RepairedTable").append(temp);

                    $.each(instructor, function (i, item) {
                        $("#msg").html("");
                        insertNewRowStole(item);
                    });
                }
            },
            error: function () {
            }
        }
        );
    }
    function update(idinventory, id) {
        var min = parseInt($("#quantity" + id).val());
        var max = parseInt($("#qu" + id).val());
        if (isNaN($('#quantity' + id).val())) {
            $("#msg").html("<p>Quantity Stole it's not a number!!!!</p>");
        } else if ($('#quantity' + id).val() === '') {
            $("#msg").html("<p>Quantity Stole empty!!!!</p>");
        } else if (min > max) {
            $("#msg").html("<p>The maximum is: " + max + "!!!</p>");
        } else {
            repair(idinventory, id);
        }


    }
    function updateRecover(idinventory, id) {
        var min = parseInt($("#quantity2" + id).val());
        var max = parseInt($("#qu2" + id).val());
        if (isNaN($('#quantity2' + id).val())) {
            $("#msgRecover").html("<p>Recovered amount it's not a number!!!!</p>");
        } else if ($('#quantity2' + id).val() === '') {
            $("#msgRecover").html("<p>Recovered amount empty!!!!</p>");
        } else if (min > max) {
            $("#msgRecover").html("<p>The maximum is: " + max + "!!!</p>");
        } else {
            Repaired(idinventory, id);
        }


    }

    function insertNewRowStole(buy) {
        var pay = '';
        if (buy.paymentbuy === 0) {
            var pay = "Cash"
        } else {
            var pay = "Credit"
        }
        var temp = '<tr  id="' + buy.idbuy + '">' +
                '<td>' +
                '<input id="bra2' + buy.idbuy + '" value="' + buy.brandbuy + '" readonly/>' +
                '</td>' +
                '<td>' +
                '<input id="mo2' + buy.idbuy + '" value="' + buy.modelbuy + '" readonly/>' +
                '</td>' +
                '<td>' +
                '<input id="qu2' + buy.idbuy + '" value="' + buy.quantityinventory + '" readonly/>' +
                '</td>' +
                '<td>' +
                '<input id="in2' + buy.idbuy + '" value="' + buy.invoicenumberbuy + '" readonly/>' +
                '</td>' +
                '<td>' +
                '<input id="pro2' + buy.idbuy + '" value="' + buy.providerbuy + '" readonly/>' +
                '</td>' +
                '<td>' +
                '<input id="pri2' + buy.idbuy + '" value="' + '₡' + buy.pricebuy + '" readonly/>' +
                '</td>' +
                '<td>' +
                '<input id="pay2' + buy.idbuy + '" value="' + pay + '" readonly/>' +
                '</td>' +
                '<td>' +
                '<input id="bayer2' + buy.idbuy + '" value="' + buy.buyerbuy + '" readonly/>' +
                '</td>' +
                '<td>' +
                '<input id="ser2' + buy.idbuy + '" value="' + buy.seriesbuy + '" readonly/>' +
                '</td>' +
                '<td>' +
                '<input id="date2' + buy.idbuy + '" value="' + buy.buydatebuy + '" readonly/>' +
                '</td>' +
                '<td>' +
                '<INPUT id="quantity2' + buy.idbuy + '" type="text" STYLE= "background-color: #F6D8CE;" " placeholder="cantidad reparada" maxlength="' + buy.quantitybuy + '">' +
                '</td>' +
                '<td>' +
                '<input id="update2' + buy.idbuy + '" type="button" onclick="updateRecover(' + buy.idinventory + ',' + buy.idbuy + ');" value="    Reparado    "/>' +
                '</td>' +
                '</tr>';
        $("#RepairedTable").append(temp);
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
                '<td>' +
                '<INPUT id="quantity' + buy.idbuy + '" type="text" STYLE= "background-color: #F6D8CE;" " placeholder="cantidad a reparar" maxlength="' + buy.quantitybuy + '">' +
                '</td>' +
                '<td>' +
                '<input id="update' + buy.idbuy + '" type="button" onclick="update(' + buy.idinventory + ',' + buy.idbuy + ');" value="    Reparar    "/>' +
                '</td>' +
                '</tr>';
        $("#repairTable").append(temp);
    }


    function repair(idinventory, id) {
        var qu = parseInt($("#quantity" + id).val());
        var infodata = "status=2&idInventory=" + idinventory + "&quantity=" + qu + "&id=" + id + "&option=3" + "";

        $.ajax({
            type: 'POST',
            url: "../business/InventoryAction.php",
            data: infodata,
            success: function (data) {
                $("#msg").html("<p>Success!!!!</p>");
                returnAllStole();
                returnAll(status);
            },
            error: function (data) {
                $("#msg").html("<p>Error!!!!</p>");
            }
        });
    }//Fin de la función

    function Repaired(idinventory, id) {

        var qu = parseInt($("#quantity2" + id).val());
        var infodata = "status=1&idInventory=" + idinventory + "&quantity=" + qu + "&id=" + id + "&option=3" + "";
        $.ajax({
            type: 'POST',
            url: "../business/InventoryAction.php",
            data: infodata,
            success: function (data) {
                $("#msg").html("<p>Success!!!!</p>");
                returnAllStole();
                returnAll(status);
            },
            error: function (data) {
                $("#msg").html("<p>Error!!!!</p>");
            }
        });
    }//Fin de la función


</script>
