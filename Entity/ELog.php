<?php

class ELog extends EGenericObject
{
    private int $idAdmin;
    private int $idUtente;
    private int $idEsecuzione;
    private int $data;
    private int $tipo;
    private string $testo;

    /**
     * @return int
     */
    public function getIdAdmin(): int
    {
        return $this->idAdmin;
    }

    /**
     * @param int $idAdmin
     */
    public function setIdAdmin(int $idAdmin): void
    {
        $this->idAdmin = $idAdmin;
    }

    /**
     * @return int
     */
    public function getIdUtente(): int
    {
        return $this->idUtente;
    }

    /**
     * @param int $idUtente
     */
    public function setIdUtente(int $idUtente): void
    {
        $this->idUtente = $idUtente;
    }

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
    public function getData(): int
    {
        return $this->data;
    }

    /**
     * @param int $data
     */
    public function setData(int $data): void
    {
        $this->data = $data;
    }



}