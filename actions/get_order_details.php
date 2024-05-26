<?php
require('../class/orders.class.php');
$orders = new orders();

if (isset($_POST['orderId'])) {
    $orderDetails = [];
    $orderId = $_POST['orderId'];
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $order = $orders->getAllOrdersByNamee($fName, $lName);
// var_dump($order);exit;
    foreach ($order as $or) {
        $productName = $or['prod_name'];
        $price = $or['order_price'];
        $quantity = $or['quantity'];
        $total = $price * $quantity;

        // Create an array for each product
        $productDetails = [
            'productName' => $productName,
            'price' => $price,
            'quantity' => $quantity,
            'total' => $total,
        ];

        // Add the product details array to $orderDetails
        $orderDetails[] = $productDetails;
    }

    echo json_encode($orderDetails);
} else {
    // Handle error if orderId is not provided
    echo json_encode(['error' => 'Order ID not provided']);
}
