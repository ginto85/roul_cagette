<?php 

namespace App\core;


class Cookie
{
    public static function deleteCookie(array $cookies) :void
    {
        foreach($cookies as $cookieKey => $cookieValue)
        {
            setcookie($cookieKey);
            unset($_COOKIE[$cookieKey]);
        }
    }

    public static function setCookies(array $cookies) :void
    {
        foreach($cookies as $cookieName => $cookieValue)
        {
            setcookie($cookieName,$cookieValue,time()+365*24*3600);
        }
    }

    public static function checkCookie(string $cookieName)
    {
        if(array_key_exists($cookieName,$_COOKIE)){
            return "value='".$_COOKIE[$cookieName]."'";
        }
    }
}