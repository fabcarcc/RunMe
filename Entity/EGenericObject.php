<?php

abstract class EGenericObject
{
    public ?int $id = null;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function save(): bool
    {
        $fp = FPersistentManager::getInstance();
        return $fp->store($this);
    }

}