<?php

// Autoloader
require_once("app/autoloader.php");

session_start();
// Checking whether user is authenticated
$authController = new AuthController();
if ($authController->check()) {
    // Redirect to dashboard
    header('Location:dashboard.php');
    exit();
}

// Checking if username and password are set
if (
    (array_key_exists("email", $_POST))
    && (array_key_exists("password", $_POST))
)
{
    $email = $_POST["email"];
    $password = $_POST["password"];
    // Trying to login
    $controller = new LoginController();
    $isFound = $controller->login($email, $password);
    
    // If not found then set $error
    if (!$isFound) $error = "Invalid email/password";
    // Redirect to dashboard
    else {
      header('Location: dashboard.php');
      exit();
    }
}

// Creating new view and outputting it
$view = new LoginView();
$view->output(
    isset($email) ? $email : "",
    isset($password) ? $password : "",
    $error ?? null
);

?>