<?php

class CFrontController{

    const DEFAULT_CONTROLLER = 'CEsecuzione';
    const DEFAULT_METHOD = 'mostraElenco';

    static function run(){
        $request = preg_split("#[][&?/]#", $_SERVER['REQUEST_URI']);
        if ($request[count($request)-1] == '') array_pop($request);
        $error = 0;

        if (count($request) == 2) {
            $class = static::DEFAULT_CONTROLLER;
            $method = $class::DEFAULT_METHOD;
            $class::$method();
        }
        elseif (count($request) == 3) {
            $class = "C" . $request[2];
            if (!class_exists($class)) { $error = 1;}
            elseif (!defined("$class::DEFAULT_METHOD")) { $error = 2;}
            else {
                $method = $class::DEFAULT_METHOD;
                if (!method_exists($class, $method)) { $error = 3;}
                else $class::$method();
            }
        }
        else {
            $class = "C" . $request[2];
            $method = $request[3];
            if (! (class_exists($class) && method_exists($class, $method))) { $error = 4;}
            else {
                $rm = new ReflectionMethod("$class::$method");
                $par = count($request) - 4;
                if ($par > $rm->getNumberOfParameters() || $par < $rm->getNumberOfRequiredParameters()) { $error = 5;}
                else {
                    switch (count($request)) {
                        case 4:
                            $class::$method();
                            break;
                        case 5:
                            $class::$method($request[4]);
                            break;
                        case 6:
                            $class::$method($request[4], $request[5]);
                            break;
                        case 7:
                            $class::$method($request[4], $request[5], $request[6]);
                            break;
                        default:
                            $error = 6;
                    }
                }
            }
        }
        if ($error) VUtility::nonValido();
    }

}