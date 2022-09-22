<?php

class CLog
{
    static function generaLog(int $tipo, EUtente $admin = null, EUtente $user = null, EEsecuzione $esecuzione = null) {
        $log = new ELog();
        $log->setTipo($tipo);
        if ($admin) $log->setIdAdmin($admin->getId());
        if ($user) $log->setIdUtente($user->getId());
        if ($esecuzione) $log->setIdEsecuzione($esecuzione->getId());
        $log->generaTesto($admin, $user, $esecuzione);
        $log->save();
    }
}