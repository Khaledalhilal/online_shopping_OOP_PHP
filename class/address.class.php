<?php
require('DAL.class.php');
class address extends DAL
{
    public function getAllAddress()
    {
        $sql = "select * from addresses";
        return $this->getData($sql);
    }
    public function getUserByEmail($email)
    {
        $sql = "SELECT users.user_id, users.email FROM `users` where users.email='$email'";
         $x = $this->getData($sql);
        return $x;
    }
   
    public function insertAddress($user_id, $add1, $add2, $country, $state, $city, $zipCode)
    {
        $sql = "INSERT INTO `addresses`( `user_id`, `address1`, `address2`, `country`, `state`, `city`, `zipCode`) 
        VALUES ('$user_id','$add1','$add2','$country','$state','$city','$zipCode')";
        return $this->execute($sql);
    }
    public function updateStreetNbr($id, $streetNbr)
    {

        $sql = "UPDATE `addresses` SET `street_nb`='$streetNbr' WHERE address_id='$id'";
        return $this->execute($sql);
    }
    public function updateCountry($id, $country)
    {

        $sql = "UPDATE `addresses` SET `country`='$country' WHERE address_id='$id'";
        return $this->execute($sql);
    }
    public function updateCity($id, $city)
    {

        $sql = "UPDATE `addresses` SET `city`='$city' WHERE address_id='$id'";
        return $this->execute($sql);
    }
    public function updateState($id, $state)
    {

        $sql = "UPDATE `addresses` SET `state`='$state' WHERE address_id='$id'";
        return $this->execute($sql);
    }
    public function updateZipCode($id, $zip)
    {

        $sql = "UPDATE `addresses` SET `zipCode`='$zip' WHERE address_id='$id'";
        return $this->execute($sql);
    }
}
