<?php 

namespace App\core;

class Https {

    // function  pour  redirections 
    public static function redirect(string $path) :void 
    {
        header('Location: '.$path);
        exit;
    } 
    
    public static function active(string $path)
    {
        return ($_GET['p'] === $path) ? "class = 'active'" : '';
    }
}