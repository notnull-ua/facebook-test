<?php
/**
 * Created by PhpStorm.
 * User: Vladyslav
 * Date: 01.03.2017
 * Time: 15:51
 */

namespace controllers;


class TestController
{

    public function actionIndex()
    {
        echo " action index";
        return true;
    }

    public function actionView($id)
    {
        echo $id;
        echo "Action View";
        return true;
    }
}