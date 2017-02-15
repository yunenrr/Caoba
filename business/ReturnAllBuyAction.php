<?php

include './BuyBusiness.php';
$buy = new BuyBusiness();
$result = $buy->returnAll($_POST['status']);
echo (json_encode($result));

