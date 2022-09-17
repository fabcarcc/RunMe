<?php

class CFrontController{

    const DEFAULT_CONTROLLER = 'CEsecuzione';
    const DEFAULT_METHOD = 'mostraElenco';

    static function run(){

        $request = preg_split("#[][&?/]#", $_SERVER['REQUEST_URI']);

        $class = (isset($request[2]) ? "C" . $request[2] : '');
        $function = ($request[3] ?? '');

        if ( class_exists($class) and method_exists($class, $function) ) {

            switch (count($request)) {
                case 4:
                    $class::$function();
                    break;
                case 5:
                    $class::$function($request[4]);
                    break;
                case 6:
                    $class::$function($request[4], $request[5]);
                    break;
                case 7:
                    $class::$function($request[4], $request[5], $request[6]);
                    break;
                default:
                    echo "Invalid URL";
                    die;
            }
        }
        else {
            $class = static::DEFAULT_CONTROLLER;
            $function = static::DEFAULT_METHOD;
            $class::$function();
        }

    }
}