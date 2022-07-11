<?php 

namespace App\controller;

use App\model\{User,OrderDetails};
use App\core\{ Session, Cookie };

class FormController 
{    
    protected User $_user;

    public function __construct(User $user){
        $this->_user = $user;
    }

    // fonction qui vérifie les entrer de formulaire
    public  function checkData($val)
    {
        $val = trim($val);
        $val = stripslashes($val);
        $val = htmlspecialchars($val);
        return $val;
    } 

// fonction qui gère le formulaire d'inscription (champs vide ou incorrecte)
    public function registerForm(array $data)
    {
        $messages = [];
        $exist = null;

        $login       = $this->checkData($data['login']);
        $password    = $this->checkData($data['password']);
        $password2   = $this->checkData($data['password2']);
        $mail        = $this->checkData($data['mail']);
    // verif global new user
        if(empty($login) 
        || empty($password)
        || empty($password2) 
        || empty($mail))
        {
            $messages['errors'][] = "veuillez remplir tous les champs";
        }
    // verif login
        if(!strlen($login) >= 3)
        {
            $messages['errors'][] = "login trop court ";
        }
    // verif mail
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL))
        {
            $messages['errors'][] = "L'adresse email est incorrecte ";
        }
    // verif password
        if ($password !== $password2)
        {
            $messages['errors'][] = "Les mots de passes doivent être les mêmes";
            $exist = $this->_user->recupUserByMail($mail);
        }
    // verif mail /bdd
        if($exist)
        {
            $messages['errors'][] = "L'email correspond à un compte déja existant";
        }
    // validation NewUser in bdd
        if(empty($messages['errors']))
        {   
            $this->_user->addUser($login,$password,$mail);
            $messages['success'] = ['bravo Inscription réussie'];  
        }
        return $messages;
    }
// fonction qui gère le formulaire de connection et la création de cookie(champs vide ou incorrecte)
    public function loginForm(array $data){

        $password    = $this->checkData($data['password']);
        $mail        = $this->checkData($data['mail']);
    //si les champs sont vides, retourne le message d'erreur
        if(empty($password) || empty($mail))
        {  
            return ['errors' => ["veuillez remplir tous les champs"]];
        }else{ 
        // sinon recupère les données de l'utilisateur via le constructeur de la class
            $exist = $this->_user->recupUserByMail($mail);
        //si l'adresse mail n'existe pas, retourne le message d'erreur
            if(!$exist){
                return ['errors' => ["L'email n'existe pas"]];
        //sinon vérifie le mot de passe 
            }else if (password_verify( $password, $exist['password']))
            {  
                    Session::setUserSession($exist);
            //si la case 'se souvenir de moi' est coché alors création du cookie
                (isset($data['remember'])) ? Cookie::setCookies($data) : Cookie::deleteCookie($data);
            } else {
                return ['errors' => ['Le mot de passe est invalide.']];
            }
        }
        header('location: index.php');
        exit;
    }

   
// fonction qui gère le formulaire d'ajout de produit par l'administrateur (champs vide)
    public function productForm(array $data)
    {
        // gestion d'enregistrement d'un nouveau produit
        $productName         = $this->checkData($data['name']);
        $productDescription  = $this->checkData($data['description']);
        $price               = $this->checkData($data['price']);
        $category            = $this->checkData($data['category']);
        
      
        $photo = null;    
        if(empty($productName) 
        || empty($productDescription)
        || empty($price)){
            $message['errors'] = "veuillez remplir tous les champs";
        }
        
        if($_FILES['photo']['error'] === 0)
        {
            $photo = $_FILES['photo']['name'];
        }
        if(empty($message['errors']))
        {
        //ajout du produit dans la bdd
            $idProduct = $this->_product->addProduct($productName,
                                                     $productDescription,
                                                     $price,
                                                     $photo,
                                                     $category);   
        }  
    //  enregistrer la photo du nouveau produit dans le dossier "assets/img"
        if($_FILES['photo']['error'] === 0)
        {
         // variables qui récupère l'id du nouveau produit 
            $lastId = $idProduct;
            // chemin de dossier  
            $chemin_dossier = './assets/img/products';
            // traitement 
            mkdir($chemin_dossier.'/'.$lastId, 0700);
            move_uploaded_file($_FILES['photo']['tmp_name'], $chemin_dossier.'/'.$lastId.'/'.$photo);
        }
        if(empty($message['errors']))
        {  
            header('location: index.php?p=admin');
            exit;   
        }else{
            return $message;
        }
    }
    public function setProduct($product)
    {
        $this->_product = $product;
    }
}