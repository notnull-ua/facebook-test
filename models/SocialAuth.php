<?php
/**
 * Created by PhpStorm.
 * User: Vladyslav
 * Date: 07.03.2017
 * Time: 15:02
 */

namespace models;


use components\DB;
use components\Model;

class SocialAuth extends Model
{

    public $social_id;
    public $user_id;
    public $service_name;


    /**
     *Return array model by id
     * @param $id int
     * @return array
     */
    public function getModelBySocialId($id)
    {
        $db = DB::getInstance();
        return $db->query("Select * from social_auth WHERE social_id = :social_id", ['social_id' => $id])->fetchAll();
    }

}