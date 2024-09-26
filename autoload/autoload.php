<?php
session_start();
require_once './Models/DB.php';
require_once './Controllers/RouteController.php';
require_once './Controllers/NotesController.php';

$PATH = $_SERVER['REQUEST_URI'];
$root = '/SummerTraining/Task13_MVC/';
//In case it runs on a server from the root directly, such as localhost:port/root, no need for the $root variable, otherwise, modify it to the path that it shows, here it is localhost:port/SummerTraining/Task13_MVC