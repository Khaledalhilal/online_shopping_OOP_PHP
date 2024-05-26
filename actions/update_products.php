<?php
require("../class/products.class.php");

$products = new products();
// var_dump($_FILES);
// exit;
if (isset($_POST)) {
    $products->validate('post');
    $product_id = $_POST['productID'];
    $name = $_POST['productName'];
    $cat_id = $_POST['category_id'];
    $des = $_POST['description'];
    $price = $_POST['price'];
    $color = $_POST['color'];
    $size = $_POST['size'];
    $images = $_FILES['images'];
    $prod = $products->getProduct($name, $product_id);
    $result = $prod;
    // var_dump($result);exit;
    if ($result) {
        $response = array(
            'status' => 'error',
            'message' => 'The name of the product is already exists'
        );
    } else {
        $product = $products->updateProducts($size, $color, $product_id, $name, $des, $cat_id, $price);
        if (!empty($images['name']) && $images['size'][0] > 0) {
            // var_dump($_FILES);exit;
            // Iterate through each uploaded image
            foreach ($images['name'] as $k => $value) {
                // Check if the file has a valid extension
                $validExtensions = array("jpg", "jpeg", "png");
                $extension = strtolower(pathinfo($images["name"][$k], PATHINFO_EXTENSION));

                if (in_array($extension, $validExtensions)) {
                    // Move the file and insert into the database
                    $image_name = $products->moveMultipleFiles($images, $k, "../assets/img/products/");
                    $image = $products->insertImage($image_name, $product_id);

                    $response = array(
                        'status' => 'success',
                        'message' => 'Product updated successfully'
                    );
                } else {
                    $response = array(
                        'status' => 'error',
                        'message' => 'Invalid file type. Please upload only images with .jpg, .jpeg, or .png extensions.'
                    );
                }
            }
        } else {
            // No images provided, update product without changing the image
            $response = array(
                'status' => 'success',
                'message' => 'Product updated successfully'
            );
        }
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
