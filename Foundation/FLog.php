<?php

class FLog extends FGenericObject
{
    const TABLE = 'Log';
    const COLUMN = array("idAdmin", "idUtente", "idEsecuzione", "data", "tipo", "testo");
    const COLUMN_TYPE = array(PDO::PARAM_INT, PDO::PARAM_INT, PDO::PARAM_INT, PDO::PARAM_STR, PDO::PARAM_INT, PDO::PARAM_STR);
    const ENTITY_CLASS = "ELog";

    /**
     * Query per il caricamento di un oggetto
     * @return string La query sql per la SELECT
     */
    static function load(string $key = null) : string
    {
        if (!$key) $key = static::DEFAULT_KEY;
        if ($key == 'idUtente') {
            return "SELECT * FROM ". static::TABLE . " WHERE idUtente = :id OR idAdmin = :id";
        }
        return "SELECT * FROM " . static::TABLE . " WHERE " . $key . " = :id;";
    }
}
