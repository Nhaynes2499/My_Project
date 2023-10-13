<?php

spl_autoload_register(function ($class_name) {
    // Is this View class?
    if (str_ends_with($class_name, "View"))
    {
        include_once("views/{$class_name}.php");
    }
    elseif (str_ends_with($class_name, "Controller"))
    {
        include_once("controllers/{$class_name}.php");
    }
    elseif (str_ends_with($class_name, "Model"))
    {
        include_once("models/{$class_name}.php");
    }
});

?>