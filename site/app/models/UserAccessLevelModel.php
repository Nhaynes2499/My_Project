<?php

// Represents user's access level and operations with this model
class UserAccessLevelModel extends Model
{
    // Static methods
    /**
     * Creates new user access level with given email and role
     */
    public static function create($email, $role)
    {
        $mysqli = UserModel::getMysqli();
        $stmt = $mysqli->prepare(<<<QUERY
            INSERT INTO user_access_levels(email, accessLevel)
            VALUES (?, ?)
        QUERY);
        $stmt->bind_param("ss", $email, $role);
        $stmt->execute();
    }
}

?>