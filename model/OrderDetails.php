<?php 

namespace App\model;

use App\core\Connect;


class OrderDetails extends Connect 
{
    protected $_pdo;
    
    public function __construct()
    {
        $this->_pdo = $this->connexion();
    }
    public static function checkData($val)
    {
        $val = trim($val);
        $val = stripslashes($val);
        $val = htmlspecialchars($val);
        return $val;
    } 
    public function addOrderDetail(array $data)
    {
        $orderId        = $this->checkData($data['order_id']);
        $productId      = $this->checkData($data['product_id']);
        $quantity       = $this->checkData($data['quantity']);
        $deliveryPoint  = $this->checkData($data['delivery_point']);

        $sql = "INSERT INTO
                        `orderdetails`( `order_id`, `product_id`, `quantity`, `price`,`delivery_point`) 
                VALUES
                        (:order_id,:product_id,:quantity,:price,:delivery_point)";

        $q = $this->_pdo->prepare($sql);
        $q->execute([
                    ':order_id' => $orderId,
                    ':product_id' => $productId,
                    ':quantity' => $quantity,
                    ':price' => $this->recupPriceProduct($data['product_id']),
                    ':delivery_point'=>$deliveryPoint
                    ]);
        return $data;
    }
    public function recupPriceProduct(int $idProduct)
    {
        $sql="SELECT
                `id`,`price`
                FROM 
                `main_product` 
              WHERE
                `id`= :productId";
        $q = $this->_pdo->prepare($sql);
        $q->execute([
                    ':productId' => $idProduct
                    ]);
        $value = $q->fetch(\PDO::FETCH_ASSOC); 
        return $value['price'];
    }
    //recupère le détail d'une commande par id de commande
    public function recupOrderDetail(int $orderId)
    {
        $sql = "SELECT
                    `id`, `order_id`, `product_id`, `quantity`, `price` 
                FROM
                    `orderdetails` 
                WHERE 
                    `order_id` = :orderId";
                    
        $q = $this->_pdo->prepare($sql);
        $q->execute([
                    ':orderId' => $orderId
                    ]);
        return   $q->fetchAll(\PDO::FETCH_ASSOC);  
    }
    // affichage des commandes par date pour admininistrateur
    public function  recupOrderByDate(string $dataStart,string $dataEnd)
    {
        $sql = "SELECT
                	orders.id, orders.total_price, orders.order_date,
                    user.login
                FROM
                     orders
                INNER JOIN
                   user
                ON
                 orders.user_id = user.id
                WHERE
                    orders.paid = 'yes'
                AND
                    order_date BETWEEN '$dataStart' AND '$dataEnd'";
        $q = $this->_pdo->prepare($sql);
        $q->execute();
        return   $q->fetchAll(\PDO::FETCH_ASSOC);
    }
     public function recupOrderForDetail(string $orderId)
     {
        $sql = "SELECT
                    orders.id,
                    orderdetails.product_id, orderdetails.quantity, orderdetails.price,
                    main_product.name,main_product.description,orders.order_date,orders.user_id,user.login,user.email
                FROM
                    orders
                INNER JOIN 
                  	orderdetails
                ON 
                    orderdetails.order_id = orders.id
                INNER JOIN    
                    main_product
                ON
                    main_product.id= orderdetails.product_id
                INNER JOIN 
                    user
                ON 
                orders.user_id = user.id
                WHERE
                 	orders.id =  :orderId ";
        $q = $this->_pdo->prepare($sql);
        $q->execute([
                    ':orderId' => $orderId
                    ]);
        return   $q->fetchAll(\PDO::FETCH_ASSOC);
    }
}
