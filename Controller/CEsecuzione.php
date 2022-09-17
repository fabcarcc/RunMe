<?php

class CEsecuzione
{
    function mostraElenco(){
        $fp = FPersistentManager::getInstance();
        $utente = USession::get('user');
        $esecuzioni = array();
        if (!$utente) {
            // non loggato: solo esecuzioni "pubbliche"
            $esecuzioni = static::listaEsecuzioniUtente(-1);
        }
        else {
            if ($utente->getAdmin()) {
                // Amministratore: tutte le esecuzioni
                $esecuzioni = $fp->getAll("EEsecuzione");
            }
            else {
                // utente normale: le esecuzioni per cui l'utente ha autorizzazione più le pubbliche
                $esecuzioni = static::listaEsecuzioniUtente($utente->getId(),true);
            }
        }

        $view = new VEsecuzioni();
        $view->mostraElenco($esecuzioni);

    }

    private function listaEsecuzioniUtente(int $idUser, bool $anchePubbliche = false) {
        $fp = FPersistentManager::getInstance();
        $permessi = $fp->load("EPermesso",$idUser,"idUtente",false);
        $esecuzioni = array();
        $idEsecuzioni = array();
        foreach ($permessi as $p){
            $e = $fp->load("EEsecuzione",$p->getIdEsecuzione());
            $esecuzioni[] = $e;
            $idEsecuzioni[] = $e->getId();
        }
        if ($anchePubbliche) {
            $pubbliche = static::listaEsecuzioniUtente(-1);
            foreach ($pubbliche as $pub) {
                if (!in_array($pub->getId(),$idEsecuzioni)){
                    $esecuzioni[] = $pub;
                }
            }
        }

        return $esecuzioni;
    }

    function pip($a = 0, $b = 0, $c = 0){
        echo "pip" . $a . " - " . $b . " .- " . $c;
    }
}