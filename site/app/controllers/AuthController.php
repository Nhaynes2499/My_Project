<?php

// Provides methods regarding authentication
class AuthController
{
    /**
     * Returns true if user is authenticated otherwise false
     */
    public function check()
    {
        return array_key_exists("currentUserId", $_SESSION);
    }

    /**
     * Returns true if current user has given access level
     * otherwise false
     */
    public function hasAccessLevel($accessLevel)
    {
        $user = UserModel::getCurrentUser();
        return $user->accessLevel == $accessLevel;
    }

    /**
     * Removes current user from session
     */
    public function logout()
    {
        session_destroy();
    }
}

?>