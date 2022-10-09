<?php

//require_once 'includes/config.inc.php';

class CEsecuzione
{
    const DEFAULT_METHOD = 'mostraElenco';

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
        if (!static::autorizzato($id)) VUtility::nonAutorizzato();

        $fp = FPersistentManager::getInstance();
        $esecuzione = $fp->load('EEsecuzione', $id);

        if (!$esecuzione) VUtility::nonValido();

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
            $msg = "Il comando selezionato non è valido e non può essere eseguito.<br>Contatta l'Amministratore";
            USession::set('message',$msg);
            USession::set('messageType','warning');

            CLog::generaLog(1,null, USession::get('user'), $esecuzione);
            $view = new VEsecuzione();
            $view->mostraOutput();

        }
        else {
            if ($esecuzione->getParametri()) {
                foreach ($esecuzione->getParametri() as $p){
                    // Parametro nascosto, valore da DB
                    if ($p->getTipoParametro() == 3) {
                        $c .= " " . $p->getPre() . $p->getValore() . $p->getPost();
                    }
                    // Parametri obbligatori o selezionati
                    if ($p->getTipoParametro() == 0 || isset($param['check'.$p->getId()])) {
                        // Tipo senza valore, valore da DB
                        if ($p->getTipoValore() == 0) {
                            $c .= " " . $p->getPre() . $p->getValore() . $p->getPost();
                        }
                        else {
                            // Tipo con valore, valore da form
                            $c .= " " . $p->getPre() . $param['val'.$p->getId()] . $p->getPost();
                        }
                    }
                }
            }
            $output=null;
            $retval=null;
            exec(escapeshellcmd($c), $output, $retval);

            CLog::generaLog(0,null, USession::get('user'), $esecuzione);

            if ($retval == 0) {
                $msg = "Il comando è stato eseguito correttamente!<br>";
                USession::set('messageType','success');
            }
            else{
                $msg = "Il comando è stato eseguito ma ha restituito un errore!<br>";
                USession::set('messageType','danger');
            }

            if ($esecuzione->getMostraOutput()) {
                USession::set('lastOutput',$output);
                $msg .= "<br><strong>Output:</strong><br><br>";
                $msg .= "<p class=\"font-monospace\">";
                foreach ($output as $row) {
                    $msg .= $row . "<br>";
                }
                $msg .= "</p>";
                $msg .= "<p><a class='alert-link' href='/RunMe/Esecuzione/lastOutput'>Salva Output</a>";
            }
            USession::set('message',$msg);

            $view = new VEsecuzione();
            $view->mostraOutput($esecuzione->getId());

        }

    }

    static function lastOutput() {
        $output = USession::get('lastOutput');
        if (!$output) VUtility::nonValido();
        VUtility::downloadFile('output.txt', $output);
    }

    private static function autorizzato(int $id){

        $fp = FPersistentManager::getInstance();
        $user = USession::get('user');
        if ($user) {
            if($user->getAdmin()) return true;
            return (
                $fp->exist('EPermesso',$user->getId(),'idUtente', $id,'idEsecuzione') ||
                $fp->exist('EPermesso',-1,'idUtente', $id,'idEsecuzione')
            );
        }
        else {
            return $fp->exist('EPermesso',-1,'idUtente', $id,'idEsecuzione');
        }
    }

    static function newmod(int $id = null){
        $user = USession::get('user');
        if ( !$user || !$user->getAdmin() ) VUtility::nonAutorizzato();
        if (!is_null($id)){
            if ($id == -1) VUtility::nonValido();
            $fp = FPersistentManager::getInstance();
            $target = $fp->load('EEsecuzione', $id);
            if (!$target) VUtility::nonValido();

            if ($_SERVER['REQUEST_METHOD']=="GET") {
                $target->caricaParametri();
                $view = new VEsecuzione();
                $view->mostraFormNewMod(static::listaEseguibili(), $target);
            }
            else if ($_SERVER['REQUEST_METHOD']=="POST") {
                static::modificaEsecuzione($_POST, $target);
            }
        }
        else{
            if ($_SERVER['REQUEST_METHOD']=="GET") {
                $view = new VEsecuzione();
                $view->mostraFormNewMod(static::listaEseguibili());
            }
            else if ($_SERVER['REQUEST_METHOD']=="POST") {
                static::modificaEsecuzione($_POST);
            }
        }
    }

    private static function modificaEsecuzione($val, $target = null){
        //debug($val);

        $new = false;
        if (!$target) {
            $target = new EEsecuzione();
            $new = true;
        }

        $target->setNome($val['nome']);
        $target->setDescrizione($val['descrizione']);
        $target->setEseguibile($val['eseguibile']);
        if ($val['mostraoutput']) $target->setMostraOutput(true); else $target->setMostraOutput(false);
        if ($val['abilitato']) $target->setAbilitato(true); else $target->setAbilitato(false);

        $npar = (count($val) - 5) / 7;
        $i = 1;

        $parametri = [];

        while ($npar > 0) {
            if (array_key_exists($i . 'nome', $val)) {
                $p = new EParametro();
                $p->setNome($val[$i . 'nome']);
                $p->setDescrizione($val[$i . 'descrizione']);
                $p->setTipoParametro($val[$i . 'tipoParametro']);
                $p->setPre($val[$i . 'pre']);
                $p->setValore($val[$i . 'valore']);
                $p->setPost($val[$i . 'post']);
                $p->setTipoValore($val[$i . 'tipoValore']);

                $parametri[] = $p;

                $npar--;
            }
            $i++;
        }

        $target->setParametri($parametri);

        if ($target->save()) {
            $loggedUser = USession::get('user');

            if ($new) {
                $msg = "Esecuzione Creata correttamente";
                CLog::generaLog(20, $loggedUser,null, $target);
            }
            else {
                $msg = "Esecuzione Modificata correttamente";
                CLog::generaLog(22, $loggedUser,null, $target);

            }
            USession::set('messageType','success');

        }
        else {
            $msg = "Qualcosa è andato storto!";
            USession::set('messageType','danger');
        }

        USession::set('message',$msg);

        VUtility::redirectTo('Esecuzione');

    }

    private static function listaEseguibili(){
        global $config;
        $dir = $config['scriptDir'];
        $files = scandir($dir);
        $eseguibili = [];
        foreach ($files as $f) {
            if ($f !== '.' && $f !== '..'  && is_file($dir . $f) && is_executable($dir . $f)) {
                $eseguibili[] = $f;
            }
        }
        return $eseguibili;
    }

    static function clona(int $id){
        $user = USession::get('user');
        if ( !$user || !$user->getAdmin() ) VUtility::nonAutorizzato();
        $fp = FPersistentManager::getInstance();
        $target = $fp->load('EEsecuzione', $id);
        $target->caricaParametri();

        $nome = $target->getNome() . '_clone';
        $i = 2;
        while ($fp->exist('EEsecuzione',$nome,'Nome')) {
            $nome = $target->getNome() . '_clone_(' . $i . ')';
            $i++;
        }
        $target->setId(null);
        $target->setNome($nome);

        if ($target->save()) {
            $loggedUser = USession::get('user');
            $msg = "Esecuzione Clonata correttamente";
            CLog::generaLog(23, $loggedUser,null, $target);

            USession::set('messageType','success');
        }
        else {
            $msg = "Qualcosa è andato storto!";
            USession::set('messageType','danger');
        }

        USession::set('message',$msg);

        VUtility::redirectTo('Esecuzione');

    }

    static function delete(int $id){
        global $config;
        if (!$config['allowDelete']) VUtility::nonValido();
        $user = USession::get('user');
        if ( !$user || !$user->getAdmin() ) VUtility::nonAutorizzato();
        $fp = FPersistentManager::getInstance();
        if ($fp->remove('EEsecuzione',$id)) {
            $msg = "Esecuzione eliminata Correttamente";
            USession::set('message',$msg);
            USession::set('messageType','success');
        }
        else {
            $msg = "Errore durante l'eliminazione dell'Esecuzione";
            USession::set('message',$msg);
            USession::set('messageType','danger');
        }
        VUtility::redirectTo('Esecuzione');
    }

    static function upload(){
        global $config;
        if (! $config['allowUpload']) VUtility::nonValido();

        $user = USession::get('user');
        if ( !$user || !$user->getAdmin() ) VUtility::nonAutorizzato();

        $uploaddir = $config['scriptDir'];
        $uploadfile = $uploaddir . basename($_FILES['upload']['name']);

        if (file_exists($uploadfile)) {
            $msg = "Nome file già in uso.";
            USession::set('messageType','warning');
        }
        else {

            if (move_uploaded_file($_FILES['upload']['tmp_name'], $uploadfile)) {
                chmod($uploadfile,0744);
                $msg = "Upload completato correttamente.";
                USession::set('messageType','success');

            } else {
                $msg = "Upload non riuscito.";
                USession::set('messageType','danger');
            }
        }
        USession::set('message',$msg);

        $loc = 'Esecuzione/newmod';
        if (isset($_POST['id'])) $loc .= '/' . $_POST['id'];
        VUtility::redirectTo($loc);

    }
}