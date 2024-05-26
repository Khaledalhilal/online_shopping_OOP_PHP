<?php
session_start();
// var_dump($_SESSION);exit;
require("../class/users.class.php");
$response = array();
$users = new users();

if (isset($_POST)) {
    $users->validate("post");
    $userID = $_POST['userID'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phoneNb'];
    

    $update_user = $users->UpdateUser($userID, $firstName, $lastName, $email, $phone);
    $_SESSION['email']=$email;
    if ( $update_user == 0) {
        $response = array(
            'status' => 'success',
            'message' => 'User updated successfully'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'oops. Something went wrong. Please try again!'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
