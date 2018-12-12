<?

/**
 * Class DB
 */

//include "function.php";
class DB
{
    const DB_DRIVER = 'mysql';
    const DB_HOST = 'localhost';
    const DB_NAME = 'mymag';
    const DB_USER = 'root';
    const DB_PASS = '';
    const DB_CHAR = 'utf8';
    protected static $instance = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public function getPDO()
    {
        if (self::$instance === null) {
            $opt = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => TRUE,
            );
            $dsn = 'mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME . ';charset=' . self::DB_CHAR;
            self::$instance = new PDO($dsn, self::DB_USER, self::DB_PASS, $opt);
        }
        return self::$instance;
    }

    /**
     * @param $sql
     * @return bool|PDOStatement
     */
    public static function sql($sql)
    {
        $stmt = self::getPDO()->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public static function getRows($sql)
    {
        return self::sql($sql)->fetchAll();
    }

    public static function getRow($sql)
    {
        return self::sql($sql)->fetch();
    }

    public static function get($sql){
        return self::sql($sql)->rowCount();
    }

    /**
     * Выборка из таблицы
     * @param $table
     * @param array $arg
     * @return array
     */
    public static function select($table, $arg = [], $where = '', $fetch = false)
    {
        if (count($arg) == 0) {
            $arg = '*';
        } else {
            $args = '';
            foreach ($arg as $item) {
                $args .= $item . ',';
            }
            $arg = substr($args, 0, -1);
        }
        $where = ($where != '') ? "WHERE $where" : '';
        $sql = "SELECT $arg FROM $table $where";
        $stmt = self::getPDO()->prepare($sql);
        $stmt->execute();
        return (!$fetch) ? $stmt->fetchAll() : $stmt->fetch();
    }

    /**
     * @param $table
     * @param array $arg
     * @return int
     */
    public static function insert($table, $arg = [])
    {
        $param = '';
        $value = '';
        foreach ($arg as $key => $elem) {
            $param .= "`$key`,";
            $value .= "'$elem',";
        }
        $param = substr($param, 0, -1);
        $value = substr($value, 0, -1);
        $stmt = self::getPDO()->prepare("INSERT INTO $table($param) VALUES ($value)");
        try {
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
//            self::checkError($e);
            return false;
        }
    }

    /**
     * @param $table
     * @param array $arg
     * @param string $where
     * @return int
     */
    public static function update($table, $arg = [], $where = '')
    {
        #UPDATE FROM table SET поля where
        $param = '';
        foreach ($arg as $key => $elem) {
            $param .= "`$key`='$elem',";
        }
        $param = substr($param, 0, -1);
        $where = ($where != '') ? "WHERE $where" : '';
        $stmt = self::getPDO()->prepare("UPDATE $table SET $param $where");
        try {
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
//            self::checkError($e);
            return false;
        }
    }

    /**
     * @param $table
     * @param string $where
     * @return int
     */
    public static function delete($table, $where = '')
    {
        $where = ($where != '') ? "WHERE $where" : '';
        $stmt = self::getPDO()->prepare("DELETE FROM $table $where");
        try {
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            //self::checkError($e);
            return false;
        }
    }

    private static function checkError($e)
    {
        switch ($e->getCode()) {
            case 23000:
                dd('Поля должны быть уникальными');
                break;
            case 23502:
                dd('Полян не должны быть пустыми');
                break;
            case 23503:
                dd('Нарушена целостность данных');
                break;
            default:
                dd($e->getCode());
        }
    }
}

?>