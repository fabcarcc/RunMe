<?php
/*
 * Autoload function
*/
spl_autoload_register(function ($class_name) {
    $file = '';
    switch ($class_name[0]) {
        case 'V':
            $file = 'View/' . $class_name . '.php';
            break;
        case 'F':
            $file = 'Foundation/' . $class_name . '.php';
            break;
        case 'E':
            $file = 'Entity/' . $class_name . '.php';
            break;
        case 'C':
            $file = 'Controller/' . $class_name . '.php';
            break;
        case 'U':
            $file = 'Foundation/Utility/' . $class_name . '.php';
            break;
    }
    if(file_exists($file)){ include $file; }

});


