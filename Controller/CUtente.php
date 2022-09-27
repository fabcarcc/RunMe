<?php

class CUtente
{
    const DEFAULT_METHOD = "mostraElenco";

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

    static function mostraElenco(){
        $user = USession::get('user');
        if ( !$user || !$user->getAdmin() ) CFrontController::nonAutorizzato();

        $fp = FPersistentManager::getInstance();
        $utenti = $fp->getAll('EUtente');

        $view = new VUtente();
        $view->mostraElenco($utenti);

    }

    static function newmod(int $id = null){
        $user = USession::get('user');
        if ( !$user || !$user->getAdmin() ) CFrontController::nonAutorizzato();
        if ($id){
            if ($id == -1) CFrontController::nonValido();
            $fp = FPersistentManager::getInstance();
            $target = $fp->load('EUtente', $id);
            if (!$target) CFrontController::nonValido();

            if ($_SERVER['REQUEST_METHOD']=="GET") {
                $view = new VUtente();
                $view->mostraForm($target);
            }
            else if ($_SERVER['REQUEST_METHOD']=="POST") {
                static::modificaUtente($target,$_POST);
            }
        }
        else{
            if ($_SERVER['REQUEST_METHOD']=="GET") {
                $view = new VUtente();
                $view->mostraForm();
            }
            else if ($_SERVER['REQUEST_METHOD']=="POST") {
                static::creaUtente($_POST);
            }
        }
    }

    private static function modificaUtente($target, $val){
        $loggedUser = USession::get('user');
        $modificato = false;
        $admin = 0;
        $abilitato = 0;
        $resta = false;
        if (
            ( $val['password'] != '' && $val['password2'] == '' ) ||
            ( $val['password'] == '' && $val['password2'] != '' ) ||
            ( $val['password'] != '' && $val['password2'] != '' && $val['password'] != $val['password2'])
        ) {
            $resta = true;
            $msg = "Le password non coincidono";
            USession::set('message',$msg);
            USession::set('messageType','warning');
        }
        else {
            if ($val['password'] != '') {
                $target->setPassword(md5($val['password']));
                $modificato = true;
            }
            if ($val['email'] != $target->getEmail()) {
                $target->setEmail($val['email']);
                $modificato = true;
            }
            if (isset($val['admin']) && !$target->getAdmin()) {
                $target->setAdmin(true);
                $admin = 1;
            }
            if (!isset($val['admin']) && $target->getAdmin()) {
                $target->setAdmin(false);
                $admin = -1;
            }
            if (isset($val['abilitato']) && !$target->getAbilitato()) {
                $target->setAbilitato(true);
                $abilitato = 1;
            }
            if (!isset($val['abilitato']) && $target->getAbilitato()) {
                $target->setAbilitato(false);
                $abilitato = -1;
            }

            if ($modificato || $admin || $abilitato) {
                if ($target->save()) {
                    if ($modificato) CLog::generaLog(12,$loggedUser,$target);
                    if ($admin == 1) CLog::generaLog(18,$loggedUser,$target);
                    if ($admin == -1) CLog::generaLog(19,$loggedUser,$target);
                    if ($abilitato == 1) CLog::generaLog(16,$loggedUser,$target);
                    if ($abilitato == -1) CLog::generaLog(17,$loggedUser,$target);
                    $msg = "Utente Modificato correttamente";
                    USession::set('message',$msg);
                    USession::set('messageType','success');
                }
                else {
                    $msg = "Errore nella modifica dell'utente!";
                    USession::set('message',$msg);
                    USession::set('messageType','danger');
                }
            }
            else $resta = true;
        }
        if ($resta) header('Location: /RunMe/Utente/newmod/' . $target->getId());
        else header('Location: /RunMe/Utente');

    }

    private static function creaUtente($val){
        $loggedUser = USession::get('user');
        $resta = false;
        if ($val['password'] != $val['password2']) {
            $resta = true;
            $msg = "Le password non coincidono";
            USession::set('message',$msg);
            USession::set('messageType','warning');
        }
        else {
            $fp = FPersistentManager::getInstance();
            if ($fp->exist('EUtente',$val['username'],'username')) {
                $resta = true;
                $msg = "Lo Username indicato è già in uso";
                USession::set('message',$msg);
                USession::set('messageType','warning');
            }
            else {
                $u = new EUtente();
                $u->setUsername($val['username']);
                $u->setPassword(md5($val['password']));
                $u->setEmail($val['email']);
                $u->setAdmin(isset($val['admin']));
                $u->setAbilitato(isset($val['abilitato']));

                if ($u->save()) {
                    CLog::generaLog(10,$loggedUser,$u);
                    if ($u->getAdmin()) CLog::generaLog(18,$loggedUser,$u);
                    if (!$u->getAbilitato()) CLog::generaLog(17,$loggedUser,$u);
                    $msg = "Utente Creato correttamente";
                    USession::set('message',$msg);
                    USession::set('messageType','success');
                }
                else {
                    $msg = "Errore nella creazione dell'utente!";
                    USession::set('message',$msg);
                    USession::set('messageType','danger');
                }
            }
        }
        if ($resta) header('Location: /RunMe/Utente/newmod');
        else header('Location: /RunMe/Utente');

    }

    static function delete(int $id){
        $user = USession::get('user');
        if ( !$user || !$user->getAdmin() ) CFrontController::nonAutorizzato();
        $fp = FPersistentManager::getInstance();
        if ($fp->remove('EUtente',$id)) {
            $msg = "Utente eliminato Correttamente";
            USession::set('message',$msg);
            USession::set('messageType','success');
        }
        else {
            $msg = "Errore durante l'eliminazione dell'Utente";
            USession::set('message',$msg);
            USession::set('messageType','danger');
        }
        header('Location: /RunMe/Utente');
    }
}
