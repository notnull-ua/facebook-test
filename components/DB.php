<?php
/**
 * Created by PhpStorm.
 * User: Vladyslav
 * Date: 02.03.2017
 * Time: 14:48
 */

namespace components;


class DB
{
    private $_db;

    /* @var $_instance DB
     *
     * */
    private static $_instance;

    private function __construct()
    {
        $params = include(ROOT . "/config/db_conf.php");
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $attr = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ];
        try{
            $this->_db= new \PDO($dsn,$params['user'],$params['password'],$attr);
        }
        catch (\PDOException $e){
            die("Error connection to DB" . $e->getMessage());
        }

    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }


    /**
     * Execution query and return db object
     * @param $sql string
     * @param  $args array
     * @return \PDOStatement
     */
    public function query($sql, $args = []) {
       $obj = self::getInstance()->_db->prepare($sql);
        $obj->execute($args);
        return $obj;
    }


    /**
     * Execution query and return result
     *
     * @param $sql string MySql query
     * @param $args array Query params
     * @return boolean
     */
    public function queryExec($sql, $args = [])
    {
        $obj = self::getInstance()->_db->prepare($sql);
        return $obj->execute($args);

    }

    public static function lastInsertId()
    {
        return self::getInstance()->_db->lastInsertId();
    }


}