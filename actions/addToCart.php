<?php
session_start();
function isProductInCart($productId, $cart)
{
    foreach ($cart as $item) {
        if ($item['productId'] == $productId) {
            return true;
        }
    }
    return false;
}

if (isset($_GET['productId'])) {
    $productId = $_GET['productId'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    if (!isProductInCart($productId, $_SESSION['cart'])) {
        if (isset($_GET['size']) && isset($_GET['color']) && isset($_GET['quantity'])) {
            $size = $_GET['size'];
            $color = $_GET['color'];
            $quantity = $_GET['quantity'];
            $cartItem = [
                'productId' => $productId,
                'size' => $size,
                'color' => $color,
                'quantity' => $quantity,
            ];

            $_SESSION['cart'][] = $cartItem;
            $response = [
                'status' => 'success',
                'message' => 'Product added to the cart.',
                'cartItem' => $cartItem
            ];

            if (!isset($_SESSION['cartCounter'])) {
                $_SESSION['cartCounter'] = 0;
            }
            $_SESSION['cartCounter']++;
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Size, color, or quantity is missing.'
            ];
        }
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Product is already in the cart.'
        ];
    }
} else {
    $response = [
        'status' => 'error',
        'message' => 'Invalid product ID.'
    ];
}

header('Content-Type: application/json');
echo json_encode($response);
