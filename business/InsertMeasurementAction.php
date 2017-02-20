<?php

include './MeasurementBusiness.php';
$measurementBusiness = new MeasurementBusiness();
//$result = $measurementBusiness->getMeasurementByClientIdForGraph(0);
//var_dump($result);
//$measurement = new Measurement(0, 4, '2017-01-01', 4, 4,4, 4, 4,4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4,4, 4, 4, 4,rand( 0,10 ),rand( 0,10 ),rand( 0,10 ));
$measurement = new Measurement(0, $_POST['idPersonMeasurement'], '2017-01-01', $_POST['transverseThorax'], $_POST['backThorax'], $_POST['biiliocrestideo'], $_POST['humeral'], $_POST['femoral'], $_POST['head'], $_POST['armRelaxed'], $_POST['armFlexed'], $_POST['forearmt'], $_POST['mesosternalThorax'], $_POST['waist'], $_POST['hip'], $_POST['innerThigh'], $_POST['upperThigh'], $_POST['calfMax'], $_POST['triceps'], $_POST['subscapular'], $_POST['supraspiral'], $_POST['abdominal'], $_POST['medialThigh'], $_POST['calf'],0,0,0);
$measurementBusiness->insertMeasurement($measurement);
return true;
