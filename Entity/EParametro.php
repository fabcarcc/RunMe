<?php

class EParametro extends EGenericObject
{
    private int $idEsecuzione;
    private string $nome;
    private string $descrizione;
    private ?string $pre;
    private ?string $valore;
    private ?string $post;

    /**
     * @var int $tipoParametro
     * 0: Parametro Obbligatorio
     * 1: Parametro Facoltativo default attivo
     * 2: Parametro Facoltativo default NON attivo
     * 3: Parametro Nascosto
     */
    private int $tipoParametro;

    /**
     * @var int $tipoValore
     * 0: Nessun Valore
     * 1: stringa (può essere vuota)
     * 2: stringa (NON può essere vuota)
     */
    private int $tipoValore;

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
     * @param ?string $post
     */
    public function setPost(?string $post): void
    {
        $this->post = $post;
    }

    /**
     * @return int
     */
    public function getTipoParametro(): int
    {
        return $this->tipoParametro;
    }

    /**
     * @param int $tipoParametro
     */
    public function setTipoParametro(int $tipoParametro): void
    {
        $this->tipoParametro = $tipoParametro;
    }

    /**
     * @return int
     */
    public function getTipoValore(): int
    {
        return $this->tipoValore;
    }

    /**
     * @param int $tipoValore
     */
    public function setTipoValore(int $tipoValore): void
    {
        $this->tipoValore = $tipoValore;
    }

}