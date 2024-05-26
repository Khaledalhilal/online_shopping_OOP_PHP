<?php
session_start();
require("../class/orders.class.php");

$orders = new orders();
$response = array();
$total = $_POST['totalPrice'];
$user_id = $orders->getUserByEmail($_SESSION['email']);
if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $orderInfo) {
        $prod_id = $orderInfo['productId'];
        $quantity = $orderInfo['quantity'];
        $price = $orders->getProductPrice($prod_id);

        $order_id = $orders->insertOrder($user_id[0]['user_id'], $price[0]['prod_price'], $total);

        $addOrderDetails = $orders->insertOrderDetail($order_id, $prod_id, intval($quantity));
        $_SESSION['cartCounter']--;
        if (!$addOrderDetails) {
            $response = [
                'status' => 'error',
                'message' => 'Failed to insert order details.'
            ];
        }
    }
    unset($_SESSION['cart']);

    if (!isset($response['status'])) {
        $response = [
            'status' => 'success',
            'message' => 'Order added successfully'
        ];
    }
} else {
    $response = [
        'status' => 'error',
        'message' => 'Cart is empty or invalid.'
    ];
}


header('Content-Type: application/json');
echo json_encode($response);
