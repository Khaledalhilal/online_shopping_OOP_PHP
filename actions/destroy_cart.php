<?php
session_start();
// Check if you have an active session
// Unset and destroy the cart session variable
unset($_SESSION['cart']);

// Optionally, you may also unset other related session variables, if any
unset($_SESSION['cartCounter']);
unset($_SESSION['coupon_discount']);

// Destroy the entire session if needed
// session_destroy();

// Return a JSON success response
$response = [
    'status' => 'success',
    'message' => 'Thank you for Your Order!'
];



// Return the JSON response
header('Content-Type: application/json');
echo json_encode($response);
