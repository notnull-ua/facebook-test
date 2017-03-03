<?php
/**
 * Created by PhpStorm.
 * User: Vladyslav
 * Date: 03.03.2017
 * Time: 15:44
 */

namespace components;


interface ServiceInterface
{
    /**
     * Authenticate and return bool result of authentication
     *
     * @return bool
     */
    public function authenticate();

}