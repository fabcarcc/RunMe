<?php

class CLog
{

    const DEFAULT_METHOD = 'mostraElenco';

    static function generaLog(int $tipo, EUtente $admin = null, EUtente $user = null, EEsecuzione $esecuzione = null) {
        $log = new ELog();
        $log->setTipo($tipo);
        if ($admin) $log->setIdAdmin($admin->getId());
        if ($user) $log->setIdUtente($user->getId());
        else {
            if ($tipo == 0 || $tipo == 1) { $log->setIdUtente(-1);}
        }
        if ($esecuzione) $log->setIdEsecuzione($esecuzione->getId());
        $log->generaTesto($admin, $user, $esecuzione);
        $log->save();
    }

    static function mostraElenco(){
        $user = USession::get('user');
        if (! $user) {
            CFrontController::nonAutorizzato();
        }
        if ($user->getAdmin()) {
            static::mostraSelect();
        }
        else {
            static::mostraLogUtente($user->getId());
        }
    }

    static function mostraLogUtente(int $iduser) {
        $user = USession::get('user');
        if ( !$user || ( !$user->getAdmin() && $user->getId() != $iduser) ) CFrontController::nonAutorizzato();
        $fp = FPersistentManager::getInstance();
        $logs = $fp->load('ELog',$iduser,'idUtente',false);

        if ($user->getId() == $iduser) $targetUser = $user;
        else $targetUser = $fp->load('EUtente', $iduser);

        $view = new VLog();
        $view->mostraLog($logs, $targetUser, $user->getAdmin());
    }

    static function mostraLogEsecuzione(int $idesecuzione) {
        $user = USession::get('user');
        if ( !$user || !$user->getAdmin() ) CFrontController::nonAutorizzato();

        $fp = FPersistentManager::getInstance();
        $logs = $fp->load('ELog',$idesecuzione,'idEsecuzione',false);

        $targetEsecuzione = $fp->load('EEsecuzione', $idesecuzione);
        $view = new VLog();
        $view->mostraLog($logs, $targetEsecuzione);
    }

    private static function mostraSelect(){
        $fp = FPersistentManager::getInstance();
        $utenti = $fp->getAll('EUtente');
        $esecuzioni = $fp->getAll('EEsecuzione');
        $view = new VLog();
        $view->mostraSelect($utenti, $esecuzioni);
    }

}


