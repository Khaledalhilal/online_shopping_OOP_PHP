<?php
require('DAL.class.php');
class orders extends DAL
{
    public function getAllOrders()
    {
        $sql = "SELECT *, orders.status, orders.order_date, orders.order_id as orderID, orders.total_price, products.prod_id, products.prod_name, products.prod_price, users.user_id FROM `order_details` INNER JOIN products ON order_details.prod_id =products.prod_id INNER JOIN orders ON order_details.order_id = orders.order_id INNER JOIN users ON orders.user_id = users.user_id";
        return $this->getData($sql);
    }
    public function getAllOrdersByName($fName, $lName)
    {
        $sql = "SELECT *, orders.status, orders.order_date, orders.order_id as orderID, orders.total_price, products.prod_id, products.prod_name, products.prod_price, users.user_id, users.firstName,users.client_firstName, users.lastName,users.client_lastName,users.email, users.phone_number FROM `order_details` INNER JOIN products ON order_details.prod_id =products.prod_id INNER JOIN orders ON order_details.order_id = orders.order_id INNER JOIN users ON orders.user_id = users.user_id Where firstName='$fName' And lastName='$lName' Group BY client_firstName,client_lastName";
        return $this->getData($sql);
    }
    public function getAllOrdersByNamee($fName, $lName)
    {
        $sql = "SELECT *, orders.status, orders.order_date, orders.order_id as orderID, orders.total_price, products.prod_id, products.prod_name, products.prod_price, users.user_id, users.firstName,users.client_firstName, users.lastName,users.client_lastName,users.email, users.phone_number FROM `order_details` INNER JOIN products ON order_details.prod_id =products.prod_id INNER JOIN orders ON order_details.order_id = orders.order_id INNER JOIN users ON orders.user_id = users.user_id Where client_firstName='$fName' And client_lastName='$lName' ";
        return $this->getData($sql);
    }
    public function getAllOrdersByID()
    {
        $sql = "SELECT *, orders.status, orders.order_date, orders.order_id as orderID, orders.total_price, products.prod_id, products.prod_name, products.prod_price, users.user_id, users.firstName,users.client_firstName, users.lastName,users.client_lastName,users.email, users.phone_number FROM `order_details` INNER JOIN products ON order_details.prod_id =products.prod_id INNER JOIN orders ON order_details.order_id = orders.order_id INNER JOIN users ON orders.user_id = users.user_id";
        return $this->getData($sql);
    }
    public function getAllOrdersGroupByName()
    {
        $sql = "SELECT *, orders.status, orders.order_date, orders.order_id as orderID, orders.total_price, products.prod_id, products.prod_name, products.prod_price, users.user_id FROM `order_details` INNER JOIN products ON order_details.prod_id =products.prod_id INNER JOIN orders ON order_details.order_id = orders.order_id INNER JOIN users ON orders.user_id = users.user_id Group By firstName, lastName";
        return $this->getData($sql);
    }
    public function getAllProducts()
    {
        $sql = "SELECT * from products";
        return $this->getData($sql);
    }
    public function getAllUsers()
    {
        $sql = "SELECT * from users";
        return $this->getData($sql);
    }
  
    public function getUserByEmail($email)
    {
        $sql = "SELECT user_id from users where email = '$email'";
        return $this->getData($sql);
    }
    public function getProductPrice($id)
    {
        $sql = "SELECT prod_price FROM `products` WHERE prod_id='$id'";
        return $this->getData($sql);
    }
    public function getStatus($id)
    {
        $sql = "SELECT status FROM `orders` WHERE order_id='$id'";
        return $this->getData($sql);
    }
    public function updateStatus($id, $status)
    {
        $sql = "UPDATE `orders` SET `status`='$status' WHERE order_id='$id'";
        return $this->execute($sql);
    }
    public function insertOrder($user_id,$price, $totalPrice)
    {
        $sql = "INSERT INTO `orders`( `user_id`,  `status`,`order_price`, `total_price`)
         VALUES ('$user_id','unPaid',$price,'$totalPrice')";
        return $this->execute($sql);
    }
    public function insertOrderDetail($order_id,$prod_id,$qty)
    {
        $sql = "INSERT INTO `order_details`(`order_id`, `prod_id`, `quantity`) VALUES ('$order_id','$prod_id','$qty')";
        return $this->execute($sql);
    }
    public function deleteOrder($id)
    {
        $sql = "DELETE FROM `orders` WHERE order_id='$id'";
        return $this->execute($sql);
    }
}
