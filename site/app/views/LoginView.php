<?php

// Login page view
class LoginView
{
    /**
     * Outputs current view
     */
    public function output($email, $password, $error)
    {
        include('tpl/login.html');
    }
}

?>