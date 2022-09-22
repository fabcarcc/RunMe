<?php

class FLog extends FGenericObject
{
    const TABLE = 'Log';
    const COLUMN = array("idAdmin", "idUtente", "idEsecuzione", "data", "tipo", "testo");
    const COLUMN_TYPE = array(PDO::PARAM_INT, PDO::PARAM_INT, PDO::PARAM_INT, PDO::PARAM_INT, PDO::PARAM_INT, PDO::PARAM_STR);
    const ENTITY_CLASS = "ELog";
}
