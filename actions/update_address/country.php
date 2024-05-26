<?php
require("../../class/address.class.php");

$addresses = new address();
$response = array();
if ($_POST['address_id'] && $_POST['country']) {
    $addresses->validate("post");

    $update = $addresses->updateCountry($_POST['address_id'], $_POST['country']);

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
