<?php

class VLog extends VBaseView
{
    function mostraSelect(array $utenti, array $esecuzioni){
        $this->assign('Utenti', $utenti);
        $this->assign('Esecuzioni', $esecuzioni);
        $this->display('logSelect.tpl');
    }

    function mostraLog($logs, $target, $admin = true){

        if ($admin) $this->assign('Admin', true);
        $this->assign('Logs',$logs);

        if (get_class($target) == 'EUtente')
            $this->assign('targetUser', $target);
        if (get_class($target) == 'EEsecuzione')
            $this->assign('targetEsecuzione', $target);

        $this->display('logElenco.tpl');

    }
}