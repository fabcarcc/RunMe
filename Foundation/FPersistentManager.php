<?php

/**
 * Lo scopo di questa classe è quello di fornire un accesso unico al DBMS, incapsulando
 * al proprio interno i metodi statici di tutte le altre classi Foundation, così che l'accesso
 * ai dati persistenti da parte degli strati superiore dell'applicazione sia piu' intuitivo.
 *
 * @package Foundation
 */

require_once 'includes/config.inc.php';

class FPersistentManager
{

    /** L'unica istanza della classe */
    private static $instance = null;
    /** Oggetto PDO per la connessione al dbms */
    private $db;

    /**    METODI DI INIZIALIZZAZIONE  **/

    /**
     * Costruttore, effettua la connessione al DB
     * Privato per evitare duplicazioni dell'oggetto
     */
    private function __construct()
    {
        try {
            global $config;
            $dsn = "mysql:host=" . $config['mysql']['host'] . ";dbname=" . $config['mysql']['database'];
            $this->db = new PDO ($dsn, $config['mysql']['user'], $config['mysql']['password']);
//            echo "DB Connesso";

        } catch (PDOException $e) {
            echo "Errore : " . $e->getMessage();
            die;
        }
    }

    /**
     * Metodo che chiude la connessione al dbms.
     */
    function __destruct()
    {
        $this->db = null;
        static::$instance = null;
//        echo "DB sconnesso";
    }

    /**
     * Metodo reso privato per evitare la clonazione dell'oggetto.
     */
    private function __clone()
    {
    }

    /**
     * Metodo che restituisce l'unica istanza dell'oggetto.
     * @return FPersistentManager l'istanza dell'oggetto.
     */
    static function getInstance(): FPersistentManager
    {
        if (static::$instance == null) {
            static::$instance = new FPersistentManager();
        }
        return static::$instance;
    }


    /** SELECT **/

    function exist(string $class, $id, string $key = NULL, $id2 = NULL, $key2 = NULL)
    {
        $sql = '';

        if (class_exists($class)) // si verifica che l'oggetto Entity esista
        {
            $resource = substr($class, 1); // si ricava il nome della risorsa corrispondente all'oggetto Entity
            $foundClass = 'F' . $resource; // si ricava il nome della corrispettiva classe Foundation
            $method = 'exist';

            if (method_exists($foundClass, $method)) {
                if ($key) {
                    if ($key2){
                        $sql = $foundClass::$method($key,$key2);
                    } else {
                    $sql = $foundClass::$method($key);
                    }
                } else {
                    $sql = $foundClass::$method();
                }
            }
        }

        if ($sql)
            return $this->execExist($class, $id, $sql, $id2);
        else return NULL;
    }

    private function execExist(string $class, $id, string $sql, $id2)
    {
        try {
            $stmt = $this->db->prepare($sql);
            if (is_integer($id)) {
                $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            } else {
                $stmt->bindValue(":id", $id);
            }
            if (isset($id2)) {
                if (is_integer($id2)) {
                    $stmt->bindValue(":id2", $id2, PDO::PARAM_INT);
                } else {
                    $stmt->bindValue(":id2", $id2);
                }
            }
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);


            $row = $stmt->fetch();

            return (bool)$row['C'];

        }
        catch (PDOException $e) {
            echo "Errore : " . $e->getMessage();
            return null;
        }
    }


    /**
     * Metodo che carica dal dbms informazioni in un corrispettivo oggetto Entity.
     * @param string $class La classe dell'oggetto da caricare
     * @param int|string $id Il valore dell'identificativo
     * @param string|null $key La colonna su cui effettuare la ricerca (da specificare se diversa dal default)
     * @param bool $single_result True se si attende un solo valore, False per un array
     * @return object Un oggetto (o un array di oggetti) Entity.
     */
    function load(string $class, $id, string $key = NULL, bool $single_result = true)
    {
        $sql = '';

        if (class_exists($class)) // si verifica che l'oggetto Entity esista
        {
            $resource = substr($class, 1); // si ricava il nome della risorsa corrispondente all'oggetto Entity
            $foundClass = 'F' . $resource; // si ricava il nome della corrispettiva classe Foundation
            $method = 'load';

            if (method_exists($foundClass, $method)) {
                if ($key) {
                    $sql = $foundClass::$method($key);
                } else {
                    $sql = $foundClass::$method();
                }
            }
        }

        if ($sql) {
            //echo $sql;
            return $this->execSelect($class, $id, $sql, $single_result);
        } else return NULL;
    }

    /**
     * Metodo privato per l'esecuzioni di query SELECT
     * @param string $class La classe dell'oggetto da caricare
     * @param int|string $id Il valore dell'identificativo
     * @param string $sql La query da eseguire
     * @param bool $single_result True se si attende un solo valore, False per un array
     * @return array|mixed|null Un oggetto (o un array di oggetti) Entity.
     */
    private function execSelect(string $class, $id, string $sql, bool $single_result)
    {
        try {
            if ($single_result) $sql .= " LIMIT 1";
            $stmt = $this->db->prepare($sql);
            if (is_integer($id)) {
                $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            } else {
                $stmt->bindValue(":id", $id);
            }

            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            $obj = NULL;

            if ($single_result) {
                //echo "SINGLE ";
                $row = $stmt->fetch();
                $obj = FPersistentManager::createObjectFromRow($class, $row);
            } else {
                //echo "NOSINGLE ";
                while ($row = $stmt->fetch()) {
                    //echo "WHILE ";
                    //print_r($row);
                    $obj[] = FPersistentManager::createObjectFromRow($class, $row);
                }
            }

            return $obj;
        }
        catch (PDOException $e) {
            echo "Errore : " . $e->getMessage();
            return null;
        }
    }

    function getAll(string $class)
    {
        $sql = '';

        if (class_exists($class)) // si verifica che l'oggetto Entity esista
        {
            $resource = substr($class, 1); // si ricava il nome della risorsa corrispondente all'oggetto Entity
            $foundClass = 'F' . $resource; // si ricava il nome della corrispettiva classe Foundation
            $method = 'getAll';

            if (method_exists($foundClass, $method)) {
                $sql = $foundClass::$method();
            }
        }
        if ($sql)
            return $this->execGetAll($class,$sql);
        else return NULL;
    }

    private function execGetAll($class,$sql)
    {
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            $obj = NULL;

            while ($row = $stmt->fetch()) {
                $obj[] = FPersistentManager::createObjectFromRow($class, $row);
            }

            return $obj;
        }
        catch (PDOException $e) {
            echo "Errore : " . $e->getMessage();
            return null;
        }
    }

    /** STORE **/

    /**
     * Metodo che permette di salvare sul DB informazioni contenute in un oggetto
     * Entity sul database.
     * @param $obj L'oggetto Entity da salvare
     * @return bool L'esito della transazione
     */
    function store(&$obj): bool
    {
        $sql = '';
        $class = get_class($obj);
        $resource = substr($class, 1);
        $foundClass = 'F' . $resource;

        if ($obj->getID()) {
            $method = 'update';
        }
        else {
            $method = 'store';
        }

        if (class_exists($foundClass) && method_exists($foundClass, $method))
            $sql = $foundClass::$method();

        if ($sql) {
            return $this->execStore($obj, $sql);
        }
        return false;
    }

    /**
     * Metodo privato per l'esecuzioni di query INSERT o UPDATE
     *
     * @param mixed $obj L'oggetto da salvare
     * @param string $sql La query da eseguire
     * @return bool L'esito della transazione
     */
    private function execStore(&$obj, string $sql): bool
    {
        try {
            $stmt = $this->db->prepare($sql);
            FPersistentManager::bindValues($stmt, $obj);
            if ($obj->getID()) {
                $stmt->bindValue(':id', $obj->getId(), PDO::PARAM_INT);
            }

            $res = $stmt->execute();

            if ($res && !$obj->getID())
            {
                $obj->setId($this->db->lastInsertId());
            }
            return $res;
        }
        catch (PDOException $e) {
            echo "Errore : " . $e->getMessage();
            return false;
        }
    }


    /** REMOVE **/

    /**
     * Metodo che cancella dal database una entry relativa ad un oggetto Entity
     * @param string $class La classe dell'oggetto da eliminare
     * @param int|string $id Il valore dell'identificativo
     * @return bool L'esito della transazione
     */
    function remove(string $class, $id, string $key = NULL): bool
    {
        $sql = '';
        if (class_exists($class)) {
            $resource = substr($class, 1);
            $foundClass = 'F' . $resource;
            $method = 'remove';

            if (method_exists($foundClass, $method)) {
                if ($key) {
                    $sql = $foundClass::$method($key);
                } else {
                    $sql = $foundClass::$method();
                }
            }
        }
        if ($sql) {
            return $this->execRemove($sql, $id);
        }
        else return false;
    }

    /**
     * Metodo privato per l'esecuzioni di query DELETE
     * @param string $sql La query da eseguire
     * @param int|string $id Il valore dell'identificativo
     * @return bool L'esito della transazione
     */
    private function execRemove(string $sql, $id): bool
    {
        try {
            $stmt = $this->db->prepare($sql);

            if (is_integer($id)) {
                $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            } else {
                $stmt->bindValue(":id", $id);
            }

            $result = $stmt->execute();

            //$this->__destruct();

            return $result;

        }
        catch (PDOException $e) {
            echo "Errore : " . $e->getMessage();
            return FALSE;
        }
    }


    /**  ASSOCIAZIONI ENTITY - DB  **/

    /**
     * Associa ai campi della query i corrispondenti valori dell'oggetto
     * @param PDOStatement $stmt Lo statement contenente i campi da riempire
     * @param Object $obj L'oggetto Entity da cui leggere i valori
     */
    private function bindValues(PDOStatement &$stmt, &$obj)
    {
        $class = get_class($obj);
        $resource = substr($class, 1);
        $foundClass = 'F' . $resource;

        $foundClass::bindValues($stmt, $obj);
    }

    /**
     * Istanzia un oggetto Entity a partire da una tupla ricevuta da una query
     * @param string $class La classe dell'oggetto da istanziare
     * @param array $row La tupla restituita dal dbms
     * @return mixed L'oggetto entity creato
     */
    private function createObjectFromRow(string $class, $row)
    {
        $obj = NULL;

        if (class_exists($class)) {
            $foundClass = 'F' . substr($class, 1);

            $obj = $foundClass::createObjectFromRow($row);
        }

        return $obj;
    }

}
