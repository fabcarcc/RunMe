<?php

class USession {
//    public function __construct() {
//        session_start();
//    }

    static function set($key, $valore) {
        if (session_status() == PHP_SESSION_NONE) session_start();
        $_SESSION[$key]=$valore;
    }

    static function del($key) {
        if (session_status() == PHP_SESSION_NONE) session_start();
        unset($_SESSION[$key]);
    }

    static function get($key) {
        if (session_status() == PHP_SESSION_NONE) session_start();
        return $_SESSION[$key] ?? null;
    }
}
