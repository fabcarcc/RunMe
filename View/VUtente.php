<?php

class VUtente extends VBaseView
{
    function mostraElenco($utenti){
        $this->assign("Utenti", $utenti);
        $this->display("utenteElenco.tpl");
    }

    function mostraForm($target = null){
        if ($target) $this->assign('target',$target);
        $this->display('utenteForm.tpl');
    }

}