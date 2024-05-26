<?php
session_start();

// Check if product_id is provided in the POST request
if (isset($_POST['product_id'])) {
    $productIdToRemove = $_POST['product_id'];

    // Find the index of the product in the cart array
    foreach ($_SESSION['cart'] as $index => $item) {
        if ($item['productId'] == $productIdToRemove) {
            // If found, decrement the cart counter
            if (isset($_SESSION['cartCounter']) && $_SESSION['cartCounter'] > 0) {
                $_SESSION['cartCounter']--;
            }

            // Remove the product from the cart
            unset($_SESSION['cart'][$index]);

            // Optional: Reorder array keys
            $_SESSION['cart'] = array_values($_SESSION['cart']);

            echo '<script>window.location.href = "../khShop/cart.php";</script>';
            exit(); // exit to ensure no further code execution after the redirect
        }
    }

    // If the product is not found in the cart
    echo '<script>alert("Product not found in the cart.");</script>';
} else {
    // If product_id is not provided in the POST request
    echo '<script>alert("Invalid product ID.");</script>';
}

// Redirect back to the cart page or any other page
echo '<script>window.location.href = "../khShop/cart.php";</script>';
exit();
