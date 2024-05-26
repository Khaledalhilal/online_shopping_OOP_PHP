<?php
require("../../class/categories.class.php");
$response = array();
// var_dump($_FILES);
// exit;
$images = $_FILES['images'];
$categories = new categories();
$id = $_POST['category_id'];
$name = $_POST['category_name'];
$categories->validate('post');
$checkName = $categories->getCategoriesByName($name);
if($checkName){
     $response = array(
          'status' => 'error',
          'message' => 'Name already exists, please try again'
     );
}
else{
if (!empty($images['name']) && $images['size'] > 0) {
     $validExtensions = array("jpg", "jpeg", "png");
     $extension = strtolower(pathinfo($images["name"], PATHINFO_EXTENSION));
     if (in_array($extension, $validExtensions)) {
          $image_name = $categories->moveSingleFiles($images,  "../../assets/img/categories/");
          $categories->updateCategoriesWithImage($name, $image_name, $id);
          $response = array(
               'status' => 'success',
               'message' => 'Category updated successfully'
          );
     } else {
          $response = array(
               'status' => 'error',
               'message' => 'Invalid file type. Please upload only images with .jpg, .jpeg, or .png extensions.'
          );
     }
} else {
     $update = $categories->updateCategories($name, $id);
     if ($update == 0) {
          $response = array(
               'status' => 'success',
               'message' => 'Name updated successfully'
          );
     }
}
}




header('Content-Type: application/json');
echo json_encode($response);
exit;
