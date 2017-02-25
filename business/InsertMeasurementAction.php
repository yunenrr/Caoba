<?php
include './MeasurementBusiness.php';
$measurementBusiness = new MeasurementBusiness();
//$measurement = new Measurement(0, 3, '2017-01-01', 1, 1, 1, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 6, 6, 6, 6, 6, 6, 6, 0, 64, 0, 1.7);
$measurement = new Measurement(0, $_POST['idPersonMeasurement'], '2017-01-01', $_POST['transverseThorax'], $_POST['backThorax'], $_POST['biiliocrestideo'], $_POST['humeral'], $_POST['femoral'], $_POST['head'], $_POST['armRelaxed'], $_POST['armFlexed'], $_POST['forearmt'], $_POST['mesosternalThorax'], $_POST['waist'], $_POST['hip'], $_POST['innerThigh'], $_POST['upperThigh'], $_POST['calfMax'], $_POST['triceps'], $_POST['subscapular'], $_POST['supraspiral'], $_POST['abdominal'], $_POST['medialThigh'], $_POST['calf'], 0, $_POST['weight'], 0, $_POST['height']);
$measurementBusiness->insertMeasurement($measurement);
return true;
