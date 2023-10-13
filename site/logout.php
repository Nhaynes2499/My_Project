<?php

// Autoloader
require_once("app/autoloader.php");

session_start();
// Checking whether user is authenticated
$authController = new AuthController();
if ($authController->check()) {
    // Logging out
    $authController->logout();
}

// Redirect to login
header("location: login.php");

?>