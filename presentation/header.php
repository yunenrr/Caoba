<!DOCTYPE html>
<html>
    <head lang="es" >
        <title>Gym Caoba</title>

        <script src="../js/jquery-3.1.1.min.js"></script>
        <script src="../js/jsState.js" type="text/javascript"></script>
        <script src="../js/jquery.mask.min.js" type="text/javascript"></script>
        <script src="../js/jquery.getParams.js" type="text/javascript"></script>
        <link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
    </head>
    <body>
        <nav>
            <h1>Menu</h1>
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
                            <a>Person</a>
                            <ul>
                                <?php
                                error_reporting(E_ALL ^ E_NOTICE);
                                session_start();
                                if ($_SESSION['type'] == '2' || $_SESSION['type'] == '3') {
                                    ?>
                                    <li><a href="Person.php">Insert</a></li>
                                    <?php
                                }
                                if ($_SESSION['type'] == '0') {
                                    echo '<li><a href="Routine.php?id=' . $_SESSION['id'] . '&name=client&type=' . $_SESSION['type'] . '" >Routine</a></li>';
                                    ?>
                                    <li><a href="clientScheduleView.php">Schedule</a></li>
                                    <?php echo '<li><a href="EditClient.php?id=' . $_SESSION['id'] . '" >Update personal information</a></li>'; ?>
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
                            <a>Exercise</a>
                            <ul>
                                <li><a href="CreateNewExercise.php">Insert</a></li>
                                <li><a href="UpdateExercise.php">Update</a></li>
                                <li><a href="DeleteExercise.php">Delete</a></li>
                            </ul>
                        </li>
                        <li>
                            <a>Inventory</a>
                            <ul>
                                <li><a href="">Buy</a></li>
                                <li><a href="RepairInventory.php">Repair</a></li>
                                <li><a href="WasteInventory.php">Waste</a></li>
                                <li><a href="DamageInUseInventory.php">Damage in use</a></li>
                                <li><a href="StolenInventory.php">Stolen</a></li>
                                <li><a href="">Donated</a></li>
                                <li><a href="DonationInventory.php">Donation</a></li>
                            </ul>
                        </li>
                    <?php } ?>

                    <?php
                    if ($_SESSION['type'] != '0' && $_SESSION['type'] != '3') {
                        ?>
                        <li>
                            <strong><a href="Neighborhood.php">Neighborhood</a></strong>
                        </li>
                    <?php } ?>


                    <?php
                    if ($_SESSION['type'] != '0' && $_SESSION['type'] != '3') {
                        ?>
                        <li>
                            <strong>Service</strong>
                            <ul>
                                <li><a href="CreateService.php">Insert</a></li>
                                <li><a href="ViewService.php" >Show</a></li>
                                <li><a href="ScheduleCampus.php">Schedule</a></li>
                            </ul>
                        </li>
                    <?php } ?>

                    <?php
                    if ($_SESSION['type'] != '0' && $_SESSION['type'] != '3') {
                        ?>
                        <li> <strong> <a href="Goods.php">Goods</a></strong></li>
                        <li><strong> <a href="Inventory.php">Inventory</a></strong></li>
                    <?php } ?>

                    <li>
                        <strong> <a href="../business/LogoutAction.php">Logout</a></strong>
                    </li>

                    <?php
                } else {
                    ?>
                    <li>
                        <strong> <a href="Login.php">Login</a></strong>
                    </li>
                <?php } ?>
            </ul>
        </nav>
