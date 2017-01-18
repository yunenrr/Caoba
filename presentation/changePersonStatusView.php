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
                    $state = $PersonStateBusiness->getPersonStateBusiness($currentPerson->id); //Returns state fro current client
                    $id = $currentPerson->id;
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
                    <tr id="<?php echo $currentPerson->id; ?>" value="<?php echo $state; ?>">
                        <td align="center"><?php echo $currentPerson->id; ?></td>
                        <td align="center"><?php echo $currentPerson->dni; ?></td>
                        <td align="center"><?php echo $currentPerson->personName; ?></td>
                        <td align="center"><?php echo $currentPerson->firstName; ?></td>
                        <td align="center"><?php echo $currentPerson->secondName; ?></td>
                        <td align="center"><?php echo $currentPerson->age; ?></td>
                        <td align="center"><?php echo $currentPerson->gender; ?></td>
                        <td align="center"><?php echo $currentPerson->email; ?></td>
                        <td align="center"><?php echo $currentPerson->address; ?></td>
                        <td align="center"><input id="<?php echo 'btnEdit' . $currentPerson->id; ?>" onclick="<?php echo 'enableButtons(' . $currentPerson->id . ')' ?>" type="button"  value="  EDIT  " <?php echo $statusEdit; ?>/></td>
                        <td align="center" ><input id="<?php echo 'btnEna' . $id; ?>" onclick="<?php echo '' . $action . '(' . $id . ',' . 1 . ')' ?>" type="button"  value="  ENABLE  "  <?php echo $statusEnable . ""; ?> /></td>
                        <td align="center" ><input id="<?php echo 'btnDis' . $id; ?>" onclick="<?php echo '' . $action . '(' . $id . ',' . 0 . ')' ?>" type="button"  value="  DISABLE  " <?php echo $statusDisable . ""; ?> /> </td
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
        $('.time').mask('YA:F0:B0', {'translation': {
                Y: {pattern: /[0-2]/},
                A: {pattern: /[0-3]/},
                F: {pattern: /[0-5]/},
                B: {pattern: /[0-5]/}
            }
        });
        $('.money').mask('0 000 000 00 ₡', {reverse: true});
    });
</script>