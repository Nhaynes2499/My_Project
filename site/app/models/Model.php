<?php

// Basic model class for all models
class Model
{
    /**
     * Returns mysqli object to work with database
     */
    protected static function getMysqli()
    {
        return new mysqli(
          "localhost", "root", "", "user_management_system"
        );
    }
}

?>