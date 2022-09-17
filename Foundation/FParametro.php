<?php

class FParametro extends FGenericObject
{
    const TABLE = 'Parametri';
    const COLUMN = array("idEsecuzione", "nome", "descrizione", "pre", "valore", "post", "obbligatorio", "tipo");
    const COLUMN_TYPE = array(PDO::PARAM_INT, PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_BOOL, PDO::PARAM_INT);
    const ENTITY_CLASS = "EParametro";


//    /**
//     * Associazione di un oggetto Entity ai campi di una query sql.
//     * @param PDOStatement $stmt Lo statement contenente i campi da riempire
//     * @param EUtente $user L'oggetto da cui prelevare i dati
//     */
//    static function bindValues(PDOStatement &$stmt, EUtente &$user)
//    {
//        $stmt->bindValue(':username', $user->getUsername(), PDO::PARAM_STR);
//        $stmt->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
//        $stmt->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
//        $stmt->bindValue(':admin', $user->getAdmin(), PDO::PARAM_BOOL);
//    }


}
