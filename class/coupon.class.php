<?php
require('DAL.class.php');
class coupon extends DAL
{
    public function getAllCoupon()
    {
        $sql = "select * from coupon";
        return $this->getData($sql);
    }
    public function getAllCouponByName($name)
    {
        $sql = "select * from coupon where name = '$name'";
        return $this->getData($sql);
    }
    public function getCouponCodeById($id)
    {
        $sql = "select name from coupon where coupon_id = '$id'";
        return $this->getData($sql);
    }
 
 

    public function insertCoupon($name, $limit, $date, $discount)
    {
        $sql = "INSERT INTO `coupon`(`name`, `limitt`, `expiry_date`, `discount`)
         VALUES ('$name','$limit','$date','$discount')";
        return $this->execute($sql);
    }
    public function updateCoupon($id, $name, $limit, $date, $discount)
    {
        $sql = "UPDATE `coupon` SET `name`='$name',`limitt`='$limit',`expiry_date`='$date',
        `discount`='$discount' WHERE coupon_id='$id'";
        return $this->execute($sql);
    }
    public function decrementLimit($id, $limit)
    {
        $sql = "UPDATE `coupon` SET `limitt`='$limit' WHERE coupon_id='$id'";
        return $this->execute($sql);
    }

    public function deleteCoupon($id)
    {
        $sql = "DELETE FROM `coupon` WHERE coupon_id='$id'";
        return $this->execute($sql);
    }
}
