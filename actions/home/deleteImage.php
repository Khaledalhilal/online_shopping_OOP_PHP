<?php
require("../../class/home.class.php");

$home = new home();
$response = array();


$id = $_POST['caro_id'];
$home->validate("post");

$delete = $home->deleteImage($id);
if ($delete === 0) {
    $response = array(
        'status' => 'success'

    );

}

header('Content-Type: application/json');
echo json_encode($response);
