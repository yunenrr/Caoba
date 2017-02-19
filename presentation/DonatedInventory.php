<?php
include './header.php';
?>
<style type="text/css" media = "all">
</style>
<h2>Donated</h2>
<div>
    <table  border="1px" cellpadding="10px" >
        <tr>
            <td><strong>Marca</strong></td>
            <td><strong>Modelo</strong></td>
            <td><strong>Cantidad</strong></td>
            <td><strong>Donador</strong></td>
            <td><strong>Acreedor</strong></td>
            <td><strong>Serie</strong></td>
            <td><strong>Fecha de donación</strong></td>
            <td><strong>Ubicación en el gym</strong></td>
            <td><strong>Guardar</strong></td>
        </tr>
        <tr>
            <td><input id="bra"/>*</td>
            <td><input id="mo"/>*</td>
            <td><input id="qu"/>*</td>
            <td><input id="pro"/>*</td>
            <td><input id="cre"/>*</td>
            <td><input id="ser"/>*</td>
            <td><input id="date"/>*</td>
            <td><div id="campus"/></td>
            <td><input type="button" onclick="insertPaymentValidate();" value=" Guardar "/></td>
        </tr>
    </table>
    <table  id="paymentTable" border="1px" cellpadding="10px" ><br><br>
    </table>
    <div><p>Campos Requeridos(*)</p></div>
    <div id="msg"></div>
</div>

<?php
include './footer.php';
?>

<script type="text/javascript">
    $(document).ready(
            function test()
            {
                $('#date').mask('0000-00-00', {placeholder: 'yyyy-mm-dd'});
                returnAll();
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
        $("#cre").val("");
        $("#ser").val("");
        $("#date").val("");
        $.ajax({
            type: 'POST',
            url: "../business/ReturnAllBuyAction.php",
            data: "status=6",
            success: function (data) {
                var instructor = JSON.parse(data);

                var temp = '<tr>' +
                        '<td><strong>Marca</strong></td>' +
                        '<td><strong>Modelo</strong></td>' +
                        '<td><strong>Cantidad</strong></td>' +
                        '<td><strong>Donador</strong></td>' +
                        '<td><strong>Acreedor</strong></td>' +
                        '<td><strong>Serie</strong></td>' +
                        '<td><strong>Fecha de donación</strong></td>' +
                        '<td><strong>Ubicación en el gym</strong></td>' +
                        '</tr>';
                $("#paymentTable").append(temp);
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
            $("#msg").html("<p>Marca vacia!!!!</p>");
            result = 1;
        }
        if ($("#mo").val() === "") {
            $("#msg").html("<p>Modelo vacio!!!!</p>");
            result = 1;
        }
        if ($("#in").val() === "") {
            $("#msg").html("<p>num factura vacio!!!!</p>");
            result = 1;
        }
        if ($("#pro").val() === "") {
            $("#msg").html("<p>Proveedor vacio!!!!</p>");
            result = 1;
        }
        if ($("#pri").val() === "") {
            $("#msg").html("<p>Precio vacio!!!!</p>");
            result = 1;
        }
        if ($("#ser").val() === "") {
            $("#msg").html("<h1>Serie vacio!!!!</p>");
            result = 1;
        }
        if (isNaN($('#qu').val())) {
            $("#msg").html("<p>La cantidad debe ser un número!!!!</p>");
            result = 1;
        }
        if ($("#ser").val() === "") {
            $("#msg").html("<p>Cantidad vacia!!!!</p>");
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
        var dataInfo = "bra=" + $("#bra").val() + "&mo=" + $("#mo").val() + "&qu=" + $("#qu").val() + "&in=0" + "&pro=" + $("#pro").val() + "&pri=0" + "&pay=0" + "&bayer=" + $("#cre").val() + "&ser=" + $("#ser").val() + "&date=" + $("#date").val() + "&campus=" + $("#selCampus").val() + "&status=6" + "";

        $.ajax({
            type: 'POST',
            url: "../business/BuyInsertAction.php",
            data: dataInfo,
            success: function (data) {
                returnAll();
            },
            error: function (data) {
                returnAll();
            }
        });
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