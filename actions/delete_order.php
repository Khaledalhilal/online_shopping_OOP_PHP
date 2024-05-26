<?php
require('../class/orders.class.php');
$orders = new orders();

if (isset($_POST)) {
    $orders->validate('post');
    $id = $_POST['order_id'];
    // var_dump($id);exit;
    $delete = $orders->deleteOrder($id);
    if ($delete == 0) {
        echo $delete;
    }
}
