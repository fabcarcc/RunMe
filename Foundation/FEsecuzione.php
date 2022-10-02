<?php

class FEsecuzione extends FGenericObject
{
    const TABLE = 'Esecuzioni';
    const COLUMN = array("nome", "descrizione", "eseguibile", "mostraOutput", "abilitato");
    const COLUMN_TYPE = array(PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_BOOL, PDO::PARAM_BOOL);
    const ENTITY_CLASS = "EEsecuzione";

//    static function createObjectFromRow($row)
//    {
//        $obj = parent::createObjectFromRow($row);
//        if ($obj) {
//            $obj->caricaParametri();
//        }
//        return $obj;
//    }

}

