<?php
/**
 * Created by PhpStorm.
 * User: Vladyslav
 * Date: 02.03.2017
 * Time: 15:42
 */

namespace components;


class Controller
{

    protected $view;

    function __construct(){
        $this->view = new View();
    }


}