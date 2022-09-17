<?php

class FUtente extends FGenericObject
{
    const TABLE = 'Utenti';
    const COLUMN = array("username", "password", "email", "admin");
    const COLUMN_TYPE = array(PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_BOOL);
    const ENTITY_CLASS = "EUtente";


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
