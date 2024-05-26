<?php
session_start();
require("../class/DAL.class.php");
$dal = new DAL();

$response = array();

if ($_POST) {
    $dal->validate('post');
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT user_type, email, password FROM users WHERE email = ?";
    $params = array($email);
    $result = $dal->data($sql, $params);
    if ($result && count($result) > 0) {
        if (password_verify($password, $result[0]['password'])) {
            $_SESSION['email'] = $email;
            $_SESSION['login'] = true;
            $_SESSION['user_type'] = 'client';

            $response = array(
                'status' => 'success',
                'message' => 'Correct Password',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Incorrect password',
            );
        }
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Email not found',
        );
    }
}

header('Content-Type: application/json');
echo json_encode($response);
