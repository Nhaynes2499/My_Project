<?php
class CreateResearchersView
{
    /**
     * Outputs current view
     */
    public function output($username, $email, $password, $roleId, $errors)
    {
        // Current user info
        $currentUser = UserModel::getCurrentUser();
        // Available roles
        $roles = [
            [
                "id" => 2,
                "role" => "Research Study Manager",
            ],
            [
                "id" => 3,
                "role" => "Researcher",
            ]
        ];

        require('tpl/create_researchers.html');
    }
}

?>