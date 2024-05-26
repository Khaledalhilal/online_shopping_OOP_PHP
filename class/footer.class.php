<?php
require('DAL.class.php');
class footer extends DAL
{
    public function getAll()
    {
        $sql = "SELECT * FROM footer";
        return $this->getData($sql);
    }


    
    public function updateAddress($id, $address)
    {

        $sql = "UPDATE `footer` SET `address`='$address' WHERE footer_id='$id'";
        return $this->execute($sql);
    }
    public function updateEmail($id, $email)
    {

        $sql = "UPDATE `footer` SET `email`='$email' WHERE footer_id='$id'";
        return $this->execute($sql);
    }
    public function updatePhoneNbr($id, $phone)
    {

        $sql = "UPDATE `footer` SET `phone_number`='$phone' WHERE footer_id='$id'";
        return $this->execute($sql);
    }
   
}
