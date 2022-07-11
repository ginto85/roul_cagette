<?php 

namespace App\controller;

use App\controller\{FormController, PaiementController};
use App\model\{User, Products, Admin, Orders, OrderDetails, DeliveryPoint}; 
use App\core\{Session, Cookie, Https};


class FrontController
{
// controller qui permet d'afficher la page HOME (accueil)
    public function home()
    {
        $this->render('home/index');
    }
// controller qui permet d'afficher la page ABOUT(à propos)
    public function about()
    {
        $this->render('about/about');
    }
// controller qui permet d'afficher la page PRODUCERS(nos producteurs)
    public function producers()
    {
        $this->render('producers/producers');
    }
// controller qui permet d'afficher la page PRODUCT(nos cagettes)
    public function products()
    {
        $this->render('products/products');
    }
// controller qui permet d'afficher la page REGISTER(inscription)
    public function register()
    {
        Session::online() ? Https::redirect('index.php') : '' ; 
        if($_POST)
        {
            $form      = new FormController(new User());
            $messages  = $form->registerForm($_POST);
        }
        $this->render('connexion/register', [ 'messages' => ($messages) ?? null ]);
    }
// controller qui permet d'afficher la page LOGIN(se connecter)
    public function login()
    {
        Session::online() ? Https::redirect('index.php') : '' ; 
        if($_POST)
        {
            $form     = new FormController(new User());
            $messages = $form->loginForm($_POST);
        }
        $this->render('connexion/login', [ 'messages' => ($messages) ?? null,
                                           'cookie'   => new Cookie ]);
    }
// controller qui permet la déconnection de l'utilisateur
    public function logout()
    {
        Session::deconnect();
        Https::redirect('index.php');
    }
// controller qui permet d'afficher la page ADMIN  
    public function admin()
    {
        Session::adminOnline() ?  '' :  Https::redirect('index.php') ; 
        $product  = new Products();
        $products = $product->recupAll();
        if($_POST)
        {
            $form = new FormController(new User());
            $form->setProduct($product);
            $messages = $form ->productForm($_POST);   
        }
        $this->render('admin/dashboard');
    }
// controller qui permet de supprimer un produit de la BDD via 'main.js'
    public function deletee()
    {
        Session::adminOnline() ?  '' :  Https::redirect('index.php') ; 
        if(!array_key_exists('numProduct',$_GET))
        {
            Https::redirect('index.php?p=admin');
        }
        $product = new products();
        $product->deleteProduct($_GET['numProduct']);
        array_map('unlink', glob('assets/img/products/'.$_GET['numProduct'].'/*'));
        rmdir('assets/img/products/'.$_GET['numProduct']);
        Https::redirect('index.php?p=admin');
    }
// controller qui permet d'afficher dynamique 'updateProduct' dans le 'dashboard' de l'admin  
    public function update()
    {
        Session::adminOnline() ?  '' :  Https::redirect('index.php') ; 
        if(!array_key_exists('numProduct',$_GET))
        {
            Https::redirect('index.php?p=admin');
        }
        $productModel = new Products();
        $product      = $productModel->recupProductById($_GET['numProduct']);
        if($_POST)
        {
            $up = $productModel->updateProduct($_POST['numPost'],
                                               $_POST['name'],
                                               $_POST['description'],
                                               $_POST['price'],
                                               $_POST['picture'],
                                               $_POST['category']);
            Https::redirect('index.php?p=admin');
        }
       $this->render('admin/part/updateProduct',['product'=> $product]);
    }
// controller qui permet d'afficher les commandes payer
    public function orderDate()
    {
        Session::adminOnline() ?  '' :  Https::redirect('index.php') ; 
       //récupère les commandes par date défini par l'administrateur sur la page ORDERDATE
        $order  = new OrderDetails();
        $orders = $order->recupOrderByDate($_POST['date-start'],
                                           $_POST['date-end']);
        $this->render('admin/part/orderDate', ['orders' => $orders]);
    }
    // controller qui permet d'afficher la commande au format PDF
    public function facture()
    {
        Session::adminOnline() ?  '' :  Https::redirect('index.php');
         //récupère la commande par son Id
        $order = new OrderDetails();
        $orderDetail = $order->recupOrderForDetail($_POST['numPost']);
        // faire une facture au format PDF
        $pdf = new myPDF();
        $pdf -> AliasNbPages();
        $pdf -> AddPage('P','A4',0 );
        $pdf->SetFont('Times','',12);
        $pdf->headerTable();
        $pdf->viewTable($orderDetail);
        $pdf -> Output();
    }
// controller qui permet de valider le panier 
    public function shoppingcart()
    {
        (Session::online()) ?  ''  : Https::redirect('index.php?p=login');
        $this->render('order/shoppingcart');
    }
// controller qui permet d'enregistrer la commande si l'utilisateur est en ligne ou redirige vers shoppingcart
    public function toPaiement()
    {
        $orderModel = new Orders();
        if(Session::online()) 
        {
            $orderId = $orderModel->addOrder($_SESSION['user']['id']);
            Https::redirect('index.php?p=order&orderId='.$orderId);
        }
        else
        {
            Https::redirect('index.php?p=shoppingcart');
        }
    }
// affiche la commande 'valider la commande' et permet de passer au paiement 
    public function order()
    {
        (Session::online()) ? "" : Https::redirect('index.php'); 
        $this->render('order/order');
    }
// affiche la commande 'procéder au paiement' et passe l'intent de STRIPE
    public function paiement()
    {
        $totalAmount  = 0;
        // je recupere le details de ma commande
        $orderDetails = new OrderDetails();
        $orderlines   = $orderDetails->recupOrderDetail($_GET['orderNum']);

        foreach($orderlines as $orderline)
        {
            $totalAmount += $orderline['quantity']*$orderline['price'];
        }
        // STRIPE
        $intent = PaiementController::paiement($totalAmount);
        $this->render('paiement/paiement' ,[
                                               'totalAmount'=>$totalAmount,
                                               'intent'=>$intent
                                            ]);
    }
// controller qui permet de mettre à jour la table 'order' dans la BDD et redirige vers page 'success' 
    public function updateorder(){
        (Session::online()) ? "" : Https::redirect('index.php');
        
        if(isset($_GET['amount']) == false)
        {
            Https::redirect('index.php');
        }
        else
        {
            $orderModel = new Orders();
            $orderModel->updateOrder(floatval($_GET['amount']), intval($_GET['orderId']));
            Https::redirect('index.php?p=success');
        }
    }
// controller qui permet d'afficher le message après le paiement   
    public function success()
    {
        $this->render('paiement/success');
    }
    public function render(string $path,$array = [])
    {
        if(count($array) > 0)
        {
            foreach($array as $key => $value){
                ${$key} = $value;
            } 
        }
        //pour garder la session active à chaque changement de page
        $session = new Session;
        $https   = new Https;
        $path    = $path.".php";
        require 'template/template.php';
    }
}