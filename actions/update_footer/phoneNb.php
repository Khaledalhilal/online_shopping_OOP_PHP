<?php
require("../../class/footer.class.php");

$footer = new footer();
$response = array();
if ($_POST['footer_id'] && $_POST['phone']) {

    $update = $footer->updatePhoneNbr($_POST['footer_id'], $_POST['phone']);

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
