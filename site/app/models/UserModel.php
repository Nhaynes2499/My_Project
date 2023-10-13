<?php

// Represents user and operations with this model
class UserModel extends Model
{
    // Id of the user
    public $id;
    // Username
    public $username;
    // User's email
    public $email;
    // User's access level
    public $accessLevel;

    /**
     * Constructs new user object with given data
     */
    function __construct($id, $username, $email, $accessLevel)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->accessLevel = $accessLevel;
    }

    // Static methods

    /**
     * Searchs for user with given email and password
     * Returns id in case of success, otherwise null
     */
    public static function findWithCredentials($email, $password)
    {
        // Retrieving password hash and id for given user
        $mysqli = UserModel::getMysqli();
        $stmt = $mysqli->prepare(
            "SELECT id, password FROM users WHERE email = ?"
        );
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if (!$row) return null;
        // Checking password
        if (!password_verify($password, $row["password"])) return null;

        return $row["id"];
    }

    public static function getCurrentUser()
    {
        $id = $_SESSION["currentUserId"];
        // Retrieving user info with such id
        $mysqli = UserModel::getMysqli();
        $stmt = $mysqli->prepare(<<<QUERY
            SELECT users.id, users.username, users.email, ual.accessLevel
            FROM users
                INNER JOIN user_access_levels ual ON ual.email = users.email 
            WHERE users.id = ?
        QUERY);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_array(MYSQLI_ASSOC);

        return new UserModel(
            $row["id"], $row["username"], $row["email"], $row["accessLevel"]
        );
    }

    /**
     * Returns true if this username exists in database
     * otherwise false
     */
    public static function isUsernameExists($username)
    {
        $mysqli = UserModel::getMysqli();
        $stmt = $mysqli->prepare("SELECT 1 FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    /**
     * Creates new user with given data
     */
    public static function create($username, $password, $email, $roleId)
    {
        // Preparing statement
        $mysqli = UserModel::getMysqli();
        $stmt = $mysqli->prepare(<<<QUERY
            INSERT INTO users(username, password, email, role)
            VALUES (?, ?, ?, ?)
        QUERY);
        // Hashing password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt->bind_param("sssi", $username, $hashedPassword, $email, $roleId);
        $stmt->execute();
    }
}

?>