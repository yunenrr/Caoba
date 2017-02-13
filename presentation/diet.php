<?php
include './header.php';
if (isset($_GET['id'])) {
    $idPerson = $_GET['id'];
    $namePerson = $_GET['name'];
} else {
    header('Location: diet.php?id=0&name=Daniel');
}
?>
<div>
<!--    <H2 ALIGN=JUSTIFY> <?php // echo $namePerson       ?>'s diet</H2>-->
    <br><br>
    <!--<fieldset>-->
    <h2> Diet Information:</h2>
    <table  border="1px" cellpadding="1px">
        <thead>
            <!--<tr><td><div></div></td>-->
        <th>Dient Name</th>
        <!--<th></th>-->
        <th>Diet Function</th>
        </tr>
        </thead>
        <tbody>
            <tr> 
                <!--<td><div></div></td>-->
                <td><input id="txtDescription" /></td>
                <!--<td></td>-->
                <td> <input id="txtName" /></td>
            </tr>
        </tbody>

    </table>

    <h4> Select Foods to Diet:</h4>
    <table  border="1px" cellpadding="6px">
        <thead>
            <tr>
                <th>Food</th>
                <th>Day</th>
                <th>Hour</th>
            </tr>
        </thead>
        <tbody id="tableBodyDiet">

        </tbody>

        <tfoot>
            <tr>
                <td><input type="button" value="ADD FOOD" id="btnInsertFood" name="btnInsertFood" />
                    <!--<input type="button" value="Insert" id="btnInsert" name="btnInsert" /></td>-->
            </tr>
        </tfoot>


    </table>
    </br>

    <table border="1px" cellpadding="15px">
        <thead>
            <tr>
                <!--<th></th>-->
                <th><input type="button" value="INSERT DIET" id="btnInsert" name="btnInsert" /></th>
<!--                    <th>Day</th>
                <th>Hour</th>-->
            </tr>
        </thead>
<!--            <tbody id="tableBodyDiet">

        </tbody>

        <tfoot>
            <tr>
                <td><input type="button" value="Insert more Food" id="btnInsertFood" name="btnInsertFood" />
                    <input type="button" value="Insert" id="btnInsert" name="btnInsert" /></td>
            </tr>
        </tfoot>-->


    </table>
    <h1> Assign diet to <?php echo $namePerson ?></h1>

    <table border="1px" cellpadding="10px">
        <thead>
            <tr>
                <th>Name</th>
                <th>Funcion</th>
                <th>Food</th>
                <th>Day</th>
                <th>Hour</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody id="tableBodyDietshow">

        </tbody>
        <tfoot>
            <tr></tr>
        </tfoot>
    </table>


    <div id="msg"></div>
</div>

<?php include './footer.php' ?>
<script type="text/javascript">
    function getDiet()
    {
        var infoData = "option=3" + "&idPerson=" +<?php echo $idPerson ?>;
        $.ajax
                (
                        {
                            type: 'POST',
                            url: "../business/DietAction.php",
                            data: infoData,
                            beforeSend: function (before)
                            {
                                $("#msg").html("<p>.</p>");
                            },
                            success: function (data)
                            {
//                                                    alert(data);
                                var types = JSON.parse(data);
                                $("#tableBodyDietshow").empty();
                                for (i in types)
                                {

                                    var temp2 = types[i].days;
                                    var temp = "";
//                                                        alert(types[i].iddiet);
                                    temp = temp + '<tr id="td' + types[i].iddiet + '">';
                                    temp = temp + '<td><label>' + types[i].namediet + '<label/></td>';
                                    temp = temp + '<td><label>' + types[i].descriptiondiet + '<label/></td><td>***********</td><td>***********</td><td>***********</td>';
                                    temp = temp + "<td><input type=\"button\" value=\"Delete\" onclick=\"deleteDiet(" + types[i].iddiet + ");\"></td></tr>";


                                    for (j in types[i].days) {
                                        temp = temp + '<tr><td>---------</td><td>---------</td>';
                                        temp = temp + '<td>' + temp2[j].food + '</td>';
                                        temp = temp + '<td>' + temp2[j].dietdaydietplan + '</td>';
                                        temp = temp + '<td>' + temp2[j].diethourdietplan + '</td>';
                                        temp = temp + '</tr>';
                                    }
                                    $("#tableBodyDietshow").append(temp);
                                    $("#msg").html("");

//                                                        for (j in temp2)
//                                                        {
//                                                            $("#" + temp2[j] + " div:nth-child(" + temp + ")").append("<b>" + types[i].nameService + "</b>");
//                                                        }
                                }


                            },
                            error: function ()
                            {
                                $("#msg").html("<p>Error.</p>");
                            }
                        }
                );
    }//Fin de la función
    function deleteDiet(currentRow)
    {
        var infoData = "option=4" +
                "&txtID=" + currentRow;
        $.ajax
                (
                        {
                            type: 'POST',
                            url: "../business/DietAction.php",
                            data: infoData,
                            beforeSend: function (before)
                            {
                                $("#msg").html("<p>Wait.</p>");
                            },
                            success: function (data)
                            {
                                if (data.toString() !== "0")
                                {
                                    $("#msg").html("<p>Success.</p>");
                                    $("#td" + currentRow).remove();
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
//        getDiet();
        getDiet();
    }//Fin de la función
    $(document).ready
            (
                    function ()
                    {
                        var arrayAllFood = "";
                        getAllFood();
                        getDiet();

                        /****************************** Eventos ************************************/
                        $("#btnInsertFood").on
                                (
                                        'click', function ()
                                        {
                                            //id del ultimo
                                            var row = $("#tableBodyDiet tr:last").attr("id");
                                            //contadel ultimo
                                            var newRow = row.substring(2, row.length);
                                            //inserta fila
//                                            alert(newRow);
                                            insertNewRowFood("tableBodyDiet");
                                            //agrega botones al ultimo
                                            var buttons = '<input type="button" value="Delete" class="btnDelete" id="btnDelete' + newRow + '" name="btnDelete' + newRow + '" /></td>';
                                            $("#tableBodyDiet tr:last").append(buttons);
                                        }
                                );
                        $("#btnInsert").on
                                (
                                        'click', function ()
                                        {
                                            var row = $("#tableBodyDiet tr:last").attr("id");
                                            var newRow = parseInt(row.substring(2, row.length)) + 1;
                                            var food = "";
                                            for (var i = 0; i < newRow; i++)
                                            {
                                                food = food + "food" + i + "=" + $("#selFood" + i).val() + "&"
                                                        + "day" + i + "=" + $("#txtDay" + i).val() + "&"
                                                        + "hour" + i + "=" + $("#txtHour" + i).val() + "&";
                                            }
                                            if (validation(0))
                                            {
                                                var infoData = "option=1" + "&idPerson=" +<?php echo $idPerson ?> +
                                                        "&quantityFood=" + newRow +
                                                        "&txtName=" + $("#txtName").val() +
                                                        "&txtDescription=" + $("#txtDescription").val() + "&" + food;
                                                infoData = infoData.substring(0, infoData.length - 1);
                                                $.ajax
                                                        (
                                                                {
                                                                    type: 'POST',
                                                                    url: "../business/DietAction.php",
                                                                    data: infoData,
                                                                    beforeSend: function (before)
                                                                    {
                                                                        $("#msg").html("<p>Wait.</p>");
                                                                    },
                                                                    success: function (data)
                                                                    {
                                                                        if (data.toString() !== "0") {
                                                                            $("#msg").html("<p>Success.</p>");
                                                                            $("#txtID" + newRow).val(data);
                                                                            getDiet();
                                                                        } else {
                                                                            $("#msg").html("<p>Error.</p>");
                                                                        }
                                                                    },
                                                                    error: function ()
                                                                    {
                                                                        $("#msg").html("<p>Error.</p>");
                                                                    }
                                                                }
                                                        );
                                            }//Fin del if de validaciones
                                            else {
                                                $("#msg").html("<p>Please, check the information.</p>");
                                            }
                                        }

                                );
                        $("#tableBodyDiet").on
                                (
                                        'click', 'input.btnDelete', function ()
                                        {
                                            var row = $(this).attr("id");
                                            var currentRow = parseInt(row.substring(9, row.length)) + 1;
                                            $("#tr" + currentRow).remove();
                                        }
                                );
                        /****************************** Funciones ************************************/
                        /**
                         * Función que nos permite obtener todos las dietas del cliente
                         * */

                        function getAllFood()
                        {
                            var infoData = "option=2";
                            $.ajax
                                    (
                                            {
                                                type: 'POST',
                                                url: "../business/DietAction.php",
                                                data: infoData,
                                                beforeSend: function (before)
                                                {
                                                    $("#msg").html("<p>Wait.</p>");
                                                },
                                                success: function (data)
                                                {
                                                    if (data.toString().length > 0)
                                                    {
                                                        arrayAllFood = data.split(";");
                                                    } else
                                                    {
                                                        $("#msg").html("Don't have food");
                                                    }
                                                    insertRow("tableBodyDiet");
                                                },
                                                error: function ()
                                                {
                                                    $("#msg").html("<p>Error.</p>");
                                                }
                                            }
                                    );
                        }//Fin del if

                        /**
                         * Función que nos permite obtener el select de comidas.
                         * @param {int} currentRow Corresponde a la posición en la tabla.
                         * */
                        function getSelFood(id, currentRow)
                        {
                            var temp = '<select id="selFood' + currentRow + '" name="selFood' + currentRow + '">';
                            for (var i = 0; i < arrayAllFood.length; i++)
                            {
                                var diet = arrayAllFood[i].split(",");
                                if (diet[0] === id)
                                {
                                    temp = temp + '<option value="' + diet[0] + '" selected="">' + diet[1] + '</option>';
                                } else
                                {
                                    temp = temp + '<option value="' + diet[0] + '">' + diet[1] + '</option>';
                                }
                            }//Fin del for
                            return temp;
                        }//Fin de la función
                        /**
                         * Función que nos permite insertar una nueva fila de food a la tabla.
                         * @param {String} nameTable Corresponde al nombre de la tabla
                         * */
                        function insertNewRowFood(nameTable)
                        {
                            var newRow = ($("#" + nameTable + " tr").length);
                            $("#" + nameTable + " tr:last").after
                                    (
                                            '<tr id="tr' + newRow + '">' +
                                            '<td>' + getSelFood(0, newRow) + '</td>' +
                                            '<td><select id="txtDay' + newRow + '" name="txtDay' + newRow + '">' + '<option value="Monday">Monday</option><option value="Tuesday">Tuesday</option><option value="Wednesday">Wednesday</option> <option value = "Thursday"> Thursday </option> <option value="Friday">Friday</option ><option value="Saturday">Saturday</option><option value = "Sunday"> Sunday </option> </select></td>' +
                                            '<td> <input type = "number" id = "txtHour' + newRow + '" name = "txtHour' + newRow + '" /> </td>' +
                                            '</tr>'
                                            );
                        }//Fin de la función

                        /**
                         * Función que nos permite insertar una nueva fila a la tabla.
                         * @param {String} nameTable Corresponde al nombre de la tabla
                         * */
                        function insertRow(nameTable)
                        {
                            var newRow = ($("#" + nameTable + " tr").length);
//                            alert(newRow + " cntidad tr");
                            $("#" + nameTable).html
                                    (
                                            '<tr id="tr' + newRow + '">' +
                                            '<td>' + getSelFood(0, newRow) + '</td>' +
                                            '<td><select id="txtDay0" name="txtDay0">' + '<option value="Monday">Monday</option><option value="Tuesday">Tuesday</option><option value="Wednesday">Wednesday</option> <option value = "Thursday"> Thursday </option> <option value="Friday">Friday</option ><option value="Saturday">Saturday</option><option value = "Sunday"> Sunday </option> </select></td>' +
                                            '<td> <input type = "number" id="txtHour0" name = "txtHour0" /> </td>' +
                                            '</tr>'
                                            );
//                            getSelFood
                        }//Fin de la función

                        /**
                         * Función que valida los campos.
                         * @param {String} positionToValidate Corresponde a la posición en la tabla.
                         * @return {boolean} Indicando si está todo bien o no.
                         * */
                        function validation(positionToValidate)
                        {
                            var flag = true;
                            return true;
                            if (($("#txtName").val().length === 0) ||
                                    ($("#txtDescription").val().length === 0)
//                                    ||
//                                    ($("#txtDay" + positionToValidate).val().length === 0) ||
//                                    ($("#txtHour" + positionToValidate).val().length === 0)
                                    )
                            {
                                flag = false;
                            }

                            return flag;
                        }//Fin de la función                                             


//                        function alerta()
//                        {
//                            alert('abc');
//                        }

                    }
            );


</script>





