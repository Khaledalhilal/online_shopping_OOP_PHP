<?php
require("../class/orders.class.php");
if (isset($_POST['prod_id'])) {
    $order = new orders();
    $order->validate('post');
    $prodId = $_POST['prod_id'];
    $price = $order->getProductPrice($prodId);
    $newPrice = $price[0]['prod_price'];

    if ($price !== null) {
        $response = array(
            'status' => 'success',
            'prod_price' => $newPrice,
        );
    } else {
        http_response_code(400);
        $response = array(
            'status' => 'error',
            'message' => 'Product price not found',
        );
    }
} else {
    http_response_code(400);
    $response = array(
        'status' => 'error',
        'message' => 'Product ID not found',
    );
}

header('Content-Type: application/json');
echo json_encode($response);
