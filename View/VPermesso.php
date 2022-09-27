<?php

class VPermesso extends VBaseView
{
    function mostraSelect(array $utenti, array $esecuzioni){
        $this->assign('Utenti', $utenti);
        $this->assign('Esecuzioni', $esecuzioni);
        $this->display('permessoSelect.tpl');
    }

    function mostraForm(array $lista, $target) {

        $this->assign('Lista',$lista);

        if (get_class($target) == 'EUtente')
            $this->assign('targetUser', $target);
        if (get_class($target) == 'EEsecuzione')
            $this->assign('targetEsecuzione', $target);

        $this->display('permessoForm.tpl');

    }
}