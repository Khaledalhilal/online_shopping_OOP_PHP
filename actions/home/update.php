<?php
require("../../class/home.class.php");

$home = new home();
$response = array();


if ($_FILES['images']) {
    $home->validate("post");
    $images = $_FILES['images'];

    foreach ($images['name'] as $k => $value) {
        $validExtensions = array("jpg", "jpeg", "png");
        $extension = strtolower(pathinfo($images["name"][$k], PATHINFO_EXTENSION));

        if (in_array($extension, $validExtensions)) {
            $image_name = $home->moveMultipleFiles($images, $k, "../../assets/img/carousel/");

            $image = $home->insert($image_name, $_POST['headTitle'], $_POST['primaryTitle']);

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
} else if ($_POST['carousel_id']) {
    $home->validate("post");
    $delete = $home->deleteImage($_POST['carousel_id']);

    if ($delete === 0) {
        $response = array(
            'status' => 'success'

        );
    } else {
        $response = array(
            'status' => 'error'

        );
    }
} else if ($_POST['headID'] && $_POST['primaryTitle']) {
    $home->validate("post");
    $update = $home->updatePrimary($_POST['headID'], $_POST['primaryTitle']);

    if ($update === 0) {
        $response = array(
            'status' => 'success'

        );
    } else {
        $response = array(
            'status' => 'error'

        );
    }
} else if ($_POST['headID'] && $_POST['headTitle']) {
    $home->validate("post");
    $update = $home->updateHead($_POST['headID'], $_POST['headTitle']);

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
