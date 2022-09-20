<?php

class EParametro extends EGenericObject
{
    private int $idEsecuzione;
    private string $nome;
    private string $descrizione;
    private ?string $pre;
    private ?string $valore;
    private ?string $post;
    private bool $obbligatorio;
    private int $tipo;

    /**
     * @return int
     */
    public function getIdEsecuzione(): int
    {
        return $this->idEsecuzione;
    }

    /**
     * @param int $idEsecuzione
     */
    public function setIdEsecuzione(int $idEsecuzione): void
    {
        $this->idEsecuzione = $idEsecuzione;
    }

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
    public function getPre(): ?string
    {
        return $this->pre;
    }

    /**
     * @param string $pre
     */
    public function setPre(?string $pre): void
    {
        $this->pre = $pre;
    }

    /**
     * @return string
     */
    public function getValore(): ?string
    {
        return $this->valore;
    }

    /**
     * @param string $valore
     */
    public function setValore(?string $valore): void
    {
        $this->valore = $valore;
    }

    /**
     * @return string
     */
    public function getPost(): ?string
    {
        return $this->post;
    }

    /**
     * @param string $post
     */
    public function setPost(?string $post): void
    {
        $this->post = $post;
    }

    /**
     * @return bool
     */
    public function getObbligatorio(): bool
    {
        return $this->obbligatorio;
    }

    /**
     * @param bool $obbligatorio
     */
    public function setObbligatorio(bool $obbligatorio): void
    {
        $this->obbligatorio = $obbligatorio;
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

}