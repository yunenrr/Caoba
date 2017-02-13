<?php
include './header.php';
?>
<style type="text/css" media = "all">
</style>
<div>
    <table  border="1px" cellpadding="10px" >
        <tr>
            <td><strong>Brand</strong></td>
            <td><strong>Modelbuy</strong></td>
            <td><strong>Quantity</strong></td>
            <td><strong>Invoicenum</strong></td>
            <td><strong>Provider</strong></td>
            <td><strong>Price</strong></td>
            <td><strong>Payment</strong></td>
            <td><strong>Series</strong></td>
            <td><strong></strong></td>
        </tr>
        <tr>
            <td> <input  id="bra"/>  </td>
            <td><input  id="mo"/>  </td>
            <td><input  id="qu"/>  </td>
            <td><input id="in"/>  </td>
            <td><input id="pro"/>  </td>
            <td><input id="pri"/>  </td>
            <td> <select id="pay">         <option value="0">Cash Payment</option>   <option value="1">Credit Payment</option>   </select> </td>  
            <td><input id="ser"/>  </td>
            <td><input type="button" onclick="insertPaymentValidate();" value=" INSERT "/></td>
        </tr>
    </table>
    <table  id="paymentTable" border="1px" cellpadding="10px" >
    </table>
    <div id="msg"></>
    </div>

    <?php
    include './footer.php';
    ?>

    <script type="text/javascript">
        $(document).ready(
                function test()
                {
                    returnAll();
                }
        );

        function returnAll() {
            $("#paymentTable").empty();
            $("#bra").val("");
            $("#mo").val("");
            $("#qu").val("");
            $("#in").val("");
            $("#pro").val("");
            $("#pri").val("");
            $("#ser").val("");
            $.ajax({
                type: 'POST',
                url: "../business/ReturnAllBuyAction.php",
                success: function (data) {
                    var instructor = JSON.parse(data);
                    $.each(instructor, function (i, item) {
                        insertNewRow(item);
                    });
                },
                error: function () {
                }
            }
            );
        }
        function insertPaymentValidate(id) {
            var result = 0;
            $("#msg").empty();
            if ($("#bra").val() === "") {
                $("#msg").append("<h1>Brandbuy empty!!!!</h1>");
                result = 1;
            }
            if ($("#mo").val() === "") {
                $("#msg").append("<h1>Modelbuy empty!!!!</h1>");
                result = 1;
            }
            if ($("#in").val() === "") {
                $("#msg").append("<h1>Invoicenumberbuy empty!!!!</h1>");
                result = 1;
            }
            if ($("#pro").val() === "") {
                $("#msg").append("<h1>Providerbuy empty!!!!</h1>");
                result = 1;
            }
            if ($("#pri").val() === "") {
                $("#msg").append("<h1>Pricebuy empty!!!!</h1>");
                result = 1;
            }
            if ($("#ser").val() === "") {
                $("#msg").append("<h1>Seriesbuy empty!!!!</h1>");
                result = 1;
            }
            if (isNaN($('#qu').val())) {
                $("#msg").append("<h1>QuantityBuy it's not a number!!!!</h1>");
                result = 1;
            }
            if (isNaN($('#in').val())) {
                $("#msg").append("<h1>InvoiceBuy it's not a number!!!!</h1>");
                result = 1;
            }
            if (isNaN($('#pri').val())) {
                $("#msg").append("<h1>PriceBuy it's not a number!!!!</h1>");
                result = 1;
            }
            if (result === 1) {
                return 1;
            } else {
                insert();
                return 0;
            }
        }
        function insert() {
            $.ajax({
                type: 'POST',
                url: "../business/BuyInsertAction.php",
                data: "bra=" + $("#bra").val() + "&mo=" + $("#mo").val() + "&qu=" + $("#qu").val() + "&in=" + $("#in").val() + "&pro=" + $("#pro").val() + "&pri=" + $("#pri").val() + "&pay=" + $("#pay").val() + "&ser=" + $("#ser").val() + "",
                success: function (data) {
                    returnAll();
//                    alert(data);
                },
                error: function (data) {
                    returnAll();
//                    alert(data);
                }
            });
        }
        function update(id) {
            $.ajax({
                type: 'POST',
                url: "../business/BuyUpdateAction.php",
                data: "id=" + id + "&bra=" + $("#bra" + id).val() + "&mo=" + $("#mo" + id).val() + "&qu=" + $("#qu" + id).val() + "&in=" + $("#in" + id).val() + "&pro=" + $("#pro" + id).val() + "&pri=" + $("#pri" + id).val() + "&pay=" + $("#pay" + id).val() + "&ser=" + $("#ser" + id).val() + "",
                beforeSend: function (before)
                {
                },
                success: function (data)
                {
//                    alert(data);
//                    alert("id=" + id + "&bra=" + $("#bra" + id).val() + "&mo=" + $("#mo" + id).val() + "&qu=" + $("#qu" + id).val() + "&in=" + $("#in" + id).val() + "&pro=" + $("#pro" + id).val() + "&pri=" + $("#pri" + id).val() + "&pay=" + $("#pay" + id).val() + "&ser=" + $("#ser" + id).val() + "");
//                    alert(id);
                    returnAll();
                },
                error: function (data)
                {

//                    alert(data);
                }
            }
            );
        }
        function validateUpdate(id) {
//            alert('vf');
            if (validate(id) === 0) {
//                alert('vfcd');
                update(id);
            }
        }
        function validate(id) {
            var result = 0;
            $("#msg" ).empty();
            if ($("#bra" + id).val() === "") {
                $("#msg").append("<h1>Brandbuy empty!!!!</h1>");
                result = 1;
            }
            if ($("#mo" + id).val() === "") {
                $("#msg").append("<h1>Modelbuy empty!!!!</h1>");
                result = 1;
            }
            if ($("#in" + id).val() === "") {
                $("#msg").append("<h1>Invoicenumberbuy empty!!!!</h1>");
                result = 1;
            }
            if ($("#pro" + id).val() === "") {
                $("#msg").append("<h1>Providerbuy empty!!!!</h1>");
                result = 1;
            }
            if ($("#pri" + id).val() === "") {
                $("#msg").append("<h1>Pricebuy empty!!!!</h1>");
                result = 1;
            }
            if ($("#ser" + id).val() === "") {
                $("#msg").append("<h1>Seriesbuy empty!!!!</h1>");
                result = 1;
            }
            if (isNaN($('#qu' + id).val())) {
                $("#msg").append("<h1>QuantityBuy it's not a number!!!!</h1>");
                result = 1;
            }
            if (isNaN($('#in' + id).val())) {
                $("#msg").append("<h1>InvoiceBuy it's not a number!!!!</h1>");
                result = 1;
            }
            if (isNaN($('#pri' + id).val())) {
                $("#msg").append("<h1>PriceBuy it's not a number!!!!</h1>");
                result = 1;
            }

            return result;
        }
        function updateControlsEnable(id) {
            $("#bra" + id).removeAttr("readonly");
            $("#mo" + id).removeAttr("readonly");
            $("#qu" + id).removeAttr("readonly");
            $("#in" + id).removeAttr("readonly");
            $("#pro" + id).removeAttr("readonly");
            $("#pri" + id).removeAttr("readonly");
            $("#ser" + id).removeAttr("readonly");
            $("#pay" + id).removeAttr("disabled");
            var num = $('#paymentTable tr').length - 1;
            for (var i = 1; i <= num + 1; i++) {
                var numa = $("#paymentTable tr:nth-child(" + i + ")").attr("id");
                if (numa + '' !== id + '') {
                    $("#update" + numa).attr("disabled", "true");
                    $("#save" + numa).attr("disabled", "true");
                } else {
                    $("#save" + id).removeAttr("disabled");
                    $("#update" + id).attr("disabled", "true");
                }
            }

        }
        function insertNewRow(buy) {
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
                    '<input id="in' + buy.idbuy + '" value="' + buy.invoicenumberbuy + '" readonly/>' +
                    '</td>' +
                    '<td>' +
                    '<input id="pro' + buy.idbuy + '" value="' + buy.providerbuy + '" readonly/>' +
                    '</td>' +
                    '<td>' +
                    '<input id="pri' + buy.idbuy + '" value="' + buy.pricebuy + '" readonly/>' +
                    '</td>' +
                    '<td>' +
                    '<select id="pay' + buy.idbuy + '" disabled="true"><option value="0" >Cash Payment</option><option  value="1">Credit Payment</option></select>' +
                    '</td>' +
                    '<td>' +
                    '<input id="ser' + buy.idbuy + '" value="' + buy.seriesbuy + '" readonly/>' +
                    '</td>' +
                    '<td>' +
                    '<input id="update' + buy.idbuy + '" type="button" onclick="updateControlsEnable(' + buy.idbuy + ');" value="    UPDATE    "/>' +
                    '</td>' +
                    '<td>' +
                    '<input id="save' + buy.idbuy + '" type="button" onclick="validateUpdate(' + buy.idbuy + ');" value="SAVE" disabled/>' +
                    '</td>' +
                    '</tr>';
            $("#paymentTable").append(temp);
        }
    </script>

