<?php
include './header.php';
if (isset($_GET['id'])) {
    $idPerson = $_GET['id'];
    $namePerson = $_GET['name'];
} else {
    header('Location: dietList.php?id=0&name=Daniel');
}
?>
<div>
    <h1> Assign diet to <?php echo $namePerson ?></h1>

    <table border="1px" cellpadding="10px">
        <thead>
            <tr>
                <th>Name</th>
                <th>Funcion</th>
                <th>Food</th>
                <th>Day</th>
                <th>Hour</th>
                <!--<th>Delete</th>-->
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
//                                    temp = temp + "<td><input type=\"button\" value=\"Delete\" onclick=\"deleteDiet(" + types[i].iddiet + ");\"></td></tr>";


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
    //Fin de la función
    }//Fin de la función
    $(document).ready
            (
                    function ()
                    {
                        
                        getDiet();

                     
                    }
            );


</script>





