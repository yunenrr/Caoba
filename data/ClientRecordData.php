<?php

require_once '../data/Connector.php';
include '../domain/ClientRecord.php';

/**
 * Description of ClientRecordData
 *
 * @author Edwin
 */
class ClientRecordData extends Connector {

    /**
     * Método para 
     * @param 
     * @return 
     * @autor Edwin Navarro B.
     */
    public function updateClientRecord($clientRecord) {
        return $this->exeQuery($query);
    }

    /**
     * Método para 
     * @param 
     * @return 
     * @autor Edwin Navarro B.
     */
    public function insertClientRecord($clientRecord) {
        $query = "insert into tbclientrecord values(" . $clientRecord->getIdClientRecord()
                . "," . getDniPersonClientRecord() . ","
                . getIdServicePaymentModuleClientRecord() . "," .
                getIdRelationServiceScheduleClientRecord() . ");";
        return $this->exeQuery($query);
    }

    /**
     * Método para.
     * @param 
     * @return 
     * @autor Edwin Navarro B.
     */
    public function returnsRegisteredServices($id) {
        $query = "select idservicepaymentmoduleclientschedule,startdateclientschedule,hourclientschedule 
        from tbclientschedule 
        inner join tbservicepaymentmodule
        on idservicepaymentmoduleclientschedule=idservicepaymentmodule
        where idpersonclientschedule = " . $id . ";";

//        echo  $query;
//        exit;
        $clientRecordResult = $this->exeQuery($query);
        $clientRecordArray = array();

        //id servicepay, fecha inicio, hora.
        while ($row = mysqli_fetch_array($clientRecordResult)) {
//            echo $row['idservicepaymentmoduleclientschedule'];
//            exit;
            $date = $this->returnpaymentmodule($row['idservicepaymentmoduleclientschedule']);
            $dateSecuence = $this->returnDates($date['stardateservice'], $date['namepaymentmodule']);
            $fechats = strtotime($row["startdateclientschedule"]); //para numeor de dia
            $dayNumber = date('w', $fechats);
            $array = array(
                "idservicepaymentmoduleclientschedule" => $row['idservicepaymentmoduleclientschedule'],
                "nameservice" => $date['nameservice'],
                "namepaymentmodule" => $date['namepaymentmodule'],
                "dayservice" => $dayNumber,
                "hourclientschedule" => $row['hourclientschedule'],
                "hourclientschedule" => $row['hourclientschedule'],
                "days" => $dateSecuence
            );
//            echo "topo <br>";
            array_push($clientRecordArray, $array);
        }
//        var_dump(  $clientRecordArray );
        echo json_encode($clientRecordArray);
        return $clientRecordArray;
    }

    public function returnpaymentmodule($idservicepaymentmodule) {
        $query = "select nameservice,stardateservice,namepaymentmodule
                  from tbservice
                  inner join tbservicepaymentmodule
                  on idservice = idserviceservicepaymentmodule
                  inner join tbpaymentmodule
                  on idpaymentmoduleservicepaymentmodule=idpaymentmodule
                  where idservicepaymentmodule = " . $idservicepaymentmodule . ";";
//        echo $query;
//        exit;
        $clientRecordResult = $this->exeQuery($query);
        $row = mysqli_fetch_array($clientRecordResult);
        $array = array(
            "nameservice" => $row['nameservice'],
            "stardateservice" => $row['stardateservice'],
            "namepaymentmodule" => $row['namepaymentmodule']);
//        echo $query;
//        var_dump($array);
//        exit;
        return $array;
    }

    public function dateOfEntryIntoService($idservice) {
        $query = "select idservicepaymentmoduleclientrecord,startdateclientrecord "
                . "from tbpaymentmodule inner join tbservicepaymentmodule "
                . "on idpaymentmodule=idpaymentmoduleservicepaymentmodule "
                . "inner join tbclientrecord on idservicepaymentmodule = idservicepaymentmoduleclientrecord "
                . "where idpersonuserclientrecord ='123' and idservicepaymentmoduleclientrecord=" . $idservice . "";
        $clientRecordResult = $this->exeQuery($query);
        $row = mysqli_fetch_array($clientRecordResult);
        return $row['startdateclientrecord'];
    }

    // metodos que pueden servir***************************************************************************************************8888
    //recibe un string con la fecha formato -Y-m-d- y otro string nombre del modulo de pago -daily,session,weekly-
    function returnDates($dateEndIntoService, $namePaymentModule) {
        echo "Inicia el: " . $dateEndIntoService . " y paga " . $namePaymentModule . "<br>";
        // el metodo retorna la cantidad de veces que puede asistir a partir de la fecha de inicio y segun el metodo de pago.
        $daysQuantity = $this->calculateIteratorQuantity($namePaymentModule);

        // convertimos string a fecha para sumar dias
        $newDate = strtotime($dateEndIntoService);
        //datos formato
        $startDate = date("Y-m-d", $newDate);

        //contador
        $countTemp = 0;

        //almacenamos la fecha en varia para pruebas
        $tempDate = $startDate;
        //array para retornar esas fechas por si se ocupan fechas
        $array = array();
        //recorremos la canidad de veces que puede asistir e imprimimos la fecha para cada asistencia.
        while ($countTemp < $daysQuantity) {
            //se suman 7 dias a partir de la primera vez que asiste
            echo $tempDate . "<br>";

            //metemos a arereglo
//            $aux = date("d", strtotime($dateEnd));
            array_push($array, $tempDate);

            //se suman 7 dias a partir de la primera vez que asiste
            $dateAux = strtotime('+7' . 'day', strtotime($tempDate));
            //datos formato
            $tempDate = date("Y-m-d", $dateAux);
            //aumenta contador
            $countTemp = $countTemp + 1;
        };
        echo "**********************************<br><br>";
        echo "vector fechas<br>";
        echo json_encode($array);
        echo "<br>****<br><br>";
//        var_dump($array);

        return $array;
    }

    // calcula las cantidad de dias que se deben sumar para calcular las fechas.
    function calculateIteratorQuantity($namePaymentModule) {
        if ($namePaymentModule == "daily") {
            $iterator = 1;
        } else if ($namePaymentModule == "weekly") {
            $iterator = 1;
        } else if ($namePaymentModule == "biweekly") {
            $iterator = 2;
        } else if ($namePaymentModule == "monthly") {
            $iterator = 4;
        } else if ($namePaymentModule == "session") {
            $iterator = 1;
        }
        return $iterator;
    }

//
//    function calculateDate($dateEndIntoService, $namePaymentModule) {
//
//        date_default_timezone_set("America/Costa_Rica"); // cr date
//        $time = time(); // time
//
//        $day = date("d", $time) - 1; //dia de hoy menos 1
//
//        $date = date("Y-m-d", $time); // fecha de hoy
//
//        $fisrtDayTemp = strtotime('-' . $day . ' day', strtotime($date)); // resto hoy menos uno
//
//        $firstDay = date("Y-m-d", $fisrtDayTemp); // obtengo primer dia de este mes
//
//        $month = date("m", $time) . ""; // mes actual
//        $year = date("y", $time) . ""; //ano actual
//        $first_of_month = mktime(0, 0, 0, $month, 1, $year); // numero  dias
//        $maxdays = date('t', $first_of_month) - 1; // cantida de dias del mes menos uno
//
//        $lastDayTemp = strtotime('+' . $maxdays . ' day', strtotime($firstDay)); // a primeo le sumo 
//        $lastDay = date("Y-m-d", $lastDayTemp); // ultimo dia del mes
//
//        $fechats = strtotime($date); //para numeor de dia
//        date('w', $fechats); // numero de dia de hoy 0 domingo
//        $dateEnd = $dateEndIntoService;
//        if ($namePaymentModule == "daily") {
//            $count = 1;
//        } else if ($namePaymentModule == "weekly") {
//            $count = 1;
//        } else if ($namePaymentModule == "biweekly") {
//            $count = 2;
//        } else if ($namePaymentModule == "monthly") {
//            $count = 4;
//        } else if ($namePaymentModule == "session") {
//            $count = 1;
//        }
//        $countTemp = 0;
//        $array = array();
//        while (strtotime($dateEnd) <= strtotime($lastDay)):
//            $countTemp = $countTemp + 1;
//            if ($dateEnd >= $firstDay):
//                $aux = date("d", strtotime($dateEnd));
//                array_push($array, intval($aux));
//            endif;
//            if ($count == $countTemp):
//                break;
//            endif;
//            $dateEnd = strtotime('+7 day', strtotime($dateEnd));
//            $dateEnd = date("Y-m-d", $dateEnd);
//        endwhile;
//        var_dump($array);
//        exit;
//        return $array;
//    }
}
