<!DOCTYPE html>
<html>
    <head lang="es" >
        <title>Gimnasio Caoba</title>
        <script src="../js/jquery-3.1.1.min.js"></script>
        <script src="../js/jsState.js" type="text/javascript"></script>
        <script src="../js/jquery.mask.min.js" type="text/javascript"></script>
        <script src="../js/jquery.getParams.js" type="text/javascript"></script>
        <link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
    </head>
    <body>
        <nav>
            <h1>Menú</h1>
            <ul>
                <?php
                error_reporting(E_ALL ^ E_NOTICE);
                session_start();
                if (isset($_SESSION['id'])) {
                    ?>

                    <?php
                    if ($_SESSION['type'] != '1') {
                        ?>
                        <li>
                            <a>Persona</a>
                            <ul>
                                <?php
                                error_reporting(E_ALL ^ E_NOTICE);
                                session_start();
                                if ($_SESSION['type'] == '2' || $_SESSION['type'] == '3') {
                                    ?>
                                    <li><a href="Person.php">Ingresar</a></li>
                                    <?php
                                }
                                if ($_SESSION['type'] == '0') {
                                    echo '<li><a href="Routine.php?id=' . $_SESSION['id'] . '&name=client&type=' . $_SESSION['type'] . '" >Rutina</a></li>';
                                    ?>
                                    <li><a href="ChooseService.php" >Contratar servicios</a></li>
                                    <li><a href="ShowSchedule.php">Ver horario</a></li>
                                    <?php echo '<li><a href="EditClient.php?id=' . $_SESSION['id'] . '" >Actualizar información personal</a></li>'; ?>
                                    <?php echo '<li><a href="familyRelationship.php?id=' . $_SESSION['id'] . '" >Familiares</a></li>'; ?>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>

                    <?php
                    error_reporting(E_ALL ^ E_NOTICE);
                    session_start();
                    if ($_SESSION['type'] == '2' || $_SESSION['type'] == '3') {
                        ?>
                        <li>
                            <a>Ejercicios</a>
                            <ul>
                                <li><a href="CreateNewExercise.php">Ingresar</a></li>
                                <li><a href="UpdateExercise.php">Actualizar</a></li>
                                <li><a href="DeleteExercise.php">Eliminar</a></li>
                            </ul>
                        </li>
                        <li>
                            <a>Catálogo</a>
                            <ul>
                                <li><a href="InventoryView.php">Inventario</a></li>
                                <li><a href="BuyView.php">Compras</a></li>
                                <li><a href="RepairInventory.php">Reparaciones</a></li>
                                <li><a href="WasteInventory.php">Dañados</a></li>
                                <li><a href="DamageInUseInventory.php">Dañados en uso</a></li>
                                <li><a href="StolenInventory.php">Robado</a></li>
                                <li><a href="DonatedInventory.php">Donados</a></li>
                                <li><a href="DonationInventory.php">Donación</a></li>
                            </ul>
                        </li>
                        <li><strong><a href="Neighborhood.php">Barrios</a></strong> </li>
                    <?php } ?>

                    <?php
                    if ($_SESSION['type'] != '0' && $_SESSION['type'] != '3') {
                        ?>
                        <li><strong><a href="Neighborhood.php">Barrios</a></strong> </li>
                        <li>
                            <a>Catálogo</a>
                            <ul>
                                <li><a href="InventoryView.php">Inventario</a></li>
                                <li><a href="BuyView.php">Compras</a></li>
                                <li><a href="RepairInventory.php">Reparaciones</a></li>
                                <li><a href="WasteInventory.php">Dañados</a></li>
                                <li><a href="DamageInUseInventory.php">Dañados en uso</a></li>
                                <li><a href="StolenInventory.php">Robado</a></li>
                                <li><a href="DonatedInventory.php">Donados</a></li>
                                <li><a href="DonationInventory.php">Donación</a></li>
                            </ul>
                        </li>
                    <?php } ?>


                    <?php
                    if ($_SESSION['type'] != '0' && $_SESSION['type'] != '3') {
                        ?>
                        <li>
                            <strong>Servicios</strong>
                            <ul>
                                <li><a href="createservice.php">Ingresar</a></li>
                                <li><a href="viewservice.php" >Ver servicios</a></li>
                                <li><a href="ScheduleCampus.php">Horario salas</a></li>
                            </ul>
                        </li>
                    <?php } ?>

                    <?php
                    if ($_SESSION['type'] != '0' && $_SESSION['type'] != '3') {
                        ?>
                    <?php } ?>

                    <li>
                        <strong> <a href="../business/LogoutAction.php">Salir</a></strong>
                    </li>

                    <?php
                } else {
                    ?>
                    <?php header("location: ./Login.php"); ?>
                <?php } ?>
            </ul>
        </nav>
