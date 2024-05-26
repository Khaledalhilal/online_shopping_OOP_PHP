<?php
require("../class/coupon.class.php");
$coupons = new coupon();
// $flag = 0;  0=> limit=0, 1 =>expiry_date has been finished.
$coupon_code = $_POST['name'];
$price = $_POST['price'];
$currentDate = date("Y-m-d");
// var_dump($currentDate);exit;

$sql = "SELECT * FROM coupon WHERE name = '$coupon_code' ";
$count = $coupons->getNumRows($sql);
$fetch = $coupons->getAllCouponByName($coupon_code);
$response = array();
$arraySize = sizeof($fetch);
// var_dump(sizeof($fetch));
// exit;
if ($arraySize == 0) {
    $flag = -1;
    $discount = 0;
    $total = 0;
    $response['expiry_date'] = 0;
    $response['flag'] = $flag;
    $response['limit'] = 0;
    $response['discount'] = 0;
    $response['price'] = $price;
} else {
    if (trim($fetch[0]['limitt']) == 0) {
        $flag = 0;
        $discount = 0;
        $total = 0;
        $response['expiry_date'] = 0;
        $response['limit'] = 0;
        $response['discount'] = 0;
        $response['price'] = $price;
        $response['flag'] = $flag;
    } elseif (trim($fetch[0]['expiry_date']) < $currentDate) {
        $flag = 1;
        $discount = 0;
        $total = 0;
        $response['expiry_date'] = 0;
        $response['limit'] = 0;
        $response['discount'] = 0;
        $response['price'] = $price;
        $response['flag'] = $flag;
    } else if ($count > 0 && trim($fetch[0]['limitt']) != 0 && trim($fetch[0]['expiry_date']) != 0) {
        $limit = $fetch[0]['limitt'] - 1;
        $id = $fetch[0]['coupon_id'];
        $update = $coupons->decrementLimit($id, $limit);
        $discount = $fetch[0]['discount'] / 100;
        $total = $discount * $price;
        $response['expiry_date'] = $fetch[0]['expiry_date'];
        $response['limit'] = $fetch[0]['limitt'];
        $response['discount'] = $fetch[0]['discount'];
        $response['price'] = $price - $total;
    } else {

        $discount = 0;
        $total = 0;
        $response['expiry_date'] = 0;
        $response['limit'] = 0;
        $response['discount'] = 0;
        $response['price'] = $price;
    }
}
echo json_encode($response);
