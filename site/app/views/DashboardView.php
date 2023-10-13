<?php

// Represents dashboard view page for all groups
class DashboardView
{
    // Outputs current view
    public function output()
    {
        $currentUser = UserModel::getCurrentUser();

        include('tpl/dashboard.html');
    }
}

?>