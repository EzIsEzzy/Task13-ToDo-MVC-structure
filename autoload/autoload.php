<?php
session_start();
require_once './Models/DB.php';
require_once './Controllers/RouteController.php';
require_once './Controllers/NotesController.php';

$PATH = $_SERVER['REQUEST_URI'];
$root = '/SummerTraining/Task12-TODO_Website-main/';