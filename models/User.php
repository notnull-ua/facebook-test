<?php
/**
 * Created by PhpStorm.
 * User: Vladyslav
 * Date: 05.03.2017
 * Time: 21:19
 */

namespace models;


use components\DB;
use components\Model;

class User extends Model
{
    /**
     * @var $firstname string
     */
    public $firstname;

    /** @var $lastname string */
    public $lastname;


    public function __construct()
    {

    }

    /**
     * Return user array with id and other data
     * or redirect if user is not auth
     * @return array User
     */
    public static function checkLogged()
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        header("Location: /site/login");
    }

    /**
     * Check if User is Guest
     * @return boolean Result
     */
    public static function isGuest()
    {
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }

    /**
     *  Save user
     * @return boolean
     */
//    public function save()
//    {
//        $db = DB::getInstance();
//        return $db->queryExec("Insert INTO USER SET firstname = :firstname, lastname = :lastname",['firstname'=>$this->firstname,'lastname' => $this->lastname]);
//    }

    /**
     * Return array with user data or null
     *
     * @param $id int
     * @return array|null
     */
    public static function getUserById($id)
    {
        return self::queryFetch("Select * from USER WHERE id= :id", ['id' => $id]);
    }


    /**
     * Exec query and return array with  result
     * @param $query string MySql query
     * @param $param array Params of query for
     * @return array
     */
//    private function queryFetch($query, $param = [])
//    {
//        $db = DB::getInstance();
//        /* @var  $db \PDO */
//        return $db->query($query, $param)->fetchAll();
//    }

}