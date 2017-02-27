<?php
include './header.php';
include '../business/PersonBusiness.php';
include '../business/AddressBusiness.php';
include '../business/ScheduleClientBusiness.php';

$personBusiness = new PersonBusiness();
$neighborhoodBusiness = new AddressBussiness();
$clientScheduleBusiness = new ScheduleClientBusiness();
$invoice = new ScheduleClientData();

$id = $_GET['id'];
$abono = 0;
$total = 0;
$type = "";
$neighborhood = $neighborhoodBusiness->getAllAddress();
$check = $invoice->getInvoice($id);

$fechaactual = getdate();
$person = $personBusiness->getPerson($id);
$temp = "";
foreach ($neighborhood as $value) {
    if ($person->getAddressPerson() == $value->getIdAddress()) {
        $temp = $value->getNeighborhoodAddresss();
    }
}
?>
<style type="text/css" media = "all"></style>
<h2>Factura</h2>
<div id="factura">
    <table  border="1px" cellpadding="10px" >
        <tr>Sr(a):<u> <?php echo $person->getNamePerson() . " " . $person->getFirstNamePerson() . " " . $person->getSecondNamePerson() ?> </u></tr><br><br>
        <tr>Dirección: <u><?php echo $temp ?></u></tr><br><br>
        <tr>Fecha de emisión: <u><?php echo $fechaactual[mday] . "-" . $fechaactual[mon] . "-" . $fechaactual[year] ?></u></tr>
    </table>
    <table  id="invoice" border="1px" cellpadding="10px" ><br><br>
    </table>
</div>

<div id="factura">
    <table  border="1px" cellpadding="10px" >
        <tr>
            <td><strong>Servicio</strong></td>
            <td><strong>Descripción</strong></td>
            <td><strong>Pago</strong></td>
        </tr>

        <?php
        if (sizeof($check) > 0) {
            foreach ($check as $value) {
                if ($value["type"] == 2) {
                    $type = "Semanal";
                } else if ($value["type"] == 3) {
                    $type = "Quincenal";
                } else {
                    $type = "Mensual";
                }
                $abono += $value["abono"];
                $total += $value["total"];
                ?>

                <tr>
                    <td><strong><?php echo $value["name"] ?></strong></td>
                    <td><strong><?php echo $value["descrip"] ?></strong></td>
                    <td><strong>₡<?php echo $value["abono"] ?></strong></td>
                </tr>
                <?php
            }
        }
        ?>
        <tr>
            <td><strong></strong></td>
            <td><strong>Tipo de pago: <?php echo $type ?></strong></td>
            <td><strong>Saldo total: ₡<?php echo $abono ?></strong></td>
            <!--<td><strong>Saldo total: ₡<?php echo $total ?></strong></td>-->
        </tr>
    </table>
    <input type="button" value="Pagar" onclick="pagar()"/>
</div>

<?php
include './footer.php';
?>
<script type="text/javascript">
    $(document).ready(
            function()
            {
                cuentas();
            }
    );
    function cuentas() {
        $.ajax({
            type: 'POST',
            url: "../business/InvoiceAction.php",
            data: "option=1&id=" +<?php echo $id ?>,
            success: function (data) {
//              location.reload(true);
            },
            error: function (data) {
            }
        });
    }
    function pagar() {
        $.ajax({
            type: 'POST',
            url: "../business/InvoiceAction.php",
            data: "option=2&id=" +<?php echo $id ?>,
            success: function (data) {
                if (data === "1") {
                    $("factura").html("El pago se realizó de forma exitosa");
                    alert("El pago se realizó de forma exitosa");
                }
            },
            error: function (data) {
            }
        });
    }
</script>
