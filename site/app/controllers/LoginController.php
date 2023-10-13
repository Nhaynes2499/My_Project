<?php

// Contains operations on login page
class LoginController
{
    /**
     * Checks given username and password combination and tries to login
     * Return true in case of success otherwise false
     */
    function login($email, $password)
    {
        // Searching for user with given credentials
        $user = UserModel::findWithCredentials($email, $password);
        if (!$user) return false;

        // Remembering user's id
        $_SESSION["currentUserId"] = $user;
        return true;
    }
}

?>