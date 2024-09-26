<?php

class Route {
    //Front-end Routing
    public static function home(){
        include_once './Views/home.php';
    }
    public static function login(){
        include_once './Views/login.php';
    }
    public static function homepage(){
        include_once './Views/homepage.php';
    }
    public static function notepage(){
        include_once './Views/notepage.php';
    }
    public static function noteupdate(){
        include_once './Views/noteupdate.php';
    }
    public static function register(){
        include_once './Views/register.php';
    }
    public static function profile(){
        include_once './Views/profile.php';
    }
}
