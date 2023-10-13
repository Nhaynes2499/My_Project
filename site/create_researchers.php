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
} elseif (!$authController->hasAccessLevel('Research Group Manager')) {
    // Redirect to dashboard
    header('Location: dashboard.php');
    exit();
}

// Validating
$errors = [];
$controller = new CreateResearchersController();
// Username
if (array_key_exists("username", $_POST))
{
    $username = $_POST["username"];
    $error = $controller->checkUsername($username);
    if ($error) $errors["username"] = $error;
}
// Password
if (array_key_exists("password", $_POST))
{
    $password = $_POST["password"];
    $error = $controller->checkPassword($password);
    if ($error) $errors["password"] = $error;
}
// Email
if (array_key_exists("email", $_POST)) $email = $_POST["email"];
// Role
if (array_key_exists("role", $_POST)) {
    $role = $_POST["role"];
    $error = $controller->checkRole($role);
    if ($error) $errors["role"] = $error;
}

// If all fields are set and no errors 
if (
    isset($username)
    && isset($password)
    && isset($email)
    && isset($role)
    && !count($errors)
)
{
    // Creating new user
    $controller->create($username, $password, $email, $role);
    // Logging out
    $authController->logout();
    // Redirecting to login page
    header('Location: login.php');
    exit();
}

// Creating new view and outputting it
$view = new CreateResearchersView();
$view->output(
    isset($username) ? $username : '',
    isset($email) ? $email : '', 
    isset($password) ? $password : '',
    isset($role) ? $role : "",
    $errors
);

?>