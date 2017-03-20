<?php
/**
 * Created by PhpStorm.
 * User: Vladyslav
 * Date: 07.03.2017
 * Time: 10:27
 */

namespace components;


abstract class Model
{

    /**
     * Id model record
     * @var $id integer
     */


    // todo: додати поле назва таблиці щоб робити запити

    public $id;

    /**
     * @return string the table name
     * */
    public static function tableName()
    {
        $regex = '/(?<![A-Z])[A-Z]/';
        $separator = '_';
        return trim(strtolower(preg_replace($regex, $separator . '\0', static::get_class_name())), $separator);

    }
    /**
     * Save the model
     */
    public function save()
    {
        $db = DB::getInstance();
        $tablename = static::tableName();
        if ($this->id != null) {
            $query = "Update {$tablename} SET ";
            $where = " where id=" . $this->id;
        } else {
            $query = "Insert INTO {$tablename} SET ";
        }

        $params = [];
        $property = get_object_vars($this);
        unset($property['id']); // delete id property
        $res = array_map(function ($k, $v) {
            if ($k != 'id') return "$k = :$k";
        }, array_keys($property), $property);
        $query .= implode(', ', $res);

        foreach ($property as $key => $value) {
            $params[$key] = $value;
        }

        if (isset($where)) {
            $query = $query . $where;
        }
        if ($result = $db->queryExec($query, $params)) {
            $this->id = $db::lastInsertId();
            return $result;
        } else $result;

    }

    /**
     * Getting current class name
     * @return string
     * */
    public static function get_class_name()
    {
        $classname = static::class;
        if ($pos = strrpos($classname, '\\')) return substr($classname, $pos + 1);
        return $pos;
    }


    /**
     * Return array with user data or null
     *
     * @param $id int
     * @return array|null
     */
    public static function getModelById($id)
    {
        $tablename = static::tableName();
        return self::queryFetch("Select * from {$tablename} WHERE id= :id", ['id' => $id]);
    }

    /**
     * Exec query and return array with  result
     * @param $query string MySql query
     * @param $param array Params of query for
     * @return array
     */
    protected static function queryFetch($query, $param = [])
    {
        $db = DB::getInstance();
        /* @var  $db \PDO */
        return $db->query($query, $param)->fetchAll();
    }
}