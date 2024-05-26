
 <?php
    session_start();
    require("../class/address.class.php");

    $addresses = new address();
    $response = array();
    if (isset($_POST)) {
        $addresses->validate('post');
        $add1 = $_POST['address1'];
        $add2 = $_POST['address2'];
        $country = $_POST['country'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zipCode = $_POST['zipCode'];

        $user_id = $addresses->getUserByEmail($_SESSION['email']);
 

        $addAddress = $addresses->insertAddress($user_id[0]['user_id'], $add1, $add2, $country, $state, $city, $zipCode);
        $result = $addAddress;



        if ($result) {
            $response = array(
                'status' => 'success',
                'message' => 'Thank you for adding your address.'
            );
            
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Invalid Information, please check all fields '
            );
        }
    }

    header('Content-Type: application/json'); 
    echo json_encode($response); 





    ?>