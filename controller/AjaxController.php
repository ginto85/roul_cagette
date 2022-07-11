<?php 

namespace App\controller;

use App\model\{ Products, OrderDetails, DeliveryPoint};

// Controller qui permet d'afficher les vues dynamiquement 
class AjaxController
{
    public static function allProducts()
    {
        $product = new Products();
        $products = $product->recupAll();   
        require './views/products/part/allProducts.php';
    }
    public static function meatProducts()
    {
        $product = new Products();
        $products = $product->recupProductsByCategory(htmlspecialchars('meat'));
        require './views/products/part/allProducts.php';
    }
    public static function vegetableProducts()
    {
        $product = new Products();
        $products = $product->recupProductsByCategory('vegetable');
        require './views/products/part/allProducts.php';
    }
    public static function fruitProducts()
    {
        $product = new Products();
        $products = $product->recupProductsByCategory('fruit');
        require './views/products/part/allProducts.php';
    }    
    public static function addProduct()
    {
        require './views/admin/part/addProduct.php';
    } 
    public static function removeProduct()
    {     
        $product = new Products();
        $products = $product->recupAll();
        require './views/admin/part/removeProduct.php';
    }
    public static function seeOrders()
    {
        require './views/admin/part/seeOrders.php';
    }
    public static function deliveryPoint()
    {
        $deliveryPoint = new DeliveryPoint();
        $deliveryPoints = $deliveryPoint->recupAllDelivery();
        require './views/order/part/deliveryPoint.php';
    }

    public static function saveOrderlines()
    {
        // vérification du $_POST dans la class OrderDetails.php avant insertion dans la base de données
        $datas = $_POST;
        $orderDetails = new OrderDetails();
        $response = $orderDetails->addOrderDetail($datas);
        echo json_encode($response);
    }
}