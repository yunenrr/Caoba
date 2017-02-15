<?php
include './header.php';
?>
<h2>Inventory</h2>

<div>Select a status <select name="status" id='status'>
        <option value="0">Select</option>
        <option value="1">Functionary</option>
        <option value="2">Repair</option>
        <option value="3">Waste</option>
        <option value="4">Damage in use</option>
        <option value="5">Stolen</option>
        <option value="6">Donated</option>
        <option value="7">Donation</option>
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
                    $("#msg").html("<h2>Nothing to show!!</h2>");
                } else {
                    var instructor = JSON.parse(data);
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
            var pay = "Cash"
        } else {
            var pay = "Credit"
        }
        var temp = '<tr>' +
                '<td><strong>Brand</strong></td>' +
                '<td><strong>Model</strong></td>' +
                '<td><strong>Quantity</strong></td>' +
                '<td><strong>Invoice num</strong></td>' +
                '<td><strong>Provider</strong></td>' +
                '<td><strong>Price</strong></td>' +
                '<td><strong>Payment type</strong></td>' +
                '<td><strong>Bayer</strong></td>' +
                '<td><strong>Series</strong></td>' +
                '<td><strong>Date</strong></td>' +
                '<td><strong>Location Gym</strong></td>' +
                '</tr>';
        $("#paymentTable").append(temp);
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
            var pay = "Cash"
        } else {
            var pay = "Credit"
        }
        var temp = '<tr>' +
                '<td><strong>Brand</strong></td>' +
                '<td><strong>Model</strong></td>' +
                '<td><strong>Quantity</strong></td>' +
                '<td><strong>Donor</strong></td>' +
                '<td><strong>Creditor</strong></td>' +
                '<td><strong>Series</strong></td>' +
                '<td><strong>Date</strong></td>' +
                '<td><strong>Campus gym</strong></td>' +
                '</tr>';
        $("#paymentTable").append(temp);
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