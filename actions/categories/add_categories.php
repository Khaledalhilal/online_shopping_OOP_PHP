
 <?php
     require("../../class/categories.class.php");

     $categories = new categories();

     if (isset($_POST)) {
          $categories->validate("post");
          $name = $_POST['category_name'];
          $images = $_FILES['images'];
          $category = $categories->getCategories($name);
          $result = $category;
          if ($result) {
               $response = array(
                    'status' => 'error',
                    'message' => 'The name of category is already exists'
               );
          } else {

               $validExtensions = array("jpg", "jpeg", "png");
               $extension = strtolower(pathinfo($images["name"], PATHINFO_EXTENSION));
               if (in_array($extension, $validExtensions)) {
                    $image_name = $categories->moveSingleFiles($images,  "../../assets/img/categories/");
                    $categories->insertCategories($name, $image_name);

                    $response = array(
                         'status' => 'success',
                         'message' => 'Category added successfully'
                    );
               } else {
                    $response = array(
                         'status' => 'error',
                         'message' => 'Invalid file type. Please upload only images with .jpg, .jpeg, or .png extensions.'
                    );
               }
          }

          header('Content-Type: application/json');
          echo json_encode($response);
     }




     ?>