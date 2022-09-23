<?php

class CFrontController{

    const DEFAULT_CONTROLLER = 'CEsecuzione';
    const DEFAULT_METHOD = 'mostraElenco';

    static function run(){
        $request = preg_split("#[][&?/]#", $_SERVER['REQUEST_URI']);
        $error = false;

        $class = ($request[2] != '' ? "C" . $request[2] : static::DEFAULT_CONTROLLER);

        if (!class_exists($class)) { echo "E1"; $error = true;}
        else {
            $method = '';
            if (isset($request[3])) $method = $request[3];
            elseif (defined("$class::DEFAULT_METHOD")) $method = $class::DEFAULT_METHOD;
            if ($method == '') { echo "E2"; $error = true;}
            else {
                if (!method_exists($class, $method)) { echo "E3"; $error = true;}
                else {
                    $rm = new ReflectionMethod("$class::$method");
                    if (count($request) > 4 && count($request) - 4 != $rm->getNumberOfParameters()) { echo "E4"; $error = true;}
                    else {
                        switch (count($request)) {
                            case 3:
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
                                echo "E5"; $error = true;
                        }
                    }
                }
            }
        }
        if ($error) {
            echo "Invalid URL";
            die;
        }

    }
}