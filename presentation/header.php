<!DOCTYPE html>
<html>
    <head lang="es" >
        <title>Gym Caoba</title>

        <script src="../js/jquery-3.1.1.min.js"></script>
        <script src="../js/jsState.js" type="text/javascript"></script>
        <script src="../js/jquery.mask.min.js" type="text/javascript"></script>
        <script src="../js/jquery.getParams.js" type="text/javascript"></script>

        <link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
    <div id="google_translate_element"></div><script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

</head>
<body>
    <nav>
        <h1>Menu</h1>
        <ul>

            <li>
                <a>Client</a>
                <ul>
                    <li><a href="CreateNewClient.php">Insert</a></li>
                    <li><a href="ViewClient.php" >Show</a></li>
                    <li><a href="clientScheduleView.php" >Schedule</a></li>
                </ul>
            </li>
            <li>
                <strong> <a href="Instructor.php">Instructor</a></strong>

            </li>
            <li>
                <strong>Service</strong>
                <ul>
                    <li><a href="CreateService.php">Insert</a></li>
                    <li><a href="ViewService.php" >Show</a></li>
                    <li><a href="AddSchedule.php">Add Schedule</a></li>
                    <li><a href="RemoveSchedule.php">Remove Schedule</a></li>
                </ul>
            </li>
            <li>
                <strong> <a href="Inventory.php">Inventory</a></strong>
            </li>
            <li>
                <strong> <a href="conditionView.php">Condition</a></strong>
            </li>

            <?php
            error_reporting(E_ALL ^ E_NOTICE);
            session_start();
            if (isset($_SESSION['id'])) {
                ?>

                <?php
                if ($_SESSION['type'] != '1') {
                    ?>
                    <li>
                        <a>Client</a>
                        <ul>
                            <?php
                            error_reporting(E_ALL ^ E_NOTICE);
                            session_start();
                            if ($_SESSION['type'] == '2' || $_SESSION['type'] == '3') {
                                ?>
                                <li><a href="CreateNewClient.php">Insert</a></li>
                                <li><a href="ViewClient.php" >Show</a></li>
                                <?php
                            }
                            if ($_SESSION['type'] == '0') {
                                echo '<li><a href="Routine.php?id=' . $_SESSION['id'] . '&name=client&type=' . $_SESSION['type'] . '" >Routine</a></li>';
                                ?>
                                <li><a href="clientScheduleView.php" >Schedule</a></li>
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
                <?php } ?>

                <?php
                if ($_SESSION['type'] != '0' && $_SESSION['type'] != '3') {
                    ?>
                    <li>
                        <strong> <a href="Instructor.php">Instructor</a></strong>

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
                            <li><a href="AddSchedule.php">Add Schedule</a></li>
                            <li><a href="RemoveSchedule.php">Remove Schedule</a></li>
                        </ul>
                    </li>
                <?php } ?>

                <?php
                if ($_SESSION['type'] != '0' && $_SESSION['type'] != '3') {
                    ?>
                    <li>
                        <strong> <a href="Inventory.php">Inventory</a></strong>
                    </li>
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
