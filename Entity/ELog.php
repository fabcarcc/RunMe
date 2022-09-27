<?php

class ELog extends EGenericObject
{
    private ?int $idAdmin = null;
    private ?int $idUtente = null;
    private ?int $idEsecuzione = null;
    private ?string $data = null;
    /**
     * @var int Il Tipo di log
     * 0 - L'utente lancia una esecuzione
     * 1 - L'utente tenta di lanciare una esecuzione non valida
     *
     * 10 - L'Admin crea un utente
     * 11 - L'Admin elimina un utente
     * 12 - L'Admin modifica un utente
     * 16 - L'Admin abilita l'utente
     * 17 - L'Admin disabilita l'utente
     * 18 - L'Admin da i diritti di amministrazione a un utente
     * 19 - L'Admin toglie i diritti di amministrazione a un utente
     *
     * 20 - L'Admin crea una esecuzione
     * 21 - L'Admin elimina una esecuzione
     * 22 - L'Admin modifica una esecuzione
     *
     * 38 - L'Admin da a un utente il permesso per una esecuzione
     * 39 - L'Admin toglie a un utente il permesso per una esecuzione
     */
    private int $tipo;
    private string $testo;

    /**
     * @return int
     */
    public function getIdAdmin(): ?int
    {
        return $this->idAdmin;
    }

    /**
     * @param int $idAdmin
     */
    public function setIdAdmin(?int $idAdmin): void
    {
        $this->idAdmin = $idAdmin;
    }

    /**
     * @return int
     */
    public function getIdUtente(): ?int
    {
        return $this->idUtente;
    }

    /**
     * @param int $idUtente
     */
    public function setIdUtente(?int $idUtente): void
    {
        $this->idUtente = $idUtente;
    }

    /**
     * @return int
     */
    public function getIdEsecuzione(): ?int
    {
        return $this->idEsecuzione;
    }

    /**
     * @param int $idEsecuzione
     */
    public function setIdEsecuzione(?int $idEsecuzione): void
    {
        $this->idEsecuzione = $idEsecuzione;
    }

    /**
     * @return int
     */
    public function getTipo(): int
    {
        return $this->tipo;
    }

    /**
     * @param int $tipo
     */
    public function setTipo(int $tipo): void
    {
        $this->tipo = $tipo;
    }

    /**
     * @return string
     */
    public function getTesto(): string
    {
        return $this->testo;
    }

    /**
     * @param string $testo
     */
    public function setTesto(string $testo): void
    {
        $this->testo = $testo;
    }

    /**
     * @return int
     */
    public function getData(): ?string
    {
        return $this->data;
    }

    /**
     * @param int $data
     */
    public function setData(?string $data): void
    {
        $this->data = $data;
    }

    public function generaTesto(?EUtente $admin, ?EUtente $user, ?EEsecuzione $esecuzione) {
        $msg = "Tipo di Log Sconosciuto";
        switch ($this->tipo) {
            case 0:
                if ($user)
                    $msg = "L'utente <strong>" . $user->getUsername() . "</strong> ha eseguito <strong>" . $esecuzione->getNome() . "</strong> (" . $esecuzione->getId() . ")";
                else
                    $msg = "L'utente <i>anonimo</i> ha eseguito <strong>" . $esecuzione->getNome() . "</strong> (" . $esecuzione->getId() . ")";
                break;
            case 1:
                if ($user)
                    $msg = "L'utente <strong>" . $user->getUsername() . "</strong> ha cercato di eseguire <strong>" . $esecuzione->getNome() . "</strong> (" . $esecuzione->getId() . ") ma questa non è valida";
                else
                    $msg = "L'utente <i>anonimo</i> ha cercato di eseguire <strong>" . $esecuzione->getNome() . "</strong> (" . $esecuzione->getId() . ") ma questa non è valida";
                break;
            case 10:
                $msg = "L'amministratore <strong>" . $admin->getUsername() . "</strong> ha creato l'utente <strong>" . $user->getUsername() . "</strong>";
                break;
            case 11:
                $msg = "L'amministratore <strong>" . $admin->getUsername() . "</strong> ha eliminato l'utente <strong>" . $user->getUsername() . "</strong>";
                break;
            case 12:
                $msg = "L'amministratore <strong>" . $admin->getUsername() . "</strong> ha modificato l'utente <strong>" . $user->getUsername() . "</strong>";
                break;
            case 16:
                $msg = "L'amministratore <strong>" . $admin->getUsername() . "</strong> ha abilitato l'utente <strong>" . $user->getUsername() . "</strong>";
                break;
            case 17:
                $msg = "L'amministratore <strong>" . $admin->getUsername() . "</strong> ha disabilitato l'utente <strong>" . $user->getUsername() . "</strong>";
                break;
            case 18:
                $msg = "L'amministratore <strong>" . $admin->getUsername() . "</strong> ha concessso i diritti di amministratore a <strong>" . $user->getUsername() . "</strong>";
                break;
            case 19:
                $msg = "L'amministratore <strong>" . $admin->getUsername() . "</strong> ha revocato i diritti di amministratore a <strong>" . $user->getUsername() . "</strong>";
                break;


            case 38:
                $msg = "L'amministratore <strong>" . $admin->getUsername() . "</strong> ha autorizzato <strong>" . $user->getUsername() . "</strong> ad eseguire <strong>" . $esecuzione->getNome() . "</strong>";
                break;
            case 39:
                $msg = "L'amministratore <strong>" . $admin->getUsername() . "</strong> ha impedito a <strong>" . $user->getUsername() . "</strong> di eseguire <strong>" . $esecuzione->getNome() . "</strong>";
                break;
        }
        $this->setTesto($msg);
    }

}