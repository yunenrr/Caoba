<!DOCTYPE html>
<html>
    <head lang="es" >
        <title>Gym Caoba</title>

        <script src="../js/jquery-3.1.1.min.js"></script>
        <script src="../js/jsState.js" type="text/javascript"></script>
        <script src="../js/jquery.mask.min.js" type="text/javascript"></script>
        <script src="../js/jquery.getParams.js" type="text/javascript"></script>
        <link href=".../../AdmResource/css/style.css" rel="stylesheet" type="text/css" media="all" />
    </head>
    <body>
        <nav>
            <h1>Menú</h1>

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
            </ul>
        </nav>
