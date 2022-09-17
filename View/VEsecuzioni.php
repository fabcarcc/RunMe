<?php

class VEsecuzioni extends VBaseView
{
    function mostraElenco($esecuzioni){
        $this->assign("results", $esecuzioni);
        $this->display("esecuzioni.tpl");
    }
}
