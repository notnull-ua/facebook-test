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
    public $id;

    /**
     * Save the model
     */
    public function save()
    {
        $db = DB::getInstance();
        if ($this->id != null) {
            $query = "Update {$this->get_class_name()} SET ";
            $where = " where id=" . $this->id;
        } else {
            $query = "Insert INTO {$this->get_class_name()} SET ";
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
        return $db->queryExec($query, $params);
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
        $classname = static::get_class_name();
        return self::queryFetch("Select * from {$classname} WHERE id= :id", ['id' => $id]);
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