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
            VUtility::nonAutorizzato();
        }
        if ($user->getAdmin()) {
            static::mostraSelect();
        }
        else {
            static::mostraLogUtente($user->getId());
        }
    }

    static function mostraLogUtente(int $iduser, $dl = false) {
        $user = USession::get('user');
        if ( !$user || ( !$user->getAdmin() && $user->getId() != $iduser) ) VUtility::nonAutorizzato();
        $fp = FPersistentManager::getInstance();
        $logs = $fp->load('ELog',$iduser,'idUtente',false);

        if ( $dl != 1) {
            if ($user->getId() == $iduser) $targetUser = $user;
            else $targetUser = $fp->load('EUtente', $iduser);

            $view = new VLog();
            $view->mostraLog($logs, $targetUser, $user->getAdmin());
        }
        else {
            static::downloadLog($logs);
        }
    }

    static function mostraLogEsecuzione(int $idesecuzione, $dl = false) {
        $user = USession::get('user');
        if ( !$user || !$user->getAdmin() ) VUtility::nonAutorizzato();

        $fp = FPersistentManager::getInstance();
        $logs = $fp->load('ELog',$idesecuzione,'idEsecuzione',false);

        if ( $dl != 1 ) {
            $targetEsecuzione = $fp->load('EEsecuzione', $idesecuzione);
            $view = new VLog();
            $view->mostraLog($logs, $targetEsecuzione);
        }
        else {
            static::downloadLog($logs);
        }
    }

    private static function downloadLog($logs) {
        $output = [];
        foreach ($logs as $row) {
            $output[] = $row->getData() . " - " . strip_tags($row->getTesto());
        }
        VUtility::downloadFile('logs.txt',$output);
    }

    private static function mostraSelect(){
        $fp = FPersistentManager::getInstance();
        $utenti = $fp->getAll('EUtente');
        $esecuzioni = $fp->getAll('EEsecuzione');
        $view = new VLog();
        $view->mostraSelect($utenti, $esecuzioni);
    }

}


