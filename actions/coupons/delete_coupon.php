<?php
require('../../class/coupon.class.php');
$coupons = new coupon();

if (isset($_POST)) {
    $coupons->validate('post');
    $id = $_POST['coupon_id'];

    $delete = $coupons->deleteCoupon($id);
    if ($delete === 0) {
        $couponCode = $coupons->getCouponCodeById($id);

        if (isset($_SESSION['coupon_discounts'][$couponCode])) {
            unset($_SESSION['coupon_discounts'][$couponCode]);
        }

        echo 'Coupon deleted successfully';
    } else {
        echo 'Failed to delete coupon';
    }
}
