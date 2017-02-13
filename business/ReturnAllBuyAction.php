<?php

include './BuyBusiness.php';
$buy = new BuyBusiness();
$result = $buy->returnAll();
echo (json_encode($result));

