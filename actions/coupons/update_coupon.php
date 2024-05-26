<?php
require("../../class/coupon.class.php");

$coupons = new coupon();
$response = array();
if (isset($_POST)) {
    $coupons->validate('post');
    $id = $_POST['id'];
    $name = $_POST['name'];
    $limit = $_POST['limit'];
    $date = $_POST['date'];
    $discount = $_POST['discount'];
    $update = $coupons->updateCoupon($id, $name, $limit, $date, $discount);
    if ($update==0) {
        $response = array(
            'status' => 'success',
            'message' => 'Coupon Code Update successfully'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Please Reset all fields'
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
