<?php
session_start();
// var_dump($_POST);exit;
if (isset($_POST['productId']) && isset($_POST['quantity'])) {
    $productId = $_POST['productId'];
    $quantity = $_POST['quantity'];

    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['productId'] == $productId) {
                $item['quantity'] = $quantity;
                break;
            }
        }

        // Recalculate cart counter

        $response = [
            'status' => 'success',
            'message' => 'Quantity updated successfully.',
            'newQuantity' => $quantity,
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Cart not found.'
        ];
    }
} else {
    $response = [
        'status' => 'error',
        'message' => 'Invalid request.'
    ];
}

header('Content-Type: application/json');
echo json_encode($response);
