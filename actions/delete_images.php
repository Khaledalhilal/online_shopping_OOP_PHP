<?php
require('../class/products.class.php');
$prod = new products();

if (isset($_POST)) {
    $prod->validate('post');
    $id = $_POST['img_id'];
    $deleteImage = $prod->deleteImage($id);
    if ($deleteImage == 0) {
        echo $deleteImage;
    }
}
