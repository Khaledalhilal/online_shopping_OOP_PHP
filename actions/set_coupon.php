<?php
require("../class/coupon.class.php");

$coupons = new coupon();
$result = array();

if ($_POST) {
    $coupon_str = $_POST['coupon_str'];

    $validation_result = $coupons->validate('post');

    // Replace this with your actual database connection
    $sql = "SELECT * FROM coupon WHERE name = ?";
    $params = array($coupon_str);

    $result = $coupons->data($sql, $params);

    // Check if the coupon exists
    if ($result && count($result) > 0) {
        $coupon_id = $result[0]['coupon_id'];
        $coupon_name = $result[0]['name'];
        $coupon_limit = $result[0]['limitt'];
        $coupon_date = $result[0]['expiry_date'];
        $coupon_discount = $result[0]['discount'];

        // Add the coupon discount to the session
        $_SESSION['coupon_discounts'][$coupon_name] = $coupon_discount;

        // Return the coupon details in the response
        $result = [
            'status' => 'success',
            'coupon' => [
                'coupon_id' => $coupon_id,
                'name' => $coupon_name,
                'limit' => $coupon_limit,
                'date' => $coupon_date,
                'discount' => $coupon_discount,
            ]
        ];
    } else {
        // Coupon not found
        $result = [
            'status' => 'error',
            'message' => 'Coupon not found.'
        ];
    }
}

// Return the JSON response
header('Content-Type: application/json');
echo json_encode($result);
