<?php
session_start();
require("../class/orders.class.php");
$response = array();
$orders = new orders();

if (isset($_POST)) {
    $orders->validate("post");

    $id = $_POST['orderId'];
    $stat = $orders->getStatus($id);
    $status = strtolower($stat[0]['status']);

    if ($status == "unpaid") {
   
        $update = $orders->updateStatus($id, 'Paid');
        $response = array(
            'status' => 'success',
            'message' => 'Status updated to Paid',
            'newStatus' => 'Unpaid',

        );
    } else {
        $update = $orders->updateStatus($id, 'unPaid');
        $response = array(
            'status' => 'success',
            'message' => 'Status updated to UnPaid',
            'newStatus' => 'paid',
            
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
