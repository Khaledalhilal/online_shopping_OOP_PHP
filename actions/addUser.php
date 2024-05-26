<?php
require("../class/users.class.php");

$users = new users();

if ($_POST) {
    $users->validate('post');
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phoneNb = $_POST['phoneNb'];
    $userType = $_POST['userType'];
    $password = $_POST['password'];
    $RepeatPassword = $_POST['RepeatPassword'];
    $streetNb = $_POST['streetNb'];
    $state = $_POST['state'];
    $zipCode = $_POST['zipCode'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $validatePhone = true;
    if ($validatePhone === false) {
        $response = array(
            'status' => 'error',
            'message' => 'Enter Valid Phone Number'
        );
    } else {
        $user = $users->getUserByName($email);
        $result = $user;
        if ($result) {
            $response = array(
                'status' => 'error',
                'message' => 'user Name already exists'
            );
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $user_id = $users->insertUser($firstName, $lastName, $email, $phoneNb, $userType, $hashedPassword);
            if ($user_id) {
                $addAddress = $users->insertAddress($user_id, $streetNb, $country, $state, $city, $zipCode);
                if ($addAddress) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Thank You For Your Registration'
                    );
                } else {
                    $response = array(
                        'status' => 'error',
                        'message' => 'Please check Your Address Information'
                    );
                }
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Please check Your Account Information'
                );
            }
        }
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
