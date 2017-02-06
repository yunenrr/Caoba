<?php
session_start();
session_destroy();
header("location: ../presentation/Home.php?success=LOGOUT");
