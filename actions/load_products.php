<?php
if (isset($_POST['action'])) {

    $sql = "SELECT *, images.image_id, images.image_name, images.product_id FROM `products` INNER JOIN images ON products.prod_id = images.product_id where color !=''";
    if (isset($_POST['colors'])) {
        $colors = implode("','", $_POST['colors']);
        $sql .= " AND color IN('" . $colors . "')";
    }
    if (isset($_POST['sizes'])) {
        $sizes = implode("','", $_POST['sizes']);
        $sql .= " AND size IN('" . $sizes . "')";
    }
    if (isset($_POST['minPrice']) && $_POST['minPrice'] !=="") {
        $price = $_POST['minPrice'];
        $sql .= " AND prod_price ='$price'";
    }
    $sql .= " GROUP BY products.prod_id";
    $conn = new mysqli('localhost', 'root', "", "ecommerce");
    $result = $conn->query($sql);
    $output = "";

    if ($result->num_rows > 0) {
        $products = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($products as $prod) {
            $output .= '<div class="col-lg-4 col-md-4 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                         <a href="detail.php?productId=' . $prod['prod_id'] . '">
                            <img class="img-fluid" style="width:100% !important; height:150px !important;" src="../assets/img/products/' . $prod['image_name'] . '">
                        </a>
                        </div>
                        <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate">' . $prod['prod_name'] . '</a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                        <h5>' . $prod['prod_price'] . '</h5>
                        </div>
                        </div>
                        </div>
                        </div>';
        }
    } else {
        $output = "<h3>No Product Found</h3>";
    }
    echo $output;
}
