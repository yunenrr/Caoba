<?php
include './header.php';
?>
<h2>Inventario</h2>

<div>Seleccione un estado <select name="status" id='status'>
        <option value="0">SELECCIONE</option>
        <option value="1">Funcionamiento</option>
        <option value="2">Reparación</option>
        <option value="3">Desecho</option>
        <option value="4">Dañado en uso</option>
        <option value="5">Robado</option>
        <option value="6">Donado</option>
        <option value="7">Donación</option>
    </select><br><br><br>

</div>
<div>
    <table  id="paymentTable" border="2" cellpadding="10px" >
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
                    $("#msg").html("<h2>Sin datos para mostrar!!</h2>");
                } else {
                    $("#paymentTable").empty();

                    var instructor = JSON.parse(data);

                    if (status !== '6') {
                        var temp = '<tr>' +
                                '<td><strong>Marca</strong></td>' +
                                '<td><strong>Modelo</strong></td>' +
                                '<td><strong>Cantidad</strong></td>' +
                                '<td><strong>Número de factura</strong></td>' +
                                '<td><strong>Proveedor</strong></td>' +
                                '<td><strong>Precio</strong></td>' +
                                '<td><strong>Tipo de pago</strong></td>' +
                                '<td><strong>Comprador</strong></td>' +
                                '<td><strong>Serie</strong></td>' +
                                '<td><strong>Fecha de Compra</strong></td>' +
                                '<td><strong>Ubicación en el Gym</strong></td>' +
                                '</tr>';
                        $("#paymentTable").append(temp);
                    } else {
                        var temp = '<tr>' +
                                '<td><strong>Marca</strong></td>' +
                                '<td><strong>Modelo</strong></td>' +
                                '<td><strong>Cantidad</strong></td>' +
                                '<td><strong>Donador</strong></td>' +
                                '<td><strong>Acreedor</strong></td>' +
                                '<td><strong>Serie</strong></td>' +
                                '<td><strong>Fecha de donación</strong></td>' +
                                '<td><strong>Ubicación en el Gym</strong></td>' +
                                '</tr>';
                        $("#paymentTable").append(temp);
                    }
                    $.each(instructor, function (i, item) {
                        $("#msg").html("");
                        if (status === '6') {
                            insertNewRowDonated(item);

                        } else {
                            insertNewRow(item);
                        }
                    });
                }
            },
            error: function () {
            }
        }
        );
    }
    function insertNewRow(buy) {

        var pay = '';
        if (buy.paymentbuy === 0) {
            var pay = "Efectivo"
        } else {
            var pay = "Crédito"
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
                '<input id="hu' + '" value="' + buy.namecampus + '" readonly/>' +
                '</td>' +
                '</tr>';
        $("#paymentTable").append(temp);
    }



    function insertNewRowDonated(buy) {

        var pay = '';
        if (buy.paymentbuy === 0) {
            var pay = "Efectivo"
        } else {
            var pay = "Crédito"
        }
        var temp = '<tr  id="' + buy.idbuy + '">' +
                '<td>' +
                '<input id="bra' + buy.idbuy + '" value="' + buy.brandbuy + '" readonly/>' +
                '</td>' +
                '<td>' +
                '<input id="mo' + buy.idbuy + '" value="' + buy.modelbuy + '" readonly/>' +
                '</td>' +
                '<td>' +
                '<input id="qu' + buy.idbuy + '" value="' + buy.quantitybuy + '" readonly/>' +
                '</td>' +
                '<td>' +
                '<input id="pro' + buy.idbuy + '" value="' + buy.providerbuy + '" readonly/>' +
                '</td>' +
                '<td>' +
                '<input id="cre' + buy.idbuy + '" value="' + buy.buyerbuy + '" readonly/>' +
                '</td>' +
                '<td>' +
                '<input id="ser' + buy.idbuy + '" value="' + buy.seriesbuy + '" readonly/>' +
                '</td>' +
                '<td>' +
                '<input id="date' + buy.idbuy + '" value="' + buy.buydatebuy + '" readonly/>' +
                '</td>' +
                '<td>' +
                '<input id="hu' + '" value="' + buy.namecampus + '" readonly/>' +
                '</td>' +
                '</tr>';
        $("#paymentTable").append(temp);
    }
</script>