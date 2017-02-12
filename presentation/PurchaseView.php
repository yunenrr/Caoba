<?php
include './header.php';
?>
<style type="text/css" media = "all">

    /*#paymentTable tr:nth-child(3){
    background: red;
    
    
    }*/

</style>
<div>
    <table  border="1px" cellpadding="10px" >
        <tr>
            <td><strong>Trademark</strong></td>
            <td><strong>Serie</strong></td>
            <td><strong>Supplier</strong></td>
            <td><strong>Price</strong></td>
            <td><strong>Paymenttype</strong></td>
            <td><strong></strong></td>
        </tr>
        <tr>
            <td> <input  id="tra"/>  </td>
            <td><input  id="se"/>  </td>
            <td><input  id="su"/>  </td>
            <td><input id="pri"/>  </td>
            <td> <select id="pay">         <option value="0">Cash Payment</option>   <option value="1">Credit Payment</option>   </select> </td>  
            <td><input type="button" onclick="insertPaymentValidate();" value=" INSERT "/></td>
        </tr>
    </table>
    <table  id="paymentTable" border="1px" cellpadding="10px" >
<!--        <tr>
            <td><input/>  </td>
            <td><input/>  </td>
            <td><input/>  </td>
            <td><input/>  </td>
            <td><input type="button" value="INSERTAR"/></td>
            <td> <select>         <option>Cash Payment</option>   <option>Credit Payment</option>   </select> </td>  
            <td><input type="button" value="UPDATE"/></td>
        </tr>-->
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
//                    for (var i = 0, max = 4; i < max; i++) {
//                        insertNewRow(i);
//                    }
                    returnAll();
                }
        );

        function returnAll() {
//            alert('tyxsxspes[i]');
            $("#paymentTable").empty();
            $("#tra").val("");
            $("#se").val("");
            $("#su").val("");
            $("#pri").val("");

            $.ajax({
                type: 'POST',
                url: "../business/ReturnAllPurchaseAction.php",
                success: function (data) {
                    var instructor = JSON.parse(data);
                    $.each(instructor, function (i, item) {
//                        alert(item.idpurchase);
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
            if ($("#tra").val() === "") {
                $("#msg").append("<h1>Mark empty!!!!</h1>");
                result = 1;
            }
            if ($("#se").val() === "") {
                $("#msg").append("<h1>Serie empty!!!!</h1>");
                result = 1;
            }
            if ($("#su").val() === "") {
                $("#msg").append("<h1>Suplier empty!!!!</h1>");
                result = 1;
            }
            if ($("#pri").val() === "") {
                $("#msg").append("<h1>Price empty!!!!</h1>");
                result = 1;
            }
            if (isNaN($('#se').val())) {
                $("#msg").append("<h1>Serie it's not a number!!!!</h1>");
                result = 1;
            }
            if (isNaN($('#pri').val())) {
                $("#msg").append("<h1>Price it's not a number!!!!</h1>");
                result = 1;
            }
            if (result === 1) {
                return 1;
            } else {
                insert();
                return 0;
            }


//            return result;
        }
        function insert() {
            $.ajax
                    (
                            {
                                type: 'POST',
                                url: "../business/PurchaseInsertAction.php",
                                data: "tra=" + $("#tra").val() + "&se=" + $("#se").val() + "&su=" + $("#su").val() + "&pri=" + $("#pri").val() + "&pay=" + $("#pay").val() + "",
                               
                                success: function (data)
                                {
                                    
                                    returnAll();

                                   
//                                    $("#msg").html("<p>Inserted.</p>");
                                }
                               
                            }
                    );
        }
        function update(id) {
            $.ajax
                    (
                            {
                                type: 'POST',
                                url: "../business/PurchaseUpdateAction.php",
                                data: "id=" + id + "&tra=" + $("#tra" + id).val() + "&se=" + $("#se" + id).val() + "&su=" + $("#su" + id).val() + "&pri=" + $("#pri" + id).val() + "&pay=" + $("#pay" + id).val() + "",
                                beforeSend: function (before)
                                {
//                                    $("#msg").html("<p>Sent.</p>");
                                },
                                success: function (data)
                                {
                                    returnAll();
//                                    $("#msg").html("<p>Inserted.</p>");
                                },
                                error: function ()
                                {
//                                    alert('no');
//                                    $("#msg").html("<p>Error.</p>");
                                }
                            }
                    );
        }
        function validateUpdate(id) {
           
            if (validate(id) === 0) {
                update(id);
            }
        }
        function validate(id) {

            var result = 0;
            $("#msg").empty();
            if ($("#tra" + id).val() === "") {
                $("#msg").append("<h1>Mark empty!!!!</h1>");
                result = 1;
            }
            if ($("#se" + id).val() === "") {
                $("#msg").append("<h1>Serie empty!!!!</h1>");
                result = 1;
            }
            if ($("#su" + id).val() === "") {
                $("#msg").append("<h1>Suplier empty!!!!</h1>");
                result = 1;
            }
            if ($("#pri" + id).val() === "") {
                $("#msg").append("<h1>Price empty!!!!</h1>");
                result = 1;
            }
            if (isNaN($('#se' + id).val())) {
                $("#msg").append("<h1>Serie it's not a number!!!!</h1>");
                result = 1;
            }
            if (isNaN($('#pri' + id).val())) {
                $("#msg").append("<h1>Price it's not a number!!!!</h1>");
                result = 1;
            }
            return result;
        }
        function updateControlsEnable(id) {
          
            $("#tra" + id).removeAttr("readonly");
            $("#se" + id).removeAttr("readonly");
            $("#su" + id).removeAttr("readonly");
            $("#pri" + id).removeAttr("readonly");
            $("#pay" + id).removeAttr("disabled");
            var num = $('#paymentTable tr').length - 1;

            for (var i = 1; i <= num + 1; i++) {


                var numa = $("#paymentTable tr:nth-child(" + i + ")").attr("id");


//                $("#paymenttype" + id).removeAttr("disabled");
                if (numa + '' !== id + '') {
//                    alert('qsdasd');
                    $("#update" + numa).attr("disabled", "true");
                    $("#save" + numa).attr("disabled", "true");
                } else {
//                    alert('111');
                    $("#save" + id).removeAttr("disabled");
                    $("#update" + id).attr("disabled", "true");
                }
            }

        }
        function insertNewRow(purchase) {
            var temp = '<tr  id="' + purchase.idpurchase + '">' +
                    '<td>' +
                    '<input id="tra' + purchase.idpurchase + '" value="' + purchase.trademarkpurchase + '" readonly/>' +
                    '</td>' +
                    '<td>' +
                    '<input id="se' + purchase.idpurchase + '" value="' + purchase.seriepurchase + '" readonly/>' +
                    '</td>' +
                    '<td>' +
                    '<input id="su' + purchase.idpurchase + '" value="' + purchase.supplierpurchase + '" readonly/>' +
                    '</td>' +
                    '<td>' +
                    '<input id="pri' + purchase.idpurchase + '" value="' + purchase.pricepurchase + '" readonly/>' +
                    '</td>' +
                    '<td>' +
                    '<select id="pay' + purchase.idpurchase + '" disabled="true"><option value="0" >Cash Payment</option><option  value="1">Credit Payment</option></select>' +
                    '</td>' +
                    '<td>' +
                    '<input id="update' + purchase.idpurchase + '" type="button" onclick="updateControlsEnable(' + purchase.idpurchase + ');" value="    UPDATE    "/>' +
                    '</td>' +
                    '<td>' +
                    '<input id="save' + purchase.idpurchase + '" type="button" onclick="validateUpdate(' + purchase.idpurchase + ');" value="SAVE" disabled/>' +
                    '</td>' +
                    '</tr>';
            $("#paymentTable").append(temp);
        }
    </script>

