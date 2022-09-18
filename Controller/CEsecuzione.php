<?php

class CEsecuzione
{
    static function mostraElenco(string $loginErrorMessage = null){
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

        if ($loginErrorMessage) {
            $view->assign('loginErrorMessage', $loginErrorMessage);
        }
        $view->mostraElenco($esecuzioni);

    }

    private static function listaEsecuzioniUtente(int $idUser, bool $anchePubbliche = false) {
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

    function run(int $id) {
        $authorized = false;
        $user = USession::get('user');

    }
}