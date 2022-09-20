<?php

class EEsecuzione extends EGenericObject
{
    private string $nome;
    private string $descrizione;
    private string $eseguibile;
    private bool $mostraOutput;
    private bool $disabilitato;
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
    public function getDisabilitato(): bool
    {
        return $this->disabilitato;
    }

    /**
     * @param bool $disabilitato
     */
    public function setDisabilitato(bool $disabilitato): void
    {
        $this->disabilitato = $disabilitato;
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

}