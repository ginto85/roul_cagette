<?php 

use App\core\{Autoloader, Https };
use App\controller\{FrontController, AjaxController};

session_start();

require_once './core/Autoloader.php';
require('./fpdf/fpdf.php');


Autoloader::register();

$routeur = new FrontController();

if(isset($_GET['ajax']))
{
    $methodAjax = $_GET['ajax'];
     AjaxController::$methodAjax() ;
}
else if(isset($_GET['p']))
{
    $method = $_GET['p'];
    (method_exists( FrontController::class, $method)) ? $routeur->$method() : $routeur->home();
}
else
{
    header('Location: index.php?p=home');
    exit;
}