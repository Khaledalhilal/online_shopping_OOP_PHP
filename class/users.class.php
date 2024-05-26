<?php
require('DAL.class.php');
class users extends DAL
{
    public function getAllUsers()
    {
        $sql = "select * from users";
        return $this->getData($sql);
    }
    public function getUserByName($email)
    {
        $sql = "select * from users where email = '$email'";
        return $this->getData($sql);
    }
    public function insertUser($firstName, $lastName, $email, $phoneNb, $userType, $password)
    {
        $sql = "INSERT INTO `users`( `password`, `user_type`, `email`, `phone_number`, `firstName`, `lastName`, `client_firstName`, `client_lastName`) VALUES 
        ('$password','$userType','$email','$phoneNb', '$firstName', '$lastName', '$firstName', '$lastName')";
        return $this->execute($sql);
    }
    public function UpdateClientName($id, $firstName, $lastName)
    {
        $sql = "UPDATE `users` SET `client_firstName`='$firstName',`client_lastName`='$lastName' WHERE users.user_id='$id'";
        return $this->execute($sql);
    }
    public function UpdateUser($id, $firstName, $lastName, $email, $phone)
    {
        $sql = "UPDATE `users` SET `firstName`='$firstName',`lastName`='$lastName',`email`='$email',`phone_number`='$phone' WHERE users.user_id='$id'";
        return $this->execute($sql);
    }
    public function UpdateAddress($address_id, $userID, $street, $country, $state, $city, $zipCode)
    {
        $sql = "UPDATE `addresses` SET `street_nb`='$street',`country`='$country',
        `state`='$state',`city`='$city',`zipCode`='$zipCode' WHERE addresses.user_id='$userID' AND address_id='$address_id'";
        return $this->execute($sql);
    }
    public function insertAddress($user_id, $streetNb, $country, $state, $city, $zipCode)
    {
        $sql = "INSERT INTO `addresses`( `user_id`, `street_nb`, `country`, `state`, `city`, `zipCode`)
         VALUES ('$user_id','$streetNb','$country','$state','$city','$zipCode')";
        return $this->execute($sql);
    }
}
