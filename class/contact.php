<?php
require('DAL.class.php');
class contact extends DAL
{
    public function getAllContacts()
    {
        $sql = "select *, users.user_id, users.firstName, users.lastName, users.email, users.phone_number from contact JOIN users ON contact.user_id = users.user_id";
        return $this->getData($sql);
    }

  
}
