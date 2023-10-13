<?php

// Autoloader
require_once("app/autoloader.php");

session_start();
// Checking whether user is authenticated
$authController = new AuthController();
if (!$authController->check()) {
    // Redirect to login
    header('Location: login.php');
    exit();
}

// Creating new view and outputting it
$view = new DashboardView();
$view->output();

?>