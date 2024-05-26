<?php
require('../class/products.class.php');
$prod = new products();

if (isset($_POST)) {
    $prod->validate('post');
    $id = $_POST['prod_id'];
    $deleteProduct = $prod->deleteProducts($id);
    if ($deleteProduct == 0) {
        echo $deleteProduct;
    }
}
