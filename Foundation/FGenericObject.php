<?php

abstract class FGenericObject
{
    const DEFAULT_KEY = 'id';

    /**
     * Query per il caricamento di un oggetto
     * @return string La query sql per la SELECT
     */
    static function load(string $key = null) : string
    {
        if (!$key) $key = static::DEFAULT_KEY;
        return "SELECT * FROM " . static::TABLE . " WHERE " . $key . " = :id;";
    }

    static function exist(string $key = null, string $key2 = null) {
        if (!$key) $key = static::DEFAULT_KEY;
        if ($key2) $end = " AND " .$key2 . " = :id2;";
        else $end = ";";
        return "SELECT COUNT(*) AS C FROM " . static::TABLE . " WHERE " . $key . " = :id" . $end;
    }

    /**
     * Query per il caricamento di tutti gli oggetti di un certo tipo
     * @return string La query sql per la SELECT
     */
    static function getAll() : string
    {
        return "SELECT * FROM " . static::TABLE ;
    }

    /**
     * Query che effettua la rimozione di un oggetto dal DB
     * @return string La query sql per la DELETE
     */
    static function remove(string $key = null) : string
    {
        if (!$key) $key = static::DEFAULT_KEY;
        return "DELETE FROM " . static::TABLE . " WHERE " . $key . " = :id;";
    }

    /**
     * Query che effettua il salvataggio di un oggetto
     * @return string La query sql per la INSERT
     */
    static function store() : string
    {
        $p1 = '';
        foreach (static::COLUMN as $c) {
            $p1 .= $p1 ? ", " : "";
            $p1 .= $c;
        }
        $p2 = '';
        foreach (static::COLUMN as $c) {
            $p2 .= $p2 ? ", " : "";
            $p2 .= ":" . $c;
        }
        return "INSERT INTO " . static::TABLE . " (" . $p1 . ") VALUES (" . $p2 . ");";
    }

    /**
     * Query che effettua l'aggiornamento di un oggetto
     * @return string La query sql per la UPDATE
     */
    static function update() : string
    {
        $p1 = '';
        foreach (static::COLUMN as $c) {
            $p1 .= $p1 ? ", " : "";
            $p1 .= $c . " = :" . $c;
        }
        return "UPDATE " . static::TABLE . " SET " . $p1 . " WHERE id = :id;";
    }

    /**
     * Crea una Entity da una row del database
     * @param $row - La riga letta dal DB avente come indici i campi della table
     * @return mixed|null L'oggetto Entity creato
     */
    static function createObjectFromRow($row)
    {
        if(!$row){return NULL;}
        $class = static::ENTITY_CLASS;
        $obj = new $class();
        $obj->setId($row['id']);
        foreach (static::COLUMN as $c) {
            $method = "set" . $c;
            $obj->$method($row[$c]);
        }

        return $obj;
    }

    /**
     * Associazione di un oggetto Entity ai campi di una query sql.
     * @param PDOStatement $stmt Lo statement contenente i campi da riempire
     * @param EUtente $user L'oggetto da cui prelevare i dati
     */
    static function bindValues(PDOStatement &$stmt, &$obj)
    {
        for ($i = 0; $i < count(static::COLUMN); $i++) {
            $method = "get" . static::COLUMN[$i];
            $stmt->bindValue(':'. static::COLUMN[$i], $obj->$method(), static::COLUMN_TYPE[$i]);
        }
    }

}