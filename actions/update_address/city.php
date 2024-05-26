<?php
require("../../class/address.class.php");

$addresses = new address();
$response = array();
if ($_POST['address_id'] && $_POST['city']) {
    $addresses->validate("post");
    $update = $addresses->updateCity($_POST['address_id'], $_POST['city']);

    if ($update === 0) {
        $response = array(
            'status' => 'success'

        );
    } else {
        $response = array(
            'status' => 'error'

        );
    }
}
header('Content-Type: application/json');
echo json_encode($response);
