<?php
require('DAL.class.php');
class products extends DAL
{
    public function getFilteredProductsForColors()
    {

        $sql = "SELECT * FROM `products` where color !=''";
        return $this->getData($sql);
    }
    public function getOrdersForChar()
    {
        $sql = "SELECT count(*) as orderPerProd FROM order_details Group by prod_id";
        return $this->getData($sql);
    }
    public function getProductsForChar()
    {
        $sql = "SELECT *  FROM products";
        return $this->getData($sql);
    }
    public function countCategories()
    {
        $sql = "SELECT COUNT(category_name) AS cat_count FROM categories";
        return $this->getData($sql);
    }
    public function getCategoriesForChar()
    {
        $sql = "SELECT *  FROM categories";
        return $this->getData($sql);
    }
    public function getAllFooter()
    {
        $sql = "SELECT *  FROM footer";
        return $this->getData($sql);
    }
    public function getProductsPerCategoriesForChar()
    {
        $sql = "SELECT categories.category_name, COUNT(products.prod_id) AS product_count FROM categories LEFT JOIN products ON categories.category_id = products.cat_id GROUP BY categories.category_id;";
        return $this->getData($sql);
    }
    public function countProducts()
    {
        $sql = "SELECT COUNT(prod_name) AS prod_count FROM products";
        return $this->getData($sql);
    }
    public function countOrders()
    {
        $sql = "SELECT COUNT(order_id) AS order_count FROM orders";
        return $this->getData($sql);
    }
    public function countUsers()
    {
        $sql = "SELECT COUNT(user_id) AS user_count FROM users";
        return $this->getData($sql);
    }
    public function getContactByEmail($email)
    {

        $sql = "SELECT addresses.*, users.* FROM `addresses` JOIN users ON addresses.user_id = users.user_id WHERE users.email='$email'";
        return $this->getData($sql);
    }
    public function getFilteredProductsForSizes()
    {

        $sql = "SELECT * FROM `products` where size !=''";
        return $this->getData($sql);
    }

    public function getAllAddresses()
    {
        $sql = "SELECT * from addresses ";
        return $this->getData($sql);
    }
    public function getFooterInfo()
    {
        $sql = "SELECT * from footer ";
        return $this->getData($sql);
    }
    public function getAllCoupons()
    {
        $sql = "SELECT * from coupon ";
        return $this->getData($sql);
    }
    public function getAllCarousel()
    {
        $sql = "SELECT * from home ";
        return $this->getData($sql);
    }


    public function getAllCategories()
    {
        $sql = "SELECT  products.prod_id, products.prod_name, products.prod_description, products.size, products.prod_price, categories.category_id, categories.category_name, images.image_id, images.image_name, images.product_id FROM products JOIN categories ON products.cat_id = categories.category_id LEFT JOIN images ON products.prod_id = images.product_id Group By products.prod_id ";
        return $this->getData($sql);
    }

    public function getAllCategoriesss()
    {
        $sql = "SELECT * FROM  categories ";
        return $this->getData($sql);
    }
    public function getAllCategoriesForNavBar()
    {
        $sql = "SELECT   * FROM  categories";
        return $this->getData($sql);
    }


    public function getAllCategoriess()
    {
        $sql = "SELECT  * FROM categories";
        return $this->getData($sql);
    }
    public function getMaxPrices()
    {
        $sql = "SELECT  max(prod_price) as max_price FROM products";
        return $this->getData($sql);
    }
    public function getMinPrices()
    {
        $sql = "SELECT  MIN(prod_price) as min_price FROM products";
        return $this->getData($sql);
    }

    public function getColors()
    {
        $sql = "SELECT  distinct(color) FROM products";
        return $this->getData($sql);
    }
    public function getProductsByName($name)
    {
        $sql = "SELECT  * FROM products where prod_name  = '$name'";
        return $this->getData($sql);
    }
    public function getSizes()
    {
        $sql = "SELECT distinct(size) FROM products";
        return $this->getData($sql);
    }
    public function cleanString($str)
    {
        return str_replace(' ', '_', $str);
    }




    public function get($ids)
    { // Convert comma-separated values to an array
        $idArray = explode(',', $ids);

        // Quote each value and create a new comma-separated list
        $quotedIds = implode(',', array_map(function ($id) {
            return "'$id'";
        }, $idArray));

        $sql = "SELECT  products.prod_id, products.prod_name, products.prod_description, products.size, products.prod_price, categories.category_id, categories.category_name, images.image_id, images.image_name, images.product_id FROM products JOIN categories ON products.cat_id = categories.category_id LEFT JOIN images ON products.prod_id = images.product_id WHERE products.prod_id  IN ($quotedIds) GROUP BY products.prod_id";

        return $this->getData($sql);
    }
    public function getAllCategoriesById($id)
    {
        $sql = "SELECT  products.prod_id, products.prod_name, products.prod_description, products.size, products.prod_price, categories.category_id, categories.category_name, images.image_id, images.image_name, images.product_id FROM products JOIN categories ON products.cat_id = categories.category_id LEFT JOIN images ON products.prod_id = images.product_id WHERE categories.category_id = $id  GROUP BY products.prod_id";
        return $this->getData($sql);
    }
    public function getAllCategoriesByIdAndLimit($id, $limit)
    {
        $sql = "SELECT  products.prod_id, products.prod_name, products.prod_description, products.size, products.prod_price, categories.category_id, categories.category_name, images.image_id, images.image_name, images.product_id FROM products JOIN categories ON products.cat_id = categories.category_id LEFT JOIN images ON products.prod_id = images.product_id WHERE categories.category_id = $id  GROUP BY products.prod_id LIMIT $limit";
        return $this->getData($sql);
    }
    public function productNumberToSameCat()
    {
        $sql = "SELECT categories.category_id,category_name, COUNT(*) as product_count FROM products JOIN categories ON products.cat_id = categories.category_id GROUP BY categories.category_id";
        return $this->getData($sql);
    }

    public function getAllProducts()
    {
        $sql = "SELECT prod_id, prod_name,cat_id,size,color, prod_description,  prod_price, categories.category_id, categories.category_name, images.image_id, images.image_name, images.product_id FROM `products` JOIN categories ON products.cat_id = categories.category_id left JOIN images on products.prod_id= images.product_id  GROUP BY  prod_id";
        return $this->getData($sql);
    }
    public function getAllProductsById($id)
    {
        $sql = "SELECT prod_id, prod_name,cat_id,size,color, prod_description,  prod_price, categories.category_id, categories.category_name, images.image_id, images.image_name, images.product_id FROM `products` JOIN categories ON products.cat_id = categories.category_id left JOIN images on products.prod_id= images.product_id  where prod_id='$id'";
        return $this->getData($sql);
    }
    public function getAllProductsByLimit( $limit)
    {
        $sql = "SELECT prod_id, prod_name,cat_id,size,color, prod_description,  prod_price, categories.category_id, categories.category_name, images.image_id, images.image_name, images.product_id FROM `products` JOIN categories ON products.cat_id = categories.category_id left JOIN images on products.prod_id= images.product_id ORDER BY prod_id DESC LIMIT $limit";
        return $this->getData($sql);
    }

    public function filterBySize($size)
    {
        $sql = "SELECT prod_id, prod_name,cat_id,size, prod_description,  prod_price, categories.category_id, categories.category_name, images.image_id, images.image_name, images.product_id FROM `products` JOIN categories ON products.cat_id = categories.category_id left JOIN images on products.prod_id= images.product_id  where size in($size)";
        return $this->getData($sql);
    }
    public function getAllProductss($id)
    {
        $sql = "SELECT prod_id, prod_name,products.color,cat_id,size, prod_description,  prod_price, categories.category_id, categories.category_name, images.image_id, images.image_name, images.product_id FROM `products` JOIN categories ON products.cat_id = categories.category_id left JOIN images on products.prod_id= images.product_id   where prod_id =$id";
        return $this->getData($sql);
    }
    public function getAllProductsGroupByID($id)
    {
        $sql = "SELECT prod_id, prod_name,products.color,cat_id,size, prod_description,  prod_price, categories.category_id, categories.category_name, images.image_id, images.image_name, images.product_id FROM `products` JOIN categories ON products.cat_id = categories.category_id left JOIN images on products.prod_id= images.product_id WHERE products.prod_id = $id ";
        return $this->getData($sql);
    }
    public function getAllProductsGroupSize($id)
    {
        $sql = "SELECT prod_id, prod_name,products.color,cat_id,size, prod_description,  prod_price, categories.category_id, categories.category_name, images.image_id, images.image_name, images.product_id FROM `products` JOIN categories ON products.cat_id = categories.category_id left JOIN images on products.prod_id= images.product_id WHERE products.prod_id = $id Group by size";
        return $this->getData($sql);
    }
    public function getAllProductsGroupColor($id)
    {
        $sql = "SELECT prod_id, prod_name,products.color,cat_id,size, prod_description,  prod_price, categories.category_id, categories.category_name, images.image_id, images.image_name, images.product_id FROM `products` JOIN categories ON products.cat_id = categories.category_id left JOIN images on products.prod_id= images.product_id WHERE products.prod_id = $id Group by color";
        return $this->getData($sql);
    }
    public function getAllProductsGroupByIDs()
    {
        $sql = "SELECT prod_id, prod_name,products.color,cat_id,size, prod_description,  prod_price, categories.category_id, categories.category_name, images.image_id, images.image_name, images.product_id FROM `products` JOIN categories ON products.cat_id = categories.category_id left JOIN images on products.prod_id= images.product_id Group by products.prod_id";
        return $this->getData($sql);
    }
    public function deleteProducts($id)
    {
        $this->deleteImage($id);
        $sql_products = "DELETE FROM `products` WHERE products.prod_id=$id";
        return $this->execute($sql_products);
    }
    public function deleteImage($id)
    {
        $sql_image = "DELETE FROM `images` WHERE image_id=$id";
        return $this->execute($sql_image);
    }
    public function getAllImages($id)
    {
        $sql = "SELECT * FROM `images` WHERE product_id = $id";
        return $this->getData($sql);
    }

    public function getProduct($name, $id)
    {
        $sql = "SELECT `prod_id`, `prod_name`, `cat_id`, `prod_description`, 
         `prod_price` FROM `products` WHERE products.prod_name='$name' and products.prod_id !=$id";
        return $this->getData($sql);
    }
    public function getRecentProducts()
    {
        $sql = "SELECT prod_id, prod_name,products.color,size, prod_description, prod_price, images.image_id, images.image_name, images.product_id FROM `products` left JOIN images on products.prod_id= images.product_id GROUP BY products.prod_id ORDER BY products.prod_id DESC LIMIT 10";

        return $this->getData($sql);
    }
    public function getProductss($name)
    {
        $sql = "SELECT `prod_id`, `prod_name`, `cat_id`, `prod_description`, 
         `prod_price` FROM `products` WHERE products.prod_name='$name' ";
        return $this->getData($sql);
    }

    public function insertProducts($size, $color, $name, $des, $cat_id, $price)
    {
        $sql = "INSERT INTO `products`( size, color, `prod_name`, `cat_id`, `prod_description`, `prod_price`)
         VALUES ('$size','$color','$name',$cat_id,'$des',$price)";
        return $this->execute($sql);
    }
    public function updateProducts($size, $color, $id, $name, $des, $cat_id, $price)
    {
        $sql = "UPDATE `products` SET size='$size',color='$color', `prod_name`='$name',`cat_id`=$cat_id,`prod_description`='$des',`prod_price`=$price WHERE products.prod_id='$id'";
        return $this->execute($sql);
    }
    public function insertImage($name, $prod_id)
    {
        $sql = "INSERT INTO `images`(`image_name`, `product_id`) VALUES ('$name','$prod_id')";
        return $this->execute($sql);
    }
}
