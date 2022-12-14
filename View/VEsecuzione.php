<?php

class VEsecuzione extends VBaseView
{
    function mostraElenco($esecuzioni){
        global $config;
        if ($config['allowDelete']) $this->assign("delete",true);
        $this->assign("results", $esecuzioni);
        $this->display("esecuzioneElenco.tpl");
    }

    function mostraForm($esecuzione){
        $esecuzione->caricaParametri();
        $this->assign("result", $esecuzione);
        $this->display("esecuzioneForm.tpl");
    }

    function mostraOutput($id = null){
        if ($id) $this->assign('id',$id);
        $this->display("esecuzioneOutput.tpl");
    }

    function mostraFormNewMod($eseguibili, $target = null){
        global $config;
        if ($config['allowUpload']) $this->assign("upload",true);
        if ($target){
            $this->assign("target", $target);
        }
        $this->assign("eseguibili", $eseguibili);
        $this->display("esecuzioneFormNewMod.tpl");
    }
}
