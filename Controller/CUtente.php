<?php

class CUtente
{
    const DEFAULT_METHOD = "run";

    static function login(){
        $res = false;
        $err = '';
        $username = $_POST["username"];
        $password = $_POST["password"];
        $u = null;

        if (isset($username) && isset($password)) {
            $fp = FPersistentManager::getInstance();
            $u = $fp->load("EUtente",$username,"username");
            if ($u) {
                if ($u->getPassword() != md5($password)) $err = "Login Errato!";
                elseif (!$u->getAbilitato()) $err = "Utente non abilitato al login<br>Contatta l'amministratore.";
                else $res = true;
            }
        }

        if ($res) {
            USession::set('user',$u);
        }
        else {
            USession::set('message',$err);
            USession::set('messageType','danger');
        }
        header('Location: /RunMe');
    }

    static function logout(){
        USession::del('user');
        header('Location: /RunMe');
    }
}