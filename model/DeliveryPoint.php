<?php 

namespace App\model;

use App\core\Connect;


class DeliveryPoint extends Connect 
{
    protected $_pdo;
    
    public function __construct()
    {
        $this->_pdo = $this->connexion();
    }
    /* récupere tout les produits */
    public function recupAllDelivery()
    {

        
        $sql = "SELECT
                    `id`, `name`, `adress`, `zip_city` , `lat`, `lng`
                FROM    
                    `delivery_point` ";
        $query = $this->_pdo->prepare($sql);
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }
}