<?php

class CEsecuzione
{
    static function mostraElenco(){
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

        $view = new VEsecuzione();
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

    static function run(int $id) {
        if (!static::autorizzato($id)) {
            header("HTTP/1.1 403 Forbidden");
            exit();
        }

        $fp = FPersistentManager::getInstance();
        $esecuzione = $fp->load('EEsecuzione', $id);

        if ($_SERVER['REQUEST_METHOD']=="GET") {
            $view = new VEsecuzione();
            $view->mostraForm($esecuzione);
        }
        else if ($_SERVER['REQUEST_METHOD']=="POST") {
            $esecuzione->caricaParametri();
            static::esegui($esecuzione,$_POST);
        }


    }

    private static function esegui($esecuzione, $param){
        global $config;
        $c = $config['scriptDir'] . $esecuzione->getEseguibile();
        $msg = '';

        if (!is_executable($c)) {
            $msg = "L'esecuzione selezionata non è valida e non può essere eseguita.<br>Contatta l'Amministratore";
            USession::set('message',$msg);
            USession::set('messageType','warning');

            $view = new VEsecuzione();
            $view->mostraOutput();

        }
        else {
            foreach ($esecuzione->getParametri() as $p){
                if ($p->getObbligatorio() || isset($param['check'.$p->getId()])) {
                    $c .= " " . $p->getPre() . $param['val'.$p->getId()] . $p->getPost();
                }
            }
            $output=null;
            $retval=null;
            exec($c, $output, $retval);

            if ($retval == 0) {
                $msg = "Il comando è stato eseguito correttamente!<br>";
                USession::set('messageType','success');
            }
            else{
                $msg = "Il comando è stato eseguito ma ha restituito un errore!<br>";
                USession::set('messageType','danger');
            }

            if ($esecuzione->getMostraOutput()) {
                $msg .= "<br><strong>Output:</strong><br><br>";
                $msg .= "<p class=\"font-monospace\">";
                foreach ($output as $row) {
                    $msg .= $row . "<br>";
                }
                $msg .= "</p>";
            }
            USession::set('message',$msg);

            $view = new VEsecuzione();
            $view->mostraOutput($esecuzione->getId());

        }


    }

    private static function autorizzato(int $id){
        $idUtente = -1;
        $user = USession::get('user');
        if ($user) {
            if($user->getAdmin()) return true;
            $idUtente = $user->getId();
        }

        $fp = FPersistentManager::getInstance();
        return $fp->exist('EPermesso',$idUtente,'idUtente', $id,'idEsecuzione');
    }




}