<?php 

namespace App\controller;

use App\model\{OrderDetails};


class PaiementController
{
    public static function paiement($amount)
    {
        // je dois mettre max 2 chiffre apres la virgule 
        $amount = floatval(number_format($amount, 2, '.', ' ')); 
        $amount =  $amount*100;
        // recuperation de l'autoload de composer pour gerer les classes de stripe 
        require 'vendor/autoload.php';  
        \Stripe\Stripe::setApiKey('sk_test_51J3HTFKeyf8cAWIMBgoJPrc0b79Tmd9qJWvrdZq0gXwVQxSGituWGhoia5Vva9t5o1wWo3BygMHSsp77o7MTzcmQ00yol9hezk');
        return \Stripe\PaymentIntent::create([
                'amount' => $amount, 
                'currency' => 'eur'
        ]);
    }
}