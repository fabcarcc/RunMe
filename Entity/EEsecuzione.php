<?php

class EEsecuzione extends EGenericObject
{
    private string $nome;
    private string $descrizione;
    private string $eseguibile;
    private bool $mostraOutput;
    private bool $abilitato;
    private ?array $parametri;

    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    /**
     * @return string
     */
    public function getDescrizione(): string
    {
        return $this->descrizione;
    }

    /**
     * @param string $descrizione
     */
    public function setDescrizione(string $descrizione): void
    {
        $this->descrizione = $descrizione;
    }

    /**
     * @return string
     */
    public function getEseguibile(): string
    {
        return $this->eseguibile;
    }

    /**
     * @param string $eseguibile
     */
    public function setEseguibile(string $eseguibile): void
    {
        $this->eseguibile = $eseguibile;
    }

    /**
     * @return bool
     */
    public function getMostraOutput(): bool
    {
        return $this->mostraOutput;
    }

    /**
     * @param bool $mostraOutput
     */
    public function setMostraOutput(bool $mostraOutput): void
    {
        $this->mostraOutput = $mostraOutput;
    }

    /**
     * @return bool
     */
    public function getAbilitato(): bool
    {
        return $this->abilitato;
    }

    /**
     * @param bool $abilitato
     */
    public function setAbilitato(bool $abilitato): void
    {
        $this->abilitato = $abilitato;
    }

    /**
     * @return array
     */
    public function getParametri(): ?array
    {
        return $this->parametri;
    }

    /**
     * @param mixed $parametri
     */
    public function setParametri(?array $parametri): void
    {
        $this->parametri = $parametri;
    }

    public function caricaParametri(){
        $fp = FPersistentManager::getInstance();
        $param = $fp->load('EParametro', $this->getId(), 'idEsecuzione', false);
        $this->setParametri($param);
    }

    public function save() : bool {
        if ($this->getId()) {
            $fp = FPersistentManager::getInstance();
            if (!$fp->remove('EParametro',$this->getId(),'idEsecuzione')) return false;
        }
        if (!parent::save()) return false;
        foreach ($this->getParametri() as $p) {
            $p->setIdEsecuzione($this->getId());
            $p->setId(null);
            if (!$p->save()) return false;
        }
        echo "4";
        return true;
    }

}