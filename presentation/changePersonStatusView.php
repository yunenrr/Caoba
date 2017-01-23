<?php
include './header.php'; //header include
include '../business/PersonBusiness.php'; //person bussiness include
include '../business/PersonStateBusiness.php'; //personState bussiness include
?> 
<!--HTML container for clients-->
<div align="center"> 
    <!--to send ajax data-->
    <form id="form"></form> 
    <!--Clients list title-->
    <h1>CLIENTS STATUS</h1> 
    <!--table client list-->
    <table border="1px" cellpadding="15px">
        <!--table head-->
        <thead>
            <!--head row-->
            <tr>
                <!--columns-->
                <td><strong>ID</strong></td>
                <td><strong>DNI</strong></td>
                <td><strong>NAME</strong></td>
                <td><strong>LAST NAME</strong></td>
                <td><strong>LAST NAME</strong></td>
                <td><strong>AGE</strong></td>
                <td><strong>GE</strong></td>
                <td><strong>EMAIL</strong></td>
                <td><strong>ADDRESS</strong></td>
                <td><strong>DEFINE STATUS</strong></td>
                <td><strong>ENABLE</strong></td>
                <td><strong>DISABLE</strong></td>
                <td><strong>Measurement</strong></td>
            </tr>
        </thead>
        <!--table body-->
        <tbody>
            <?php
            //Instance for get clients list           
            $personBusiness = new personBusiness(); //Instance of person bussiness
            $personArray = $personBusiness->returnPersonsByTypeBusiness(0); //Returns clients
            //Instance for get state           
            $PersonStateBusiness = new personStateBusiness(); //Instance of personstate bussiness
            if (is_array($personArray)) {
                foreach ($personArray as $currentPerson) {
                    $state = $PersonStateBusiness->getPersonStateBusiness($currentPerson->getDniPerson()); //Returns state fro current client
                    $id = $currentPerson->getDniPerson();
                    $statusEdit = "disabled";
                    $statusEnable = "disabled";
                    $statusDisable = "disabled";
                    $action = "update";
                    if ($state == -1) {
                        $statusEdit = "enable";
                        $action = "insert";
                    } else if ($state == 1) {
                        $statusDisable = "enable";
                    } else {
                        $statusEnable = "enable";
                    }
                    ?>
                    <tr id="<?= $currentPerson->getDniPerson(); ?>" value="<?= $state; ?>">
                        <td align="center"><?= $currentPerson->getIdPerson(); ?></td>
                        <td align="center"><?= $currentPerson->getDniPerson(); ?></td>
                        <td align="center"><?= $currentPerson->getNamePerson(); ?></td>
                        <td align="center"><?= $currentPerson->getFirstNamePerson(); ?></td>
                        <td align="center"><?= $currentPerson->getSecondNamePerson(); ?></td>
                        <td align="center"><?= $currentPerson->getAgePerson(); ?></td>
                        <td align="center"><?= $currentPerson->getGenderPerson(); ?></td>
                        <td align="center"><?= $currentPerson->getEmailPerson(); ?></td>
                        <td align="center"><?= $currentPerson->getAddressPerson(); ?></td>
                        <td align="center"><input id="<?= 'btnEdit' . $currentPerson->getDniPerson(); ?>" onclick="<?= 'enableButtons(' . $currentPerson->getDniPerson() . ')' ?>" type="button"  value="  EDIT  " <?= $statusEdit; ?>/></td>
                        <td align="center" ><input id="<?= 'btnEna' . $id; ?>" onclick="<?= '' . $action . '(' . $id . ',' . 1 . ')' ?>" type="button"  value="  ENABLE  "  <?= $statusEnable . ""; ?> /></td>
                        <td align="center" ><input id="<?= 'btnDis' . $id; ?>" onclick="<?= '' . $action . '(' . $id . ',' . 0 . ')' ?>" type="button"  value="  DISABLE  " <?= $statusDisable . ""; ?> /> </td>
                        <td align="center"><a href="./MeasurementView.php?dni=<?= $currentPerson->getDniPerson(); ?>"> Set Measurement</a></td>
                    </tr>
                    <?php
                }
            }
            ?> 
        </tbody>
    </table>
    <h1>MASK</h1> 
    <table border="1px" cellpadding="15px">
        <!--table head-->
        <thead>
            <!--head row-->
            <tr>
                <!--columns-->
                <td><strong>MASK NAME</strong></td>
                <td><strong>MASK INPUT</strong></td>
            </tr>
        </thead>
        <!--table body-->
        <tbody>
            <tr>
                <td align="center"> <label>Hour</label></td> 
                <td align="center"><input type="text" class="time"/></td>  
            </tr>
            <tr>
                <td align="center"><label>Money</label></td>
                <td align="center"><input type="text" class="money"/></td>
            </tr>
        </tbody>
    </table>
</div>
<?php
//footer include    
include './footer.php'
?>
<script  type="text/javascript">
    $(document).ready(function () {
        $('.time').mask('YA:F0', {'translation': {
                Y: {pattern: /[0-2]/},
                A: {pattern: /[0-3]/},
                F: {pattern: /[0-5]/}
            }
        });
        $('.money').mask(' ₡ 0.000.000,00', {reverse: true});
    });
    function enableButtons(id) {
        $('#btnEdit' + id).attr("disabled", "false");
        $('#btnEna' + id).removeAttr('disabled');
        $('#btnDis' + id).removeAttr('disabled');
        alert("d");
    }

    function insert(id, ban) {
        alert('d');
        if ($('#' + id).attr('value') !== '-1') {
            update(id, ban);
            alert('ddd');
        } else {
            alert('dc');
            var data = $('#form' + id).serializeArray();
            data.push({name: 'state', value: ban});
            data.push({name: 'id', value: id});
            ajaxRequest(data, '../business/PersonStateInsertAction.php');
            if (ban === 1) {
                alert('dm');
                $('#btnEna' + id).attr("disabled", "false");
                $('#' + id).val('0');
                $('#' + id).attr('value', '1');
            } else {
                $('#btnDis' + id).attr("disabled", "false");
                $('#' + id).attr('value', '0');
            }
        }
    }

    function update(id, state) {
        var data = $('#form').serializeArray();
        alert('d3w');
        if ($('#' + id).attr('value') === '0') {
            $('#btnDis' + id).removeAttr('disabled');
            $('#btnEna' + id).attr("disabled", "false");
            $('#' + id).attr('value', 1);
            data.push({name: 'state', value: 1});
        } else {
            $('#btnEna' + id).removeAttr('disabled');
            $('#btnDis' + id).attr("disabled", "false");
            $('#' + id).attr('value', 0);
            data.push({name: 'state', value: 0});
        }
        data.push({name: 'id', value: id});
        ajaxRequest(data, '../business/PersonStateUpdateAction.php');
    }

    function ajaxRequest(data, path) {
        $.ajax({
            url: path,
            type: 'post',
            dataType: 'json',
            data: data
        });
    }
</script>