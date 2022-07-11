<?php 

namespace App\model;

use App\core\Connect;

class Products extends Connect
{
    protected $_pdo;
    
    public function __construct()
    {
        $this->_pdo = $this->connexion();
    }
    /* récupere tout les produits */
    public function recupAll()
    {
        $sql = "SELECT
                    id, name, description, price, picture, category, date_creation, sold
                FROM
                    main_product
                ORDER BY 
                    category";
        $query = $this->_pdo->prepare($sql);
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC); 
    }
    /* récupere tout les produits selon la catégorie */
    public function recupProductsByCategory(string $category)
    {
        $sql = "SELECT 
                    id, name, description, price, picture, category, date_creation, sold
                FROM
                    main_product
                WHERE 
                    category = :category";
        $query = $this->_pdo->prepare($sql);
        $query->execute([ 
                ':category' => $category
        ]);
        return $query->fetchAll(\PDO::FETCH_ASSOC); 
    }
    
    public function recupProductById(int $id)
    {
        $sql = "SELECT 
                    id, name, description, price, picture, category, date_creation, sold
                FROM
                    main_product
                WHERE 
                    id = :id";
        $query = $this->_pdo->prepare($sql);
        $query->execute([ 
                ':id' => $id
        ]);
        return $query->fetch(\PDO::FETCH_ASSOC); 
    }
    
    public function addProduct(string $name,string $description,string $price,string $picture,string $category)
    {
        $sql = "INSERT INTO 
                    `main_product`(`name`,`description`,`price`,`picture`,`category`) 
                VALUES 
                    (:name,:description,:price,:picture,:category)";
        $query = $this->_pdo->prepare($sql);
        $query->execute([
            ':name'         => $name,
            ':description'  => $description,
            ':price'        => $price,
            ':picture'      => $picture,
            ':category'     => $category
        ]);
        return $this->_pdo->lastInsertId();
    }
    
    public function updateProduct(int $id,string $name,string $description,string $price,string $picture,string $category)
    {
        $sql = 'UPDATE 
                    `main_product` 
                SET 
                    `name`              = :name,
                    `description`       = :description,
                    `price`             = :price,
                    `picture`           = :picture,
                    `category`          = :category,
                    `date_creation`     = NOW() 
                WHERE 
                    id = :id';
        $query = $this->_pdo->prepare($sql);
        $query->execute([
            ':id'           => $id,
            ':name'         => $name,
            ':description'  => $description,
            ':price'        => $price,
            ':picture'      => $picture,
            ':category'     => $category,
        ]);
        return "l'article à bien été modifié";
    }
    
    public function deleteProduct(int $id)
    {
        $sql = 'DELETE FROM
                    `main_product` 
                WHERE
                    `id` = :articleId';
        $query = $this->_pdo->prepare($sql);
        $query->execute([
            ':articleId' => $id
        ]);    
    }
}