<?php

class CPermesso
{
    const DEFAULT_METHOD = 'mostraSelect';

    static function mostraSelect(){
        $user = USession::get('user');
        if ( !$user || !$user->getAdmin() ) CFrontController::nonAutorizzato();

        $fp = FPersistentManager::getInstance();
        $utenti = $fp->getAll('EUtente');
        $esecuzioni = $fp->getAll('EEsecuzione');
        $view = new VPermesso();
        $view->mostraSelect($utenti, $esecuzioni);
    }

    static function permessiUtente(int $iduser) {
        $user = USession::get('user');
        if ( !$user || !$user->getAdmin() ) CFrontController::nonAutorizzato();

        $fp = FPersistentManager::getInstance();

        if ($user->getId() == $iduser) $targetUser = $user;
        else $targetUser = $fp->load('EUtente', $iduser);

        if ($_SERVER['REQUEST_METHOD']=="GET") {

            $permessi = $fp->load('EPermesso',$iduser,'idUtente',false);
            $listaPerm = [];
            if ($permessi) {
                foreach ($permessi as $p) {
                    $listaPerm[] = $p->getIdEsecuzione();
                }
            }

            $esecuzioni = $fp->getAll('EEsecuzione');
            $lista = [];
            if ($esecuzioni){
                foreach ($esecuzioni as $e) {
                    $el = [];
                    $el['id'] = $e->getId();
                    $el['nome'] = $e->getNome();
                    if (in_array($e->getId(),$listaPerm)) $el['on'] = true;
                    else $el['on'] = false;
                    $lista[] = $el;
                }
            }

            $view = new VPermesso();
            $view->mostraForm($lista, $targetUser);
        }
        else if ($_SERVER['REQUEST_METHOD']=="POST") {
            static::modificaPermessi($targetUser,$_POST);
        }

    }

    static function permessiEsecuzione(int $idesecuzione) {
        $user = USession::get('user');
        if ( !$user || !$user->getAdmin() ) CFrontController::nonAutorizzato();

        $fp = FPersistentManager::getInstance();

        $targetEsecuzione = $fp->load('EEsecuzione', $idesecuzione);

        if ($_SERVER['REQUEST_METHOD']=="GET") {

            $permessi = $fp->load('EPermesso',$idesecuzione,'idEsecuzione',false);
            $listaPerm = [];
            if ($permessi) {
                foreach ($permessi as $p) {
                    $listaPerm[] = $p->getIdUtente();
                }
            }

            $utenti = $fp->getAll('EUtente');
            $lista = [];
            if ($utenti){
                foreach ($utenti as $u) {
                    $el = [];
                    $el['id'] = $u->getId();
                    $el['nome'] = $u->getUsername();
                    if (in_array($u->getId(),$listaPerm)) $el['on'] = true;
                    else $el['on'] = false;
                    $lista[] = $el;
                }
            }

            $view = new VPermesso();
            $view->mostraForm($lista, $targetEsecuzione);
        }
        else if ($_SERVER['REQUEST_METHOD']=="POST") {
            static::modificaPermessi($targetEsecuzione,$_POST);
        }

    }

    private static function modificaPermessi($target,$val){
        $loggedUser = USession::get('user');
        $fp = FPersistentManager::getInstance();

        $isUser = (get_class($target) == 'EUtente'); // EUtente => true  EEsecuzione => false

        $permessi = $isUser ? $fp->load('EPermesso',$target->getId(),'idUtente', false)
                            : $fp->load('EPermesso',$target->getId(),'idEsecuzione', false);

        $attuali = [];
        $toAdd = [];
        $toRemove = [];

        if ($permessi) {
            foreach ($permessi as $p) { $attuali[] = $isUser ? $p->getIdEsecuzione() : $p->getIdUtente();}
        }
        // Permessi da aggiungere
        foreach ($val as $key => $v) {
            if (!in_array($key,$attuali)) {
                $perm = new EPermesso();
                if ($isUser) {
                    $perm->setIdUtente($target->getId());
                    $perm->setIdEsecuzione($key);
                }
                else {
                    $perm->setIdUtente($key);
                    $perm->setIdEsecuzione($target->getId());
                }
                $toAdd[] = $perm;
            }
        }
        // Permessi da rimuovere
        foreach ($attuali as $act) {
            if (!array_key_exists($act,$val)) {
                $toRemove[] = $act;
            }
        }

        $err = false;

        foreach ($toAdd as $perm) {
            if ($perm->save()) {
                if ($isUser) {
                    $es = $fp->load('EEsecuzione',$perm->getIdEsecuzione());
                    CLog::generaLog(38,$loggedUser,$target,$es);
                }
                else {
                    $us = $fp->load('EUtente',$perm->getIdUtente());
                    CLog::generaLog(38,$loggedUser,$us,$target);
                }
            }
            else $err = true;

        }
        foreach ($toRemove as $id){
            $permToRemove = '';
            foreach ($permessi as $perm) {
                $check = $isUser ? $perm->getIdEsecuzione() : $perm->getIdUtente();
                if ($check == $id){
                    $permToRemove = $perm;
                    break;
                }
            }
            if ($permToRemove->delete()){
                if ($isUser) {
                    $es = $fp->load('EEsecuzione',$permToRemove->getIdEsecuzione());
                    CLog::generaLog(39,$loggedUser,$target,$es);
                }
                else {
                    $us = $fp->load('EUtente',$permToRemove->getIdUtente());
                    CLog::generaLog(39,$loggedUser,$us,$target);
                }
            }
            else $err = true;
        }

        if (count($toAdd) == 0 && count($toRemove) == 0) {
            $msg = "Nessuna modifica rilevata.";
            USession::set('message',$msg);
            USession::set('messageType','warning');
        }
        elseif ($err) {
            $msg = "Qualcosa è andato storto...";
            USession::set('message',$msg);
            USession::set('messageType','danger');
        }
        else {
            $msg = "Modifiche salvate correttamente.";
            USession::set('message',$msg);
            USession::set('messageType','success');
        }

        $loc = $isUser ? 'Location: /RunMe/Permesso/permessiUtente/' . $target->getId() : 'Location: /RunMe/Permesso/permessiEsecuzione/' . $target->getId();
        //$loc = 'Location: /RunMe/Permesso/';
        header($loc);
        //echo $loc;
    }


}