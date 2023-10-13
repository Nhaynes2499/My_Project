<?php

// Represents user's role and operations with this model
class RoleModel extends Model
{
    // Id of the role
    public $id;
    // Role name
    public $role;

    /**
     * Constructs new role object with given data
     */
    function __construct($id, $role)
    {
        $this->id = $id;
        $this->role = $role;
    }

    // Static methods
    
    /**
     * Searches for role name for the role with given id
     * Returns null if not found otherwise role name
     */
    public static function getRoleName($roleId)
    {
        $mysqli = RoleModel::getMysqli();
        $stmt = $mysqli->prepare("SELECT role FROM roles WHERE id = ?");
        $stmt->bind_param("i", $roleId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_array(MYSQLI_ASSOC);

        return $row ? $row["role"] : null;
    }
}

?>