<?php

class FEsecuzione extends FGenericObject
{
    const TABLE = 'Esecuzioni';
    const COLUMN = array("nome", "descrizione", "eseguibile", "mostraOutput", "disabilitato");
    const COLUMN_TYPE = array(PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_BOOL, PDO::PARAM_BOOL);
    const ENTITY_CLASS = "EEsecuzione";
}

