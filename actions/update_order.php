<?php
require("../class/orders.class.php");

$orders = new orders();

if (isset($_POST)) {
   

    header('Content-Type: application/json');
    echo json_encode($response);
}
