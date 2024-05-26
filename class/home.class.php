<?php
require('DAL.class.php');
class home extends DAL
{
    public function getAll()
    {
        $sql = "SELECT * FROM home";
        return $this->getData($sql);
    }
 

    public function insert($img, $head, $primary)
    {
        $sql = "INSERT INTO `home`( `head_title`, `primary_title`, `carousel_image`) VALUES ('$head','$primary','$img')";
        return $this->execute($sql);
    }
    public function updateHead($id, $title)
    {

        $sql = "UPDATE home SET head_title='$title' where carousel_id='$id'";
        return $this->execute($sql);
    }
    public function updatePrimary($id, $title)
    {
        // var_dump($id);exit;

        $sql = "UPDATE home SET primary_title='$title' where carousel_id='$id'";
        return $this->execute($sql);
    }
   
    public function deleteImage($id)
    {
        $sql = "DELETE FROM `home` WHERE carousel_id=$id";
        return $this->execute($sql);
    }
}
