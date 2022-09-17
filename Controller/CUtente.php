<?php

class CUtente
{
    const DEFAULT_METHOD = "run";

    static function login(){
        $res = false;
        $username = $_POST["username"];
        $password = $_POST["password"];
        $u = null;

        if (isset($username) && isset($password)) {
            $fp = FPersistentManager::getInstance();
            $u = $fp->load("EUtente",$username,"username");
            if ($u && $u->getPassword() == md5($password)) $res = true;
        }

        if ($res) {
            USession::set('user',$u);
            CEsecuzione::mostraElenco();
        }
        else {
            $err = "Login Errato!";
            CEsecuzione::mostraElenco($err);
        }
    }

    static function logout(){
        USession::del('user');
        CEsecuzione::mostraElenco();
    }
}