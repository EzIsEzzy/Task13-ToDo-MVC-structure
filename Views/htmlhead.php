<?php

if(isset($_COOKIE['TODO_USER']) && !empty($_COOKIE['TODO_USER'])) {
    $user = json_decode($_COOKIE['TODO_USER'] , true);
}
else
{
    unset($_COOKIE['TODO_USER']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO App</title>
    <link rel="shortcut icon" href="./assets/images/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="shortcut icon" href="../assets/images/icon.svg" type="image/x-icon">
</head>
<body>