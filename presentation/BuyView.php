<?php
include './header.php';
include '../business/PersonBusiness.php';

?>
<style type="text/css" media = "all">
</style>
<h2>Compra de equipo</h2>
<div>
    <table  border="1px" cellpadding="10px" >
        <tr>
            <td><strong>Marca</strong></td>
            <td><strong>Modelo</strong></td>
            <td><strong>Cantidad</strong></td>
            <td><strong>Número de factura</strong></td>
            <td><strong>Proveedor</strong></td>
            <td><strong>Precio</strong></td>
            <td><strong>Tipo de pago</strong></td>
            <td><strong>Comprador</strong></td>
            <td><strong>Series</strong></td>
            <td><strong>Fecha de compra</strong></td>
            <td><strong>Ubicación en el gym</strong></td>
        </tr>
        <tr>
            <td><input id="bra"/>  *</td>
            <td><input id="mo"/>  *</td>
            <td><input id="qu"/> * </td>
            <td><input id="in"/>  *</td>
            <td><input id="pro"/> * </td>
            <td><input id="pri"/> * </td>
            <td><select id="pay"><option value="0">Efectivo</option>   <option value="1">Credito</option>   </select> </td>  
            <td><input id="bayer"/>  *</td>
            <td><input id="ser"/>  *</td>
            <td><input id="date"/> * </td>
            <td><div id="campus"/> </td>
            <td><input type="button" onclick="insertPaymentValidate();" value=" INSERT "/></td>
        </tr>
    </table>
    <table  id="paymentTable" border="1px" cellpadding="10px" ><br><br>
    </table>
    <div id="msg"></div>
    <div><p>Requiered fields(*)</p></div>
</div>

<?php
include './footer.php';
?>

<script type="text/javascript">
    $(document).ready(
            function test()
            {
                returnAll();
                $('#date').mask('00-00-0000', {placeholder: 'dd/mm/yyyy'});
                $('#pri').mask('$9999999999999', {placeholder: '$'});
                $("#date").datepicker();
                var arrayCampus = "";
                getCampus();
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
        $("#bayer").val("");
        $("#ser").val("");
        $("#date").val("");



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
        $.ajax({
            type: 'POST',
            url: "../business/ReturnAllBuyAction.php",
            data: "status=1",
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
        if ($("#ser").val() === "") {
            $("#msg").append("<h1>Quantity empty!!!!</h1>");
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
        var pri = parseInt($("#pri").val().substring(1, $("#pri").val().length));
        var infoData = "bra=" + $("#bra").val() + "&mo=" + $("#mo").val() + "&qu=" + $("#qu").val() + "&in=" + $("#in").val() + "&pro=" + $("#pro").val() + "&pri=" + pri + "&pay=" + $("#pay").val() + "&bayer=" + $("#bayer").val() + "&ser=" + $("#ser").val() + "&date=" + $("#date").val() + "&campus=" + $("#selCampus").val() + "&status=1" + "";

        $.ajax({
            type: 'POST',
            url: "../business/BuyInsertAction.php",
            data: infoData,
            success: function (data) {
                returnAll();
            },
            error: function (data) {
                returnAll();
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
        $("#msg").empty();
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
//        $("#qu" + id).removeAttr("readonly");
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
        var pay = '';
        if (buy.paymentbuy === '0') {
            var pay = "Efectivo";
        } else {
            var pay = "Credito";
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
                '<input id="in' + buy.idbuy + '" value="' + buy.invoicenumberbuy + '" readonly/>' +
                '</td>' +
                '<td>' +
                '<input id="pro' + buy.idbuy + '" value="' + buy.providerbuy + '" readonly/>' +
                '</td>' +
                '<td>' +
                '<input id="pri' + buy.idbuy + '" value="' + '$' + buy.pricebuy + '" readonly/>' +
                '</td>' +
                '<td>' +
                '<input id="pri' + buy.idbuy + '" value="' + pay + '" readonly/>' +
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
                '<input id="ca' + buy.idbuy + '" value="' + buy.namecampus + '" readonly/>' +
                '</td>' +
//                '<td>' +
//                '<input id="update' + buy.idbuy + '" type="button" onclick="updateControlsEnable(' + buy.idbuy + ');" value="    UPDATE    "/>' +
//                '</td>' +
//                '<td>' +
//                '<input id="save' + buy.idbuy + '" type="button" onclick="validateUpdate(' + buy.idbuy + ');" value="SAVE" disabled/>' +
//                '</td>' +
                '</tr>';
        getCampus();
        $("#paymentTable").append(temp);
    }

    function getCampus() {
        $.ajax({
            type: 'POST',
            url: "../business/CampusBusiness.php",
            data: "option=1",
            success: function (data) {
                if (data.toString().length > 0)
                {
                    arrayCampus = data.split(";");
                }
                getSelect();
            },
            error: function (data) {
            }
        });
    }//Fin de la función

    function getSelect()
    {
        var temp = '<select id="selCampus' + '" name="selCampus' + '">';
        for (var i = 0; i < arrayCampus.length; i++)
        {
            var campus = arrayCampus[i].split(",");
            temp = temp + '<option value="' + campus[0] + '" >' + campus[1] + '</option>';
        }//Fin del for
        temp = temp + '</select>';
        $("#campus").html(temp);
        return temp;
    }//Fin de la función
</script>