<?php
include './header.php';
include '../business/FamilyParentingBusiness.php';
include '../business/PersonBusiness.php';

if (isset($_GET['id'])) {
    $idPerson = $_GET['id'];
    $namePerson = $_GET['name'];

    $relationshipBusiness = new FamilyParentingBusiness();
    $relation = json_decode($relationshipBusiness->getAllRelationShip());

    $personBusiness = new PersonBusiness();
    $arrayPerson = $personBusiness->getAllPersons();
} else {
    header('Location: ViewClient.php');
}
?>
<div>
    <fieldset>
        <legend>Familia</legend>
        <div id="tree"></div>       
    </fieldset><br><br>
    <table border>
        <thead>
            <tr>
                <th>Cédula del familiar</th>
                <th>Nombre del familiar</th>
                <th>Apellido del familiar</th>
                <th>Segundo apellido del familiar</th>
                <th>Relación familiar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody id="tableBodyFamilytshow">
        </tbody>
        <tfoot>
        </tfoot>
    </table>
    <br><br>
    <table>
        <thead>
            <tr>
                <th>Nombre del familiar</th>
                <th>Relación familiar</th>
            </tr>
            <tr>
                <td>
                    <select id="selFamily" name="selFamily" > 
                        <?php foreach ($arrayPerson as $value) { 
                            
                            if($value->getIdPerson()!=$idPerson){?>
                            <option value="<?php echo $value->getIdPerson(); ?>"><?php echo $value->getNamePerson() . " " . $value->getFirstNamePerson() . "  " . $value->getSecondNamePerson(); ?></option> 
                        <?php }} ?>
                    </select>
                </td>
                <td>
                    <select id="selRelation" name="selRelation" > 
                        <?php foreach ($relation as $value) { ?>
                            <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option> 
                        <?php } ?>
                    </select>
                </td>
            </tr>
        </thead>
        <tbody id="tableBodyFamily">
        </tbody>
        <tfoot>
            <tr>
                <td><input type="button" value="Guardar" id="btnInsert" name="btnInsert" /></td>
            </tr>
        </tfoot>
    </table>
    <div id="msg"></div>
</div>

<?php include './footer.php' ?>
<script type="text/javascript">
    $(document).ready
      (
        function ()
         {
           var arrayAllPerson = "";
           var arrayAllRelationShip = "";

           TreeFamily();
           getFamily();

/****************************** Eventos ************************************/

      $("#tableBodyFamilytshow").on
        (
         'click', 'input.deleteDiet', function ()
           {
             var row = $(this).attr("id");
             var currentRow = parseInt(row.substring(10, row.length));
             deleteFamily(currentRow);
             getFamily();
              $("#tree").html("");
           }
         );

      $("#btnInsert").on
        (
          'click', function ()
          {
            var row = $("#tableBodyFamily tr:last").attr("id");
            var infoData = "option=1" + "&idPerson=" +<?php echo $idPerson ?> +
                            "&selFamilyParenting=" + $("#selFamily").val() +
                            "&selRelationShip=" + $("#selRelation").val();
              $.ajax
                (
                  {
                    type: 'POST',
                    url: "../business/FamilyParentingAction.php",
                    data: infoData,
                    success: function (data)
                     {
                       if (data.toString() === "1") {
                          $("#msg").html("<p>Success.</p>");
//                          $("#txtID" + newRow).val(data);
                          getFamily();
                          TreeFamily();
                        } else {
                          $("#msg").html(data);
                            }
                          },
                         }
                     );
                 }
               );


        $("#tableBodyFamily").on
          (
            'click', 'input.btnDelete', function ()
            {
              var row = $(this).attr("id");
              var currentRow = parseInt(row.substring(9, row.length)) + 1;
              $("#tr" + currentRow).remove();
              deleteFamily(currentRow);
             }
            );
          }
       );

    /****************************** Funciones ************************************/
    /**
     * Función que nos permite obtener todas los familiares del cliente
     * */
    function getFamily()
    {
        var infoData = "option=4" + "&idPerson=" +<?php echo $idPerson ?>;
        $.ajax
                (
                        {
                            type: 'POST',
                            url: "../business/FamilyParentingAction.php",
                            data: infoData,
                            success: function (data)
                            {
                                if (data.toString().length > 0)
                                {
                                    var temp = "";
                                    var array = data.split(";");
                                    for (var i = 0; i < array.length; i++)
                                    {
                                        var newRow = i + 1;
                                        var service = array[i].split(",");
                                        temp = temp + '<tr id="tr' + newRow + '">';
                                        temp = temp + '<td><input type="text" id="txtFamilyDNI' + newRow + '" name="txtFamilyDNI' + newRow + '" value="' + service[1] + '"  readonly=”readonly” /></td>' +
                                                '<td><input type="text" id="txtName' + newRow + '" name="txtName' + newRow + '" value="' + service[2] + '"  readonly=”readonly” /><input type="hidden" id="txtID' + newRow + '" name="txtID' + newRow + '" value="' + service[0] + '"/></td>' +
                                                '<td><input type="text" id="txtDescription' + newRow + '" name="txtDescription' + newRow + '" value="' + service[3] + '"readonly=”readonly/></td>' +
                                                '<td><input type="text" id="txtDay' + newRow + '" name="txtDay' + newRow + '" value="' + service[4] + '"  readonly=”readonly” /></td>' +
                                                '<td><input type="text" id="txtHour' + newRow + '" name="txtHour' + newRow + '" value="' + service[5] + '"  readonly=”readonly” /></td>' +
                                                '<td><input type="button" value="Eliminar" class="deleteDiet" id="deleteDiet' + service[0] + '" name="deleteDiet' + service[0] + '"  readonly=”readonly”/></td>' +
                                                '</tr>';
                                    }
                                    $("#tableBodyFamilytshow").html(temp);
                                    TreeFamily();
                                }
                            },
                            error: function ()
                            {
                                $("#msg").html("<p>Error.</p>");
                            }
                        }
                );
    }//Fin de la función



    /**
     * Función que nos permite eliminar un mienmbro del grupo familiar.
     * @param {int} currentRow Corresponde a la fila que deseamos eliminar
     * */
    function deleteFamily(currentRow)
    {
        var infoData = "option=5" +
                "&txtID=" + currentRow;
        $.ajax
         (
           {
             type: 'POST',
             url: "../business/FamilyParentingAction.php",
             data: infoData,
             beforeSend: function (before)
             {
               $("#msg").html("<p>Wait.</p>");
             },
              success: function (data)
              {
                if (data.toString() !== "0")
                  {
                    $("#tr" + currentRow).remove();
                     TreeFamily();
                    $("#msg").html("<p>Success.</p>");
                    
                    } else
                     {
                    $("#msg").html("<p>Error.</p>");
                 }
               },
               error: function ()
                {
                 $("#msg").html("<p>Error.</p>");
                }
             }
          );
    }//Fin de la función

    function TreeFamily()
    {
        var infoData = "option=6" + "&idPerson=" +<?php echo $idPerson ?>;
        $.ajax
         (
           {
             type: 'POST',
             url: "../business/FamilyParentingAction.php",
             data: infoData,
            success: function (data)
              {
                if (data.toString().length > 0)
                 {
                   $("#tree").html(data);
                 }
               },
             error: function ()
               {
                $("#msg").html("<p>Error.</p>");
               }
             }
         );
    }//Fin de la función

</script>


