<?php
require('../../class/categories.class.php');
$category = new categories();

if (isset($_POST)) {
    $category->validate('post');
    $id = $_POST['cat_id'];
    $delete_category = $category->deleteCategories($id);
    if($delete_category ==0){
        echo $delete_category;
    }

}
