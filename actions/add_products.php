<?php
require("../class/products.class.php");

$products = new products();

if ($_POST) {
   $products->validate('post');
    $name = $_POST['product_name'];
    $description = $_POST['prod_description'];
    $categories = $_POST['category_id'];
    $price = $_POST['price'];
    $size = $_POST['size'];
    $color = $_POST['color'];

    $images = $_FILES['images'];

    $prod = $products->getProductsByName($name);
    $result = $prod;

    if ($result) {
        $response = array(
            'status' => 'error',
            'message' => 'The name of the product already exists'
        );
    } else {
        $product = $products->insertProducts($size, $color, $name, $description, $categories, $price);
        foreach ($images['name'] as $k => $value) {
            $validExtensions = array("jpg", "jpeg", "png");
            $extension = strtolower(pathinfo($images["name"][$k], PATHINFO_EXTENSION));

            if (in_array($extension, $validExtensions)) {
                $image_name = $products->moveMultipleFiles($images, $k, "../assets/img/products/");
                $image = $products->insertImage($image_name, $product);

                $response = array(
                    'status' => 'success',
                    'message' => 'Product added successfully'
                );
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Invalid file type. Please upload only images with .jpg, .jpeg, or .png extensions.'
                );
            }
        }
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
