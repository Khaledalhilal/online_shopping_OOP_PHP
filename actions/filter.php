<?php
require("../class/products.class.php");

$products = new products();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get selected sizes from the form
    $selectedSizes = isset($_POST['size']) ? $_POST['size'] : [];

    // Use implode to create a comma-separated string of sizes
    $sizes = implode(',', array_map('intval', $selectedSizes));

    // Construct the SQL query
    $productsBySize = $products->filterBySize($sizes);

    foreach ($productsBySize as $k => $cat) {
        echo "<div class='col-lg-4 col-md-6 col-sm-6 pb-1'>
                <div class='product-item bg-light mb-4'>
                    <div class='product-img position-relative overflow-hidden'>
                        <img class='img-fluid w-100' src='../assets/img/{$cat['image_name']}' >
                        <div class='product-action'>
                            <a class='btn btn-outline-dark btn-square' ><i class='fa fa-shopping-cart '></i></a>
                            <a class='btn btn-outline-dark btn-square' ><i class='far fa-heart '></i></a>
                            <a class='btn btn-outline-dark btn-square' ><i class='fa fa-search '></i></a>
                        </div>
                    </div>
                    <div class='text-center py-4'>
                        <a class='h6 text-decoration-none text-truncate'>{$cat['prod_name']}</a>
                        <div class='d-flex align-items-center justify-content-center mt-2'>
                            <h5>\${$cat['prod_price']}</h5>
                        </div>
                    </div>
                </div>
            </div>";
    }
}
