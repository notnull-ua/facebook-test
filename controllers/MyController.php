<?php
/**
 * Created by PhpStorm.
 * User: Vladyslav
 * Date: 05.03.2017
 * Time: 1:11
 */

namespace controllers;


use components\Controller;
use models\User;
use components\Facebook;

class MyController extends Controller
{

    public function actionIndex()
    {
        if (!isset($_SESSION['user'])) {
            die("Access denied");
        }

        $fb = Facebook::getFriendsFb();
        var_dump($_SESSION['user']);
        $this->view->render('index', ['user' => $_SESSION['user']]);
        return true;
    }

}