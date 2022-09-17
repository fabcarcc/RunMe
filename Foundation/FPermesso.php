<?php

class FPermesso extends FGenericObject
{
    const TABLE = 'Permessi';
    const COLUMN = array("idUtente", "idEsecuzione");
    const COLUMN_TYPE = array(PDO::PARAM_INT, PDO::PARAM_INT);
    const ENTITY_CLASS = "EPermesso";
}
