<?php
//include capa negocio
include '../business/ClientRecordBusiness.php';
//instancia
$clientRecordBusiness = new ClientRecordBusiness();
//metodos que retornan los servicios y sus detalles
$clientRecordData = $clientRecordBusiness->returnsRegisteredServices(0);


//var_dump($clientRecordBusiness);
$clientRecordData = $clientRecordBusiness->dateOfEntryIntoService(0);

//var_dump($clientRecordData);
//exit;
//manejo de zona horaria 
date_default_timezone_set("America/Costa_Rica");
//intancia time
$time = time();
//formato a time
$date = date("Y-m-d", $time);
//mes
$month = date("m", $time) . "";
//ano
$year = date("y", $time) . "";
//day
$day = date("d", $time);
//contar dias del mes
$first_of_month = mktime(0, 0, 0, $month, 1, $year);
$maxdays = date('t', $first_of_month);

//pasa fecha a dia!!!!!!!!!!!!!!!! tiene que venir esto para que llegue igual a ajax!!!!!!!!!!!11
$fechats = strtotime($date);
// variable auxiliar
$numDay;
switch (date('w', $fechats)) :
    case 0: echo "Domingo";
        $numDay = 0;
        break;
    case 1: echo "Lunes";
        $numDay = 1;
        break;
    case 2: echo "Martes";
        $numDay = 2;
        break;
    case 3: echo "Miercoles";
        $numDay = 3;
        break;
    case 4: echo "Jueves";
        $numDay = 4;
        break;
    case 5: echo "Viernes";
        $numDay = 5;
        break;
    case 6: echo "Sabado";
        $numDay = 6;
        break;
endswitch;
while ($day - 7 > 0):
    $day = $day - 7;
endwhile;
//echo $day . " dfer";
include './header.php';
?>

<table border="1px" cellpadding="15px" align="center">
    <tr>
        <th>SUNDAY</th>
        <th>MONDAY</th>
        <th>TUESDAY</th> 
        <th>WEDNESDAY</th>
        <th>THURSDAY</th>
        <th>FRIDAY</th>
        <th>SATURDAY</th>
    </tr>
    <?php
    $countAllDays = 0; // para los 35 campos...  todos los meses son 35 campos, algunos quedan vacios!!!!!
    $countDayWeek = 0; // se reinicia cada cada  iteraciones para cambiar de semana
    // recorre hasta 35, son los campos para un mes, 
    // depende del mes se llenan 29,30 031 campos, los otros quedan en blanco.
    while ($countAllDays < 35):
        $countDayWeek = $countDayWeek + 1;
        if ($countDayWeek == 0):
            ?>
            <tr>
                <?php
            endif;
            if ($countAllDays < $numDay-1):
                ?>
                <td><div></div><div></div></td>
                <?php
            elseif ($countAllDays < $maxdays):
                ?>
                <td id="<?= $countAllDays + 1 ?>">
                    <div>
                        <h1><?= $countAllDays + 1 ?></h1>
                    </div>
                    <div>5:00 a 6:00  </div>
                    <div>6:00 a 7:00 </div>
                    <div>7:00 a 8:00  </div>
                    <div>8:00 a 9:00  </div>
                    <div>9:00 a 10:00  </div>
                    </br>
                    <div>12:00 a 13:00 </div>
                    <div>13:00 a 14:00 </div>
                    <div>14:00 a 15:00 </div>
                    <div>16:00 a 17:00 </div>
                    <div>17:00 a 18:00 </div>
                    <div>18:00 a 19:00 </div>
                </td>  
                <?php
            else:
                ?>
                <td><div></div><div></div></td>
            <?php
            endif;
            if ($countDayWeek == 7):
                $countDayWeek = 0;
                ?>
            </tr>
            <?php
        endif;
        $countAllDays = $countAllDays + 1;
    endwhile;
    ?>
</table>
<?php
include './footer.php';
?>
<script type="text/javascript">
    $(document).ready(function () {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "../business/returnRegisteredServicesAction.php",
            success: function (data)
            {
                serviceDetail = JSON.stringify(data);
                a(serviceDetail);
            },
            error: function (data)
            {
//                alert('fxs');
            }
        });
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "../business/dateOfEntryIntoServiceAction.php",
            success: function (data)
            {
            }
        });
    });
    function a(data) {
//        alert('data');
        var types = JSON.parse(data);
        for (i in types)
        {
            var temp = types[i].hourStartService;
//            $("#16 div:nth-child("+temp+")").html('rftg');
            var temp2 = types[i].days;
            for (j in temp2)
            {
//                alert(temp2[j]);
                $("#" + temp2[j] + " div:nth-child(" + temp + ")").append("<b>" + types[i].nameService + "</b>");
            }

        }
    }
    function b(data) {
        alert(data);
//        var types = JSON.parse(data);
//        $("#meansu").empty()
//        for (i in types)
//        {
//            $("#meansu").prepend("<h4>Date: " + types[i].measurementDate + "</h4>");
//            $("#meansu").prepend("<h4>transverseThorax: " + types[i].transverseThorax + "</h4>");
//            $("#meansu").prepend("<h4>backThorax: " + types[i].backThorax + "</h4>");
//            $("#meansu").prepend("<h4>biiliocrestideo: " + types[i].biiliocrestideo + "</h4>");
//            $("#meansu").prepend("<h4>humeral: " + types[i].humeral + "</h4>");
//            $("#meansu").prepend("<h4>femoral: " + types[i].femoral + "</h4>");
//            $("#meansu").prepend("<h4>head: " + types[i].head + "</h4>");
//            $("#meansu").prepend("<h4>armRelaxed: " + types[i].armRelaxed + "</h4>");
//            $("#meansu").prepend("<h4>armFlexed: " + types[i].armFlexed + "</h4>");
//            $("#meansu").prepend("<br/>");
//        }
//        $("#meansu").prepend("<H1>CLIENT HISTORY</H1>");
    }




</script>