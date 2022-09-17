<?php

class EPermesso extends EGenericObject
{
    private int $idUtente;
    private int $idEsecuzione;

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


}