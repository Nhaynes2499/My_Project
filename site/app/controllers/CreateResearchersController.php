<?php

// Contains operations on create researchers page
class CreateResearchersController
{
    /**
     * Checks given username.
     * Return null in case there are no errors with it otherwise string with
     * error description
     */
    public function checkUsername($username)
    {
        if (UserModel::isUsernameExists($username))
            return "Username must be unique";

        return null;
    }

    /**
     * Checks given password
     * Returns null in case there are no errors with it otherwise string with
     * error description
     */
    public function checkPassword($password)
    {
        if (strlen($password) < 10)
            return "Password must be at least 10 characters long";
        if (!preg_match('/.*[A-Z].*/', $password))
            return "Password must contain at least one upper case character";
        if (!preg_match('/.*[\d].*/', $password))
            return "Password must contain at least one digit";

        return null;
    }

    public function checkRole($roleId)
    {
        // Only Research Study Managers and Researchers
        if ($roleId == 1) return "Can't create another Research Group Manager";
        return null;
    }

    public function create($username, $password, $email, $roleId)
    {
        // Creating user
        UserModel::create($username, $password, $email, $roleId);
        // Creating access level
        $role = RoleModel::getRoleName($roleId);
        UserAccessLevelModel::create($email, $role);
    }
}

?>