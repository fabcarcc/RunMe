<?php

/**
 * Classe View con funzioni statiche che non richiedono direttamente Smarty
 */
class VUtility
{

    public static function nonAutorizzato()
    {
        echo "Forbidden";
        header("HTTP/1.1 403 Forbidden");
        exit();
    }

    public static function nonValido()
    {
        echo "Invalid URL";
        header("HTTP/1.1 400 Bad Request");
        exit();
    }

    public static function redirectTo($location) {
        global $config;

        header('Location: /' . $config['appName'] . '/' . $location);
    }

    public static function downloadFile($name, $content) {
        header('Content-type: text/plain');
        header('Content-Disposition: attachment; filename="' . $name . '"');
        foreach ($content as $row) {
            echo $row . PHP_EOL;
        }
    }

}