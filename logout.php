<?php
session_start();
// var_dump($_SESSION['user_type']);exit;
// if (strtolower(trim($_SESSION['user_type'])) === 'admin') {
    unset($_SESSION['email']);
    unset($_SESSION['login']);
    unset($_SESSION['user_type']);
    echo "<script>window.location.href='login.php'</script>";
    exit;
// }
