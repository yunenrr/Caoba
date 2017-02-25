<?php

require_once ('../resources/jp/src/jpgraph.php');
require_once ('../resources/jp/src/jpgraph_line.php');
require_once ('../business/MeasurementBusiness.php');

$measurementBusiness = new MeasurementBusiness();
$array = $measurementBusiness->getMeasurementByClientIdForGraph($_GET['id']);
//$array = $measurementBusiness->getMeasurementByClientIdForGraph(1);
if ($array[1]) {



    $datay1 = $array[1];
    $datay2 = $array[2];
    $datay3 = $array[3];

// Setup the graph
    $graph = new Graph(1300, 450);
    $graph->SetScale("textlin");

    $theme_class = new UniversalTheme;

    $graph->SetTheme($theme_class);
    $graph->img->SetAntiAliasing(false);
    $graph->title->Set('Gráfico de Medidas del cliente para cada mes.');
    $graph->SetBox(false);

    $graph->img->SetAntiAliasing();

    $graph->yaxis->HideZeroLabel();
    $graph->yaxis->HideLine(false);
    $graph->yaxis->HideTicks(false, false);

    $graph->xgrid->Show();
    $graph->xgrid->SetLineStyle("solid");

//Fechas de mediciones.
//$graph->xaxis->SetTickLabels(array('A', 'B', 'C', 'D'));
    $graph->xaxis->SetTickLabels($array[0]);

    $graph->xgrid->SetColor('#E3E3E3');

// Create the first line
    $p1 = new LinePlot($datay1);
    $graph->Add($p1);
    $p1->SetColor("#5DADE2");
    $p1->SetLegend('Masa Muscular');

// Create the second line
    $p2 = new LinePlot($datay2);
    $graph->Add($p2);
    $p2->SetColor("#58FA58");
    $p2->SetLegend('Peso');

// Create the third line
    $p3 = new LinePlot($datay3);
    $graph->Add($p3);
    $p3->SetColor("#DC7633");
    $p3->SetLegend('Grasa Total');

    $graph->legend->SetFrameWeight(1);
    $graph->legend->SetPos(0.5, 0.98, 'left', 'bottom');
// Output line
    $graph->Stroke();
} else {
    echo 'Registre al menos dos medidas para observar el grafico';
}
?>

