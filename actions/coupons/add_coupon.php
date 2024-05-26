<?php
require("../../class/coupon.class.php");
session_start();
$coupons = new coupon();

if ($_POST) {
    $coupons->validate('post');
    $name = $_POST['name'];
    $limit = $_POST['Limit'];
    $date = $_POST['date'];
    $discount = $_POST['discount'];
    

    $addCoupon = $coupons->insertCoupon($name, $limit, $date, $discount);

    if ($addCoupon) {
        $_SESSION['coupon_discounts'][$name] = $discount;
        $response = array(
            'status' => 'success',
            'message' => 'Coupon Code added successfully'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Please Reset all fields'
        );
    }
}
header('Content-Type: application/json');
echo json_encode($response);
