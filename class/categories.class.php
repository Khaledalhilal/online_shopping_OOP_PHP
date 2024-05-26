<?php
require('DAL.class.php');
class categories extends DAL
{
    public function getAllCategories()
    {
        $sql = "select * from categories";
        return $this->getData($sql);
    }
    public function getCategoriesByName($name)
    {
        $sql = "select * from categories where category_name ='$name'";
        return $this->getData($sql);
    }

    public function getAllCategoriesById($id)
    {
        $sql = "select * from categories where category_id = $id";
        return $this->getData($sql);
    }
    public function getCategories($name)
    {
        $sql = "select * from categories where category_name ='$name'";
        return $this->getData($sql);
    }

    public function insertCategories($name, $img)
    {
        $sql = "insert into categories(category_name, cat_image) VALUES('$name','$img')";
        return $this->execute($sql);
    }
    public function updateCategories($name, $id)
    {
        $sql = "UPDATE categories SET category_name='$name' where category_id='$id'";
        return $this->execute($sql);
    }
    public function updateCategoriesWithImage($name, $newImage, $id)
    {
        $sql = "UPDATE categories SET category_name='$name', cat_image='$newImage' where category_id='$id'";
        return $this->execute($sql);
    }
    public function deleteCategories($id)
    {
        $sql = "DELETE FROM `categories` WHERE categories.category_id=$id";
        return $this->execute($sql);
    }
}
