<?php
require('DAL.class.php');
class carts extends DAL
{
    public function getAllCarts()
    {
        $sql = "select * from carts";
        return $this->getData($sql);
    }
 
    public function deleteCarts($id)
    {
        $sql = "DELETE FROM `carts` WHERE carts.cart_id=$id";
        return $this->execute($sql);
    }
}
