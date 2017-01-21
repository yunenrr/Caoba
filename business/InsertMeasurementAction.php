<?php

include './MeasurementBusiness.php';
//include './PhoneBusiness.php';


$measurementBusiness = new MeasurementBusiness();
$measurement = new Measurement(0,'306363', '2017-01-01', $_POST['transverseThorax'], $_POST['backThorax'], $_POST['biiliocrestideo'], $_POST['humeral'], $_POST['femoral'], $_POST['head'], $_POST['armRelaxed'], $_POST['armFlexed'], $_POST['forearmt'], $_POST['mesosternalThorax'], $_POST['waist'], $_POST['hip'], $_POST['innerThigh'], $_POST['upperThigh'], $_POST['calfMax'], $_POST['triceps'], $_POST['subscapular'], $_POST['supraspiral'], $_POST['abdominal'], $_POST['medialThigh'], $_POST['calf']);
//$measurement = new Measurement(0, $_POST['idPersonMeasurement'], '2017-01-01', $_POST['transverseThorax'], $_POST['backThorax'], $_POST['biiliocrestideo'], $_POST['humeral'], $_POST['femoral'], $_POST['head'], $_POST['armRelaxed'], $_POST['armFlexed'], $_POST['forearmt'], $_POST[' mesosternalThorax'], $_POST['waist'], $_POST['hip'], $_POST['innerThigh'], $_POST['upperThigh'], $_POST['calfMax'], $_POST['triceps'], $_POST['subscapular'], $_POST['supraspiral'], $_POST[' abdominal'], $_POST['medialThigh'], $_POST['calf']);
$measurementBusiness->insertMeasurement($measurement);
return true;
