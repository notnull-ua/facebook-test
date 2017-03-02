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
        $params = include(ROOT."config/db_conf.php");
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $attr = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ];
        try{
            $this->_db= new \PDO($dsn,$params['user'],$params['password'],$attr);
        }
        catch (\PDOException $e){
            die("Не удалось установить подключение к БД". $e->getMessage());
        }

    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function query($sql, $args = []) {
       $obj = self::getInstance()->_db->prepare($sql);
       return $obj->execute($args);
    }


}