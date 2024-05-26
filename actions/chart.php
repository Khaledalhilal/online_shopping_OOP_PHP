<?php
require("../class/products.class.php");
$prod = new products();
$orders = $prod->getOrdersForChar();
$products = $prod-> getProductsForChar();
var_dump($products);exit;
$response = [
    'xValues' => [],
    'yValues' => [],
];

foreach ($orders as $order) {
    $response['xValues'][] = $order['product_name'];
    $response['yValues'][] = $order['quantity'];
}

echo json_encode($response);

?>