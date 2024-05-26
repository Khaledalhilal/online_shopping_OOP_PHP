<?php
session_start();
// var_dump($_SESSION);exit;
require("../class/users.class.php");
$response = array();
$users = new users();

if (isset($_POST)) {
    $email = $_SESSION['email'];
    $users->validate("post");
    // var_dump($_POST);
    // exit;
    $userID = $_POST['userID'];
    $addressID = $_POST['addressID'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $streetNbr = $_POST['streetNbr'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zipCode = $_POST['zipCode'];
    // var_dump($zipCode);exit;

    $update_user= $users->UpdateClientName($userID,$firstName, $lastName);
    // var_dump($update_user);exit;
    $update_address= $users->UpdateAddress($addressID, $userID, $streetNbr, $country, $state, $city, $zipCode);
    // var_dump($update_address);exit;
    if($update_address==0 && $update_user==0){
        $response = array(
            'status' => 'success',
            'message' => 'Address updated successfully'
        ); 
    }
    else{
        $response = array(
            'status' => 'error',
            'message' => 'oops. Something went wrong. Please try again!'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
